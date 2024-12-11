@extends 'layouts.app')

@section('content')
    <div class="flex flex-col justify-center items-center min-h-96 w-full max-w-[500px] bg-[url(/public/assets/img/eclipse.svg)] bg-cover pt-28">
        <h1 class="text-6xl font-light">Modifier un client</h1>
        <p class="text-lg mt-5">Modifier un client</p>
    </div>

    <div class="mt-16 mb-32 rounded-xl border border-[rgba(172,175,176,0.3)] py-3 px-8 [font-family:Berkeley_Mono]">
        <form action="/customers/{{ $customer->id }}" method="POST">
            @csrf
            @method('PATCH')
            @include('customers._form')
        </form>
    </div>

    <div class="flex gap-5">
        <a class="border border-slate-300 hover:border-slate-500 py-3 px-6 rounded-full" href="/customers"
            target="_blank">Retour</a>
    </div>

@endsection
