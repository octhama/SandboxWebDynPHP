@extends('layouts.app')

@section('title', 'Modifier un employé')

@section('content')
    <div class="container my-4">
        <h1>Modifier l'employé</h1>
        @include('employees._form', [
            'action' => route('employees.update', $employee->EmployeeId),
            'method' => 'PUT',
            'employee' => $employee,
            'buttonText' => 'Modifier'
        ])
        <a href="{{ route('employees.index') }}" class="btn btn-secondary mt-3">Retour</a>
    </div>
@endsection
