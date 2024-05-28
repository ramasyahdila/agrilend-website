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
<body class="flex h-screen">
<aside class="fixed top-0 left-0 w-64 h-full" aria-label="Sidenav">
        <div class="overflow-y-auto py-5 h-full bg-green-400 border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <img src="{{ asset('img/AgrilendLogo.png') }}" alt="Logo" class="w-auto h-auto">
            <hr class="mt-6 border-2 border-green-50"></hr>
            <ul class="space-y-2 mt-8 sidebar-link">
            <li>
                <a class="flex items-center p-2 text-base font-normal text-white dark:text-white hover:bg-green-600 dark:hover:bg-gray-700 group" href="{{ route('dashboard.pemerintah') }}">
                <i class="fa-solid fa-home ml-3 mr-3"></i>
                <span>Beranda</span>
                </a>
            </li>
            <li class="mb-4">
                <a class="flex items-center p-2 text-base font-normal text-white dark:text-white hover:bg-green-600 dark:hover:bg-gray-700 group" href="{{ route('pemerintah.laporan') }}">
                    <i class="fa-solid fa-file ml-3 mr-5"></i>
                    <span>Laporan</span>
                </a>
            </li>
            <li>
                <a class="flex items-center p-2 text-base font-normal text-white dark:text-white bg-green-800 group" href="{{ route('pemerintah.poktan') }}">
                    <i class="fa-solid fa-user ml-3 mr-4"></i>
                    <span>Poktan</span>
                </a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST" class="flex items-center">
                    @csrf
                    <button type="submit" class="flex bg-red-400 items-center p-2 text-base font-normal text-white w-full dark:text-white hover:bg-red-600 dark:hover:bg-red-600 group">
                        <i class="fa-solid fa-arrow-right-from-bracket ml-3 mr-4"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </li>
            <li class="flex h-44"></li>
            <hr></hr>
            <li>
                <a class="flex items-center p-2 rounded-full mx-4 mt-4 bg-green-50 h-18 text-base font-normal text-white dark:text-white group" href="{{ route('pemerintah.profile') }}">
                    <i class="fa-solid fa-user fa-2x ml-3 mr-4 text-green-800"></i>
                    <div class="flex flex-col justify-top">
                        <h1 class="text-2x1 text-gray-600 font-bold">{{ Auth::user()->nama_pemerintah ?? 'Nama Pengguna' }}</h1>
                        <h2 class="text-sm text-gray-600 font-semibold">Pemerintah</h1>
                    </div>
                </a>

            </li>
            </ul>
        </div>
    </aside>
    <div class="w-full h-full flex flex-col bg-gray-50">
        <div class="px-8 flex flex-col py-4 mt-4 mr-4 ml-64 w-auto h-auto mb-2">
            <h1 class="text-3xl font-bold text-green-400 mb-4">Profil Petani</h1>
            <hr class="border-b-4 border-green-400 w-auto mt-2">
        </div>

    <div class="flex flex-col -full">
        <div class="flex w-full">
            <div class="flex flex-col mt-8 mx-24 w-full justify-center items-center">
                {{-- <h1>{{  dd($dataPoktan) }}</h1> --}}
            </div>
        </div>
    </div>

        <div class="flex h-full w-auto  ml-64">
            <div class="flex flex-col mx-24 w-full items-right">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 alert-dismiss" role="alert">
                        <strong class="font-bold">Sukses!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                <form class="w-full">
                    <div class="flex mb-8">
                        <label for="nama_poktan" class="block text-gray-900 font-bold w-1/3">Nama Poktan</label>
                        <input type="text" id="nama_poktan" class="appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight shadow-md focus:outline-none focus:shadow-outline" placeholder="Siapa Gituu" value="{{ $poktan->nama_poktan }}" readonly>
                    </div>
                    <div class="flex mb-8">
                        <label for="alamat_poktan" class="block text-gray-900 font-bold w-1/3">Alamat Poktan</label>
                        <input type="text" id="alamat_poktan" class="appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight shadow-md focus:outline-none focus:shadow-outline" placeholder="alamat" value="{{$poktan->alamat_poktan}}" readonly>
                    </div>
                    <div class="flex mb-8">
                        <label for="no_telp" class="block text-gray-900 font-bold w-1/3">No. Telepon</label>
                        <input type="text" id="no_telp" class="appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight shadow-md focus:outline-none focus:shadow-outline" placeholder="Poktan Melati" value="{{$poktan->no_tlp}}" readonly>
                    </div>
                    <div class="flex mb-8">
                        <label for="Pemerintah" class="block text-gray-900 font-bold w-1/3">Nama Pemerintah</label>
                        <input type="nama_pemerintah" id="nama_pemerintah" class="appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight shadow-md focus:outline-none focus:shadow-outline" placeholder="Jl. Melati No.05 Lumajang" value="{{ $poktan->nama_pemerintah}}" readonly>
                    </div>
                </form>
                <div class="flex justify-end mt-4 mr-2">
                    <a href="{{ route('pemerintah.poktan') }}">
                        <button class="h-10 bg-green-400 px-10 shadow-lg font-semibold rounded-md text-white" type="button">
                            Kembali
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mencari elemen dengan kelas 'alert-dismiss' dan menyembunyikannya setelah 3 detik
        setTimeout(function() {
            document.querySelector('.alert-dismiss').style.display = 'none';
        }, 3000);
    </script>
</body>
</html>
