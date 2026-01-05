@extends('layouts.app')

@section('title', 'Dashboard — Runtracker')

@section('content')
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="text-center">
            <h1 class="text-3xl font-bold font-display mb-4">Dashboard</h1>
            <p class="text-muted-foreground">Добро пожаловать, {{ auth()->user()->email }}!</p>
        </div>
    </div>
@endsection
