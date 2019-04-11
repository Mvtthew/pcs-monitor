<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="/favicon.png">

    <title>
        PCS-monitor | Mvtthew
    </title>

    {{-- Styles --}}
    <link rel="stylesheet" href="/css/app.css?v=2">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@1.9.3/css/boxicons.min.css' rel='stylesheet'>

    {{-- Scripts --}}
    <script src="/js/app.js" defer></script>
    <script src="/js/front.js" defer></script>

</head>
<body>
<main id="app">
    @include('inc.navbar')
    <div class="container my-4">
        @yield('content')
    </div>
</main>
</body>
</html>