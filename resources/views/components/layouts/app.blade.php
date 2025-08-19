<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <x-head />
    <title>{{ $title ?? 'Page Title' }}</title>
</head>

<body>

    {{-- Navbar --}}
    <section class="geo-bg">
        {{-- Navbar component --}}
        <x-navbar />
        {{ $slot }}

    </section>
    <x-footer />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>
</body>

</html>
