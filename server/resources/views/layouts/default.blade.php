<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="favicon.png">

    <title>
        PCS-monitor | Mvtthew
    </title>

    {{-- Styles --}}
    <link rel="stylesheet" href="/css/app.css">

    {{-- Scripts --}}
    <script src="/js/app.js" defer></script>

</head>
<body>
<main id="app">
    @include('inc.navbar')
    @yield('content')
</main>
</body>
</html>