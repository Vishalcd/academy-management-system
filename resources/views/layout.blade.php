<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{$title ?? "Parishkar School Sds | Accounting
        Management System"}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Stylesheet --}}
    @vite('resources/css/app.css')

    {{-- Tabler Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />

</head>

<body>

    {{-- Disaply alert message --}}
    @if (session('success'))
    <x-alert type="success" message="{{session('success')}}" />
    @else
    <x-alert type="error" message="{{session('error')}}" />
    @endif

    <!-- Modal -->
    <x-modal />

    {{-- Mobile-Nav --}}
    <x-mobile-nav />

    <!-- Header -->
    <x-header />

    <!-- Main -->
    <div class="container">
        {{$slot}}
    </div>

    <!-- Footer -->
    <x-footer />

    {{-- Javascript --}}
    @vite('resources/js/app.js')

    <!-- Inject page-specific scripts -->
    @yield('scripts')

    {{-- to remove hash from client side --}}
    @if (session('success'))
    <script>
        history.replaceState(null, "", window.location.pathname + window.location.search);
    </script>
    @endif
</body>

</html>