<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <title>@yield('title')</title>
</head>
<body class="flex flex-col">
    <header class="h-16 w-full bg-white shadow-lg z-10">
        <div class="mx-4 h-full flex justify-between p-2">
            <img src="{{ asset('img/AgrilendLogo.png') }}" alt="Logo" class="w-auto h-auto">     
        </div>
    </header>
    <div class="bg-cover bg-center z-0" style="background-image: url('img/Login.png');">
        <div class="bg-gradient-to-r from-green-900 to-transparent bg-opacity-0">
            <div class="flex h-screen items-center justify-center p-5">
                <div class="grid md:grid-cols-2 grid-cols-1 items-center gap-10 md:px-10">
                    <div>
                        <h1 class="mb-2 text-3xl font-bold text-white">AGRILEND</h1>
                        <p class="mb-6 text-white">Agrilend memudahkan akses modal untuk pengembangan usaha pertanian dan mendorong pertumbuhan sektor pertanian secara berkelanjutan</p>
                        <div class="flex justify-start space-x-5">
                            <a href="{{ route('login') }}" class="btn flex bg-green-600 text-white items-center justify-center gap-1 rounded-lg px-4 w-32 py-2 font-semibold">LOGIN</a>

                            <a href="{{ route('pilihaktor') }}" class="flex items-center text-green-600 justify-center gap-2 rounded-lg bg-white px-4 w-32 py-2 font-semibold">
                                REGISTER
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>