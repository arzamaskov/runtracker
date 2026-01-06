# GitHub Actions CI/CD

Этот репозиторий использует GitHub Actions для автоматизации проверок качества кода, тестирования, сборки Docker образов и деплоя.

## Структура Workflows

### 1. [lint.yml](lint.yml) - Линтеры
**Триггер**: каждый push/PR
**Джобы**:
- `pint` - Laravel Pint (code style)
- `deptrac` - Deptrac (architecture dependencies)
- `phpstan` - PHPStan Level 5 (static analysis)

### 2. [test.yml](test.yml) - Тесты
**Триггер**: каждый push/PR
**Джобы**:
- `phpunit` - PHPUnit (unit/feature tests)
- `frontend` - Vite build + TailwindCSS

### 3. [build-images.yml](build-images.yml) - Docker Images
**Триггер**: создание тега `v*.*.*`
**Джобы**:
- `build-frontend` - сборка frontend assets
- `build-images` - сборка и push в GHCR:
  - `php-fpm` - PHP 8.4-FPM (production)

**Registry**: GitHub Container Registry (ghcr.io)

### 4. [cd.yml](cd.yml) - Continuous Deployment
**Триггер**: мануальный запуск (workflow_dispatch)
**Защита**: требует approval через GitHub Environment "production"
**Джобы**:
- `deploy-production` - SSH деплой на прод

## Настройка

### Шаг 1: GitHub Secrets

Добавьте следующие secrets в Settings → Secrets and variables → Actions → Secrets:

```
SSH_HOST          # IP/hostname продакшн сервера
SSH_USER          # SSH username
SSH_PRIVATE_KEY   # Private SSH key (полностью, включая BEGIN/END)
SSH_PORT          # (опционально) SSH port, по умолчанию 22
```

### Шаг 2: GitHub Environment

Создайте environment "production" в Settings → Environments:

1. Нажмите "New environment"
2. Имя: `production`
3. Enable "Required reviewers" - добавьте минимум 1 человека
4. Deployment branches: выберите "Selected branches" → добавьте `main`

### Шаг 3: Branch Protection

Настройте защиту для main ветки в Settings → Branches → Branch protection rules:

1. Branch name pattern: `main`
2. ✅ Require a pull request before merging
   - ✅ Require approvals: 1
3. ✅ Require status checks to pass before merging
   - Добавьте: `Laravel Pint`, `Deptrac`, `PHPStan`, `PHPUnit`, `Frontend Build`
4. ✅ Require branches to be up to date before merging

### Шаг 4: (Опционально) Настройка сервера

На продакшн сервере убедитесь что:

1. Установлен Docker и Docker Compose v2+
2. Пользователь `SSH_USER` имеет права на docker команды
3. Директория `/opt/run-app` существует и доступна для записи
4. Открыт SSH порт в файрволе

## Использование

### Проверка кода (автоматически)

При каждом push или создании PR автоматически запускаются:
- Lint workflow (3 параллельных джоба)
- Test workflow (2 параллельных джоба)

### Создание release

1. Создайте и запушьте тег:
   ```bash
   git tag v1.0.0
   git push origin v1.0.0
   ```

2. Build Images workflow автоматически:
   - Соберет frontend
   - Соберет Docker образы `php-fpm`
   - Запушит в `ghcr.io/OWNER/runtracker:app-v1.0.0` и `:app-latest`

### Деплой на продакшн

1. Перейдите в Actions → CD → Run workflow
2. Выберите ветку `main`
3. (Опционально) Укажите версию, например `v1.0.0` (по умолчанию `latest`)
4. Нажмите "Run workflow"
5. Дождитесь approval от reviewer (если настроен Environment)
6. Деплой начнется автоматически после approval

## Кеширование

Workflows используют агрессивное кеширование для ускорения:

- **Composer**: `~/.composer/cache` + `vendor/`
- **pnpm**: `~/.pnpm-store`
- **PHPStan**: `.phpstan/cache`
- **Docker layers**: GitHub Actions cache

## Отмена старых билдов

При push нового коммита старые незавершенные билды автоматически отменяются благодаря `concurrency` группе.

## Мониторинг

- Status badges можно добавить в README.md
- Deployment history доступен в Settings → Environments → production
- Logs доступны в Actions → выберите workflow run

## Troubleshooting

### PHPUnit тесты падают

Проверьте что `.env.example` содержит корректные настройки для testing окружения:
```env
DB_CONNECTION=sqlite
DB_DATABASE=:memory:
```

### Docker build fails

1. Проверьте что Dockerfile правильно копирует frontend assets
2. Убедитесь что `frontend-build` artifact успешно создан
3. Проверьте логи в Actions

### SSH deployment fails

1. Проверьте что SSH_PRIVATE_KEY содержит валидный ключ (включая `-----BEGIN/END-----`)
2. Убедитесь что сервер доступен: `ssh -p PORT USER@HOST`
3. Проверьте что путь `/opt/run-app` существует

### GHCR authentication fails

1. Убедитесь что `permissions: packages: write` установлен в build-images.yml
2. `GITHUB_TOKEN` должен иметь права на packages
3. Для private repo убедитесь что сервер авторизован в GHCR

## Стоимость

Для private repositories:
- **Free tier**: 2,000 минут/месяц
- **Estimated usage**: ~630 минут/месяц (100 pushes + 10 deploys)

Для public repositories: **бесплатно** и без ограничений.

## Best Practices

1. Всегда создавайте feature branches и PR для изменений
2. Дождитесь прохождения всех проверок перед merge
3. Используйте семантическое версионирование для тегов (v1.2.3)
4. Тестируйте деплой на staging перед продакшн (если доступен)
5. Регулярно обновляйте dependencies через Dependabot

## Миграция с GitLab CI

Если вы мигрируете с GitLab CI:

- `.gitlab-ci.yml` больше не используется - можно удалить
- Docker registry изменен с GitLab на GHCR (ghcr.io)
- Обновите `docker-compose.yml` на сервере для использования GHCR образов
- Все CI/CD переменные (`CI_*`) заменены на GitHub Actions аналоги

## Поддержка

При возникновении проблем:
1. Проверьте логи в Actions tab
2. Убедитесь что все secrets настроены
3. Проверьте Environment protection rules
4. Создайте issue с описанием проблемы
