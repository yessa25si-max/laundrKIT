<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'LaundrKIT - Quality Laundry Service')</title>

    {{-- Partial View: CSS Stylesheet --}}
    @include('guest.partials.css')
    @stack('styles')
</head>
<body>

    {{-- Partial View: Header & Navbar --}}
    @include('guest.partials.header')

    {{-- Partial View: Alerts / Notifikasi --}}
    @include('guest.partials.alerts')

    {{-- Main Content Halaman Guest --}}
    <main class="guest-main">
        @yield('content')
    </main>

    {{-- Partial View: Footer --}}
    @include('guest.partials.footer')

    {{-- Partial View: JS Scripts --}}
    @include('guest.partials.js')
    @stack('scripts')
</body>
</html>

