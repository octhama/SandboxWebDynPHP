@extends('layouts.app')

@section('title', 'Bienvenue sur notre application Chinook Laravel App Sandbox')

@section('content')
    <div class="container text-center my-5">
        <h1 class="display-4">Bienvenue sur notre application Chinook Laravel App Sandbox !</h1>
        <p class="lead">Gérez vos clients et employés facilement grâce à notre interface conviviale.</p>

        <div class="my-4">
            <img src="https://source.unsplash.com/800x400/?business,team" alt="Accueil" class="img-fluid rounded shadow-lg">
        </div>

        <div class="my-4">
            <a href="{{ route('customers.index') }}" class="btn btn-primary btn-lg me-2">
                Gérer les clients
            </a>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary btn-lg">
                Gérer les employés
            </a>
        </div>
    </div>
@endsection
