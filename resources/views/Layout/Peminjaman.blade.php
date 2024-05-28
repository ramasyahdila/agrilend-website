<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script> --}}
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
                <a class="flex items-center p-2 text-base font-normal text-white dark:text-white hover:bg-green-600 dark:hover:bg-gray-700 group" href="{{ route('dashboard.petani') }}">
                <i class="fa-solid fa-home ml-3 mr-3"></i>
                <span>Beranda</span>
                </a>
            </li>
            <li>
                <a class="flex items-center p-2 text-base font-normal text-white dark:text-white bg-green-800 group" href="{{ route('layout.Peminjaman') }}">
                <i class="fa-solid fa-file ml-3 mr-5"></i>
                <span>Peminjaman</span>
                </a>
            </li>
            <li>
                <a class="flex items-center p-2 text-base font-normal text-white dark:text-white hover:bg-green-600 dark:hover:bg-gray-700 group" href="{{ route('layout.Tagihan') }}">
                <i class="fa-solid fa-file ml-3 mr-5"></i>
                <span>Pengembalian</span>
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
                <a class="flex items-center p-2 rounded-full mx-4 mt-4 bg-green-50 h-18 text-base font-normal text-white dark:text-white group" href="{{ route('layout.profilpetani') }}">
                    <i class="fa-solid fa-user fa-2x ml-3 mr-4 text-green-800"></i>
                    <div class="flex flex-col justify-top">
                        <h1 class="text-2x1 text-gray-600 font-bold">{{ Auth::user()->nama_petani ?? 'Nama Pengguna' }}</h1>
                        <h2 class="text-sm text-gray-600 font-semibold">Petani</h1>
                    </div>
                </a>

            </li>
            </ul>
        </div>
    </aside>
    <div class="w-full h-auto flex flex-col bg-gray-50">
        <div class="px-8 flex-col py-4 mt-4 mr-4 ml-64 flex w-auto h-auto mb-2">
            <h1 class="text-3xl font-bold text-green-400 mb-4">Peminjaman</h1>
            <hr class="border-b-4 border-green-400 w-auto mt-2">
        </div>
        @foreach ($peminjaman as $peminjaman)
        <div class="px-8 py-0 mt-4 mr-4 ml-64 flex flex-col w-auto h-auto">
            <div class="h-auto w-full bg-green-100 flex items-center justify-between px-16 py-8 rounded-2xl">
                <div class="mr-4 flex">
                    <svg xmlns="http://www.w3.org/2000/svg" height="80" viewBox="0 -960 960 960" width="80">
                        <path
                            d="M240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h287q16 0 30.5 6t25.5 17l194 194q11 11 17 25.5t6 30.5v447q0 33-23.5 56.5T720-80H240Zm280-560v-160H240v640h480v-440H560q-17 0-28.5-11.5T520-640ZM240-800v200-200 640-640Z" />
                    </svg>
                    <div class="flex flex-col ml-8">
                        <h2 class="text-black font-bold text-2xl mb-2">Pengajuan Modal {{ $peminjaman->id_petani }}{{ $loop->iteration }}</h2>
                        <h2 class="text-black font-regular text-lg">Status: {{ $peminjaman->status->status_pengajuan }}</h2>
                    </div>
                </div>
                <div class="flex flex-col text-right ">
                    <h2 class="text-black font-bold text-2xl mb-8">{{ $peminjaman->tgl_pinjam }}</h2>
                    <div class="flex gap-4 justify-between">
                        @if ($peminjaman->status->status_pengajuan == 'Belum Dikonfirmasi')
                            <form action="{{ route('peminjaman.destroy', $peminjaman->id_pengajuan) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-center justify-center items-center bg-red-400 text-white px-8 py-2 rounded-md">Delete</button>
                            </form>
                            <a class="text-center inline-flex justify-center items-center bg-green-400 text-white px-8 py-1 rounded-md"
                            href="{{ route('peminjaman.ubah', ['id' => $peminjaman->id_pengajuan]) }}"><p>Ubah</p></a>
                        @else
                        <div class=""></div>
                        @endif
                        <a class="text-center justify-center bg-transparent text-green-400 px-8 py-1 rounded-md border-4 border-green-400"
                        href="{{ route('peminjamanpetani.detail', ['id' => $peminjaman->id_pengajuan]) }}">Lihat</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
            <div class="flex justify-end mt-4 mr-16">
                    <a href="{{ route('layout.FormTambah') }}">
                        <button class="h-10 bg-green-400 px-10 shadow-lg font-semibold rounded-md text-white" type="button">
                            + Buat
                        </button>
                    </a>
                </div>
            </div>
    </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const currentUrl = window.location.href;
            const sidebarLinks = document.querySelectorAll('.sidebar-link');

            sidebarLinks.forEach(link => {
                if (link.href === currentUrl) {
                    link.classList.add('bg-green-600', 'text-white');
                }
            });
        });
    </script>


</body>
</html>
