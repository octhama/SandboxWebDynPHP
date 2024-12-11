@extends('layouts.app')

@section('content')
    <div class="flex flex-col justify-center items-center min-h-96 w-full max-w-[500px] bg-[url(/public/assets/img/eclipse.svg)] bg-cover pt-28">
        <h1 class="text-6xl font-light">Créer un client</h1>
    </div>

    <div class="flex flex-col justify-center items-center min-h-96 w-full max-w-[500px] bg-[url(/public/assets/img/eclipse.svg)] bg-cover pt-28">
        <form action="/customers" method="post" class="flex flex-col gap-4">
            @include('customers._form')
            <button type="submit" class="border border-slate-300 hover:border-slate-500 py-3 px-6 rounded-full">Enregistrer</button>
        </form>
    </div>
@endsection
