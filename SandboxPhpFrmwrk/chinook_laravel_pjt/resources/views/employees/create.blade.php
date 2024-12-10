@extends('layouts.app')

@section('title', 'Ajouter un employé')

@section('content')
    <div class="container my-4">
        <h1>Ajouter un employé</h1>
        @include('employees._form', [
            'action' => route('employees.store'),
            'method' => 'POST',
            'employee' => null,
            'buttonText' => 'Ajouter'
        ])
        <a href="{{ route('employees.index') }}" class="btn btn-secondary mt-3">Retour</a>
    </div>
@endsection
