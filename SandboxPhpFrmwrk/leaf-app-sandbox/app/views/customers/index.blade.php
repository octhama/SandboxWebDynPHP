@extends('layouts.app')

@section('content')
    <div class="flex flex-col justify-center items-center min-h-96 w-full max-w-[500px] bg-[url(/public/assets/img/eclipse.svg)] bg-cover pt-28">
        <p>{{$titre}}</p>
        <a href="customer/create" class="border border-slate-300 hover:border-slate-500 py-3 px-6 rounded-full">Ajouter un client</a>
        <a href="customer/edit" class="border border-slate-300 hover:border-slate-500 py-3 px-6 rounded-full">Modifier un client</a>
        <a href="customer/delete" class="border border-slate-300 hover:border-slate-500 py-3 px-6 rounded-full">Supprimer un client</a>
        <a href="customer" class="border border-slate-300 hover:border-slate-500 py-3 px-6 rounded-full">Retour</a>

        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Ville</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->FirstName }}</td>
                        <td>{{ $customer->LastName }}</td>
                        <td>{{ $customer->City }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

