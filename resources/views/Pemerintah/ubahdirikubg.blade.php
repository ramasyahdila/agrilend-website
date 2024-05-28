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
                <a class="flex items-center p-2 text-base font-normal text-white dark:text-white hover:bg-green-600 dark:hover:bg-gray-700 group" href="{{ route('pemerintah.poktan') }}">
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
            <h1 class="text-3xl font-bold text-green-400 mb-4">Profil Anda</h1>
            <hr class="border-b-4 border-green-400 w-auto mt-2">
        </div>

        <div class="flex h-full w-auto mt-8 ml-64">
            <form action="{{ route('pemerintah.ubahprofile') }}" method="post" class="flex flex-col mx-24 w-full items-right">
                @if ($errors->any())
                <div class="mt-2 mb-5 text-center bg-red-100 border-2 border-red-500 text-sm text-red-500 rounded-lg p-6 dark:bg-red-500/10" role="alert">
                    <span class="font-bold">Peringatan!</span> {{ $errors->first() }}
                </div>
                @endif
                @if (session('success'))
                    <div class="mt-2 mb-5 text-center bg-green-100 border-2 border-green-500 text-sm text-green-500 rounded-lg p-6 dark:bg-red-500/10" role="alert">
                        <span class="font-bold">Pemberitahuan!</span> {{ Session::get('success') }}
                    </div>
                @endif
                <div class="w-full">
                    @csrf
                    <div class="flex mb-8">
                        <label for="nama_pemerintah" class="block text-gray-900 font-bold w-1/3">Nama Pemerintah</label>
                        <input type="text" name="nama_pemerintah" class="appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight shadow-md focus:outline-none focus:shadow-outline" placeholder="Siapa Gituu" value="{{ $pemerintah->nama_pemerintah }}">
                    </div>
                    <div class="flex mb-8">
                        <label for="kota" class="block text-gray-900 font-bold w-1/3">Kota</label>
                        <select id="kota" name="kota" class="border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight shadow-md focus:outline-none focus:shadow-outline" >
                            @foreach ($kota as $kot)
                            <option @if ($kot->kota == $pemerintah->kota)
                                @selected(true)
                            @endif value="{{ $kot->kota }}">{{ $kot->kota }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex mb-8">
                        <label for="no_telp" class="block text-gray-900 font-bold w-1/3">No. Telepon</label>
                        <input type="text" name="no_telp" class="appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight shadow-md focus:outline-none focus:shadow-outline" placeholder="Poktan Melati" value="{{$pemerintah->no_tlp}}">
                    </div>
                </div>
                <div class="flex text-right justify-center space-x-8">
                    <div class="text-right object-right mb-7 mt-3">
                        <a href="{{ route('pemerintah.profile') }}" class="py-3 rounded-xl shadow px-8 bg-red-400 text-white font-bold" style="z-index: 5;">Batal</a>
                    </div>
                    <div class="text-right object-right mb-8">
                        <button type="submit" class="py-3 rounded-xl shadow px-8 bg-green-400 text-white font-bold" style="z-index: 5;">Simpan</button>
                    </div>
                </div>
            </form>
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

