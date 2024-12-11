@extends ('layouts.app')

@section('content')
    <h1>Hello poto</h1>
    <div class="mt-16 mb-32 rounded-xl border border-[rgba(172,175,176,0.3)] py-3 px-8 [font-family:Berkeley_Mono]">
    <input type="text" class="border border-slate-300 hover:border-slate-500 py-3 px-6 rounded-full" placeholder="Search">
    </div>
    <a href="/about">Retour vers la page about</a>
@endsection
