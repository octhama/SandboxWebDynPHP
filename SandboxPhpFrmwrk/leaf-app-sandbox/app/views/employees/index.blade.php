@extends('layouts.app')

@section('content')
    <div class="flex flex-col justify-center items-center min-h-96 w-full max-w-[500px] bg-[url(/public/assets/img/eclipse.svg)] bg-cover pt-28">
        <h1 class="text-6xl font-light">Liste des employé</h1>
        <a href="employees/create" class="border border-slate-300 hover:border-slate-500 py-3 px-6 rounded-full">Ajouter un employé</a>
        <a href="employees" class="border border-slate-300 hover:border-slate-500 py-3 px-6 rounded-full">Retour</a>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Titre</th>
                    <th>Date de naissance</th>
                    <th>Pays</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->FirstName }}</td>
                        <td>{{ $employee->LastName }}</td>
                        <td>{{ $employee->Title }}</td>
                        <td>{{ $employee->BirthDate }}</td>
                        <td>{{ $employee->Country }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

