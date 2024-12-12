<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ _env('APP_NAME', 'My Sandbox Leaf MVC Chinook App') }}</title>
    <link rel="shortcut icon" href="https://leafphp.dev/logo-circle.png" type="image/x-icon">

    {{--
    assets() pointe vers le dossier public/assets
     --}}
    <link rel="stylesheet" href="{{ assets('css/styles.css') }}">

    {{--

        Vous voulez garder tous vos css et js dans le dossier public
        sauf si vous utilisez un bundler comme vite. vite() cherche les assets dans
        le dossier app/views par defaut. Vous pouvez commenter la ligne ci-dessous
        pour utiliser vite.

        Assurez-vous de lancer `npm install` et ensuite `npm run dev` ou `npm run build`
    --}}
    {{-- {{ vite('css/app.css') }} --}}

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="overflow-hidden">
@if (isset($errors) && $errors) > 0)
    <div class="flex flex-col justify-center items-center min-h-96 w-full max-w-[500px] bg-[url(/public/assets/img/eclipse.svg)] bg-cover pt-28">
        <ul>
            @foreach ($errors as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @yield('content')
    {{ $slot }}
</body>
    @yield('script')
</html>
