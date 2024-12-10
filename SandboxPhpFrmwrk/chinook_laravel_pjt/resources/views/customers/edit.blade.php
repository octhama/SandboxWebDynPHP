@extends('layouts.app')

@section('title', 'Modifier un client')

@section('content')
    <div class="container my-4">
        <h1>Modifier le client</h1>
        @include('customers._form', [
            'action' => route('customers.update', $customer->CustomerId),
            'method' => 'PUT',
            'customer' => $customer,
            'buttonText' => 'Modifier'
        ])
        <a href="{{ route('customers.index') }}" class="btn btn-secondary mt-3">Retour</a>
    </div>
@endsection
