<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    @include('layouts.styles')
    @stack('style')
</head>

<body class="font-poppins text-[#0A090B]">
    <section id="content" class="flex">
        @include('layouts.sidebar')

        {{-- @yield('content') --}}
        {{ $slot }}
    </section>

    @stack('script')

    @include('layouts.script')
</body>

</html>
