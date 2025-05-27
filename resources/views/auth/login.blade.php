<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Academy Management System</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

    {{-- Stylesheet --}}
    @vite('resources/css/app.css')

    {{-- Tabler Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet" />
</head>

<body>

    {{-- Disaply alert message --}}
    @if (session('success'))
    <x-alert type="success" message="{{session('success')}}" />
    @endif


    <!-- Main -->
    <div
        class="flex min-h-full flex-col justify-center px-6 py-12 h-dvh  items-center bg-white rounded-lg border border-slate-200 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-auto w-15" src="/img/logo.png" alt="Your Company logo">
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign in to your account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" method="POST">
                @csrf
                <x-input-box :row="false" lable="Email Address" name="email" id="email" placeholder="your@mail.com"
                    icon="mail" />

                <x-input-box :row="false" lable="Password" name="password" type="password" id="password"
                    placeholder="********" icon="password" />

                <div class="grid">
                    <x-button-primary>Log in</x-button-primary>
                </div>
            </form>
        </div>
    </div>


    {{-- Javascript --}}
    @vite('resources/js/app.js')

    {{-- to remove hash from client side --}}
    @if (session('success'))
    <script>
        history.replaceState(null, "", window.location.pathname + window.location.search);
    </script>
    @endif
</body>

</html>