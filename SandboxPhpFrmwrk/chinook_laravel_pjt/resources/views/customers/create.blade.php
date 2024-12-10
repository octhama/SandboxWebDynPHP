@extends('layouts.app')

@section('title', 'Ajouter un client')

@section('content')
    <div class="container my-4">
        <h1>Ajouter un client</h1>
        @include('customers._form', [
            'action' => route('customers.store'),
            'method' => 'POST',
            'customer' => null,
            'buttonText' => 'Ajouter'
        ])
        <a href="{{ route('customers.index') }}" class="btn btn-secondary mt-3">Retour</a>
    </div>
@endsection
