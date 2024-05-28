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
<body class="flex flex-col h-screen">
    <header class="fixed h-16 w-full bg-white shadow-lg z-10">
        <div class="mx-4 h-full flex justify-between p-2">
            <img src="{{ asset('img/AgrilendLogo.png') }}" alt="Logo" class="w-auto h-auto">     
        </div>
    </header>
    <div class="flex h-full z-0 pt-16">
        <div class="w-1/3 h-full bg-cover bg-center" style="background-image: url(img/LoginPage.jpg)"></div>
        <div class="w-2/3 flex h-full items-center justify-center bg-green-400">
            <!-- Gambar kanan bawah -->
            <div class="w-2/3 bg-transparent p-8 m-auto rounded-lg z-10">
                <h2 class="text-4xl font-bold mb-4 text-center text-white mb-16">Silahkan Pilih Role Anda</h2>
                <form action="#" method="post" class="flex justify-between space-x-8 items-center">
                    <a href="{{ route('register') }}" class="h-40 w-40 bg-white rounded-lg shadow-md border-4 border-green-800 text-green-400 text-center flex items-center justify-center text-2xl font-bold">Petani</a>
                    <a href="{{ route('registerpoktan') }}" class="h-40 w-40 bg-white rounded-lg shadow-md border-4 border-green-800 text-green-400 text-center flex items-center justify-center text-2xl font-bold">Poktan</a>
                    <a href="{{ route('registerpemerintah') }}" class="h-40 w-40 bg-white rounded-lg shadow-md border-4 border-green-800 text-green-400 text-center flex items-center justify-center text-2xl font-bold">Pemerintah</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>