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
                <a class="flex items-center p-2 text-base font-normal text-white dark:text-white hover:bg-green-600 dark:hover:bg-gray-700 group" href="{{ route('poktan.sidebarpoktan') }}">
                <i class="fa-solid fa-home ml-3 mr-3"></i>
                <span>Beranda</span>
                </a>
            </li>
            <li>
                <a class="flex items-center p-2 text-base font-normal text-white dark:text-white bg-green-800 group" href="{{ route('poktan.peminjaman') }}">
                <i class="fa-solid fa-file ml-3 mr-5"></i>
                <span>Peminjaman</span>
                </a>
            </li>
            <li>
                <a class="flex items-center p-2 text-base font-normal text-white dark:text-white hover:bg-green-600 dark:hover:bg-gray-700 group" href="{{ route('poktan.tagihan') }}">
                <i class="fa-solid fa-file ml-3 mr-5"></i>
                <span>Pengembalian</span>
                </a>
            </li>
            <li class="mb-4">
                <a class="flex items-center p-2 text-base font-normal text-white dark:text-white hover:bg-green-600 dark:hover:bg-gray-700 group" href="{{ route('poktan.laporan') }}">
                    <i class="fa-solid fa-file ml-3 mr-5"></i>
                    <span>Laporan</span>
                </a>
            </li>
            <li>
                <a class="flex items-center p-2 text-base font-normal text-white dark:text-white hover:bg-green-600 dark:hover:bg-gray-700 group" href="{{ route('poktan.pemerintah') }}">
                    <i class="fa-solid fa-user ml-3 mr-4"></i>
                    <span>Pemerintah</span>
                </a>
            </li>
            <li>
                <a class="flex items-center p-2 text-base font-normal text-white dark:text-white hover:bg-green-600 dark:hover:bg-gray-700 group" href="{{ route('poktan.petani') }}">
                    <i class="fa-solid fa-user ml-3 mr-4"></i>
                    <span>Petani</span>
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
                <a class="flex items-center p-2 rounded-full mx-4 mt-4 bg-green-50 h-18 text-base font-normal text-white dark:text-white group" href="{{ route('poktan.profilpoktan') }}">
                    <i class="fa-solid fa-user fa-2x ml-3 mr-4 text-green-800"></i>
                    <div class="flex flex-col justify-top">
                        <h1 class="text-2x1 text-gray-600 font-bold">{{ Auth::user()->nama_poktan ?? 'Nama Pengguna' }}</h1>
                        <h2 class="text-sm text-gray-600 font-semibold">Poktan</h1>
                    </div>
                </a>

            </li>
            </ul>
        </div>
    </aside>
    <div class="w-full h-auto flex flex-col bg-gray-50">
        <div class="px-8 flex flex-col py-4 mt-4 mr-4 ml-64 w-auto h-auto">
            <h1 class="text-3xl font-bold text-green-400 mb-4">Detail Pengajuan Modal</h1>
            <hr class="border-b-4 border-green-400 w-auto mt-2">
        </div>
        <div class="w-auto ml-64 min-h-screen pt-3">
            <div class="p-8 w-full">
                <form action="" method="POST" style="z-index: -1;">
                    <div class="bg-green-50 rounded-xl shadow-lg">
                        <h1 class="text-2xl pt-4 font-semibold justify-center flex mb-4">Data Pengajuan Modal {{ $detailpeminjaman->id_petani }} </h1>
                        <hr class="border-b-2 border-green-500 my-3">
                        <div class="px-10 py-5">
                            <!-- Input fields -->
                            <div class="flex items-center mb-5">
                                <label for="jml_pinjam" class="inline-block w-1/3 mr-5 text-left font-bold text-gray-600">Nama Petani</label>
                                <p class="mr-4">:</p>
                                <input readonly value="{{ $detailpeminjaman->petani->nama_petani }}" id="nama_petani" name="nama_petani" class="flex-1 py-2 px-2 rounded-xl focus:border-green-400 justify-between text-gray-600 placeholder-gray-400 shadow-md outline-none" >
                                </input>
                            </div>
                            <div class="flex items-center mb-5">
                                <label for="jml_pinjam" class="inline-block w-1/3 mr-5 text-left font-bold text-gray-600">Pekerjaan</label>
                                <p class="mr-4">:</p>
                                <input readonly value="{{ $detailpeminjaman->petani->pekerjaan }}" id="pekerjaan" name="pekerjaan" class="flex-1 py-2 px-2 rounded-xl focus:border-green-400 justify-between text-gray-600 placeholder-gray-400 shadow-md outline-none" >
                                </input>
                            </div>
                            <div class="flex items-center mb-5">
                                <label for="jml_pinjam" class="inline-block w-1/3 mr-5 text-left font-bold text-gray-600">Alamat</label>
                                <p class="mr-4">:</p>
                                <input readonly value="{{ $detailpeminjaman->petani->alamat_petani }}" id="alamat_petani" name="alamat_petani" class="flex-1 py-2 px-2 rounded-xl focus:border-green-400 justify-between text-gray-600 placeholder-gray-400 shadow-md outline-none" >
                                </input>
                            </div>
                            <div class="flex items-center mb-5">
                                <label for="jml_pinjam" class="inline-block w-1/3 mr-5 text-left font-bold text-gray-600">No. Telepon</label>
                                <p class="mr-4">:</p>
                                <input readonly value="{{ $detailpeminjaman->petani->no_tlp }}" id="jml_pinjam" name="jml_pinjam" class="flex-1 py-2 px-2 rounded-xl focus:border-green-400 justify-between text-gray-600 placeholder-gray-400 shadow-md outline-none" >
                                </input>
                            </div>
                            <div class="flex items-center mb-5">
                                <label for="jml_pinjam" class="inline-block w-1/3 mr-5 text-left font-bold text-gray-600">Jumlah Peminjaman</label>
                                <p class="mr-4">:</p>
                                <input readonly value="{{ $detailpeminjaman->jml_pinjam }}" id="jml_pinjam" name="jml_pinjam" class="flex-1 py-2 px-2 rounded-xl focus:border-green-400 justify-between text-gray-600 placeholder-gray-400 shadow-md outline-none" >
                                </input>
                            </div>
                            <div class="flex items-center mb-5">
                                <label for="jumlah_diterima" class="inline-block w-1/3 mr-5 text-left font-bold text-gray-600">Jumlah Diterima</label>
                                <p class="mr-4">:</p>
                                <input readonly value="{{ $detailpeminjaman->jml_diterima }}" id="jml_diterima" name="jml_diterima" class="flex-1 py-2 px-2 rounded-xl focus:border-green-400 justify-between text-gray-600 placeholder-gray-400 shadow-md outline-none" >
                                </input>
                            </div>
                            <div class="flex items-center mb-5">
                                <label for="bunga" class="inline-block w-1/3 mr-5 text-left font-bold text-gray-600">Bunga</label>
                                <p class="mr-4">:</p>
                                <input readonly value="{{ $detailpeminjaman->bunga }}" type="number" id="bunga" name="bunga" class="flex-1 py-2 px-2 rounded-xl focus:border-green-400 text-gray-600 placeholder-gray-400 shadow-md outline-none">
                            </div>
                            <div class="flex items-center mb-5">
                                <label for="tgl_pinjam" class="inline-block w-1/3 mr-5 text-left font-bold text-gray-600">Tanggal Pinjam</label>
                                <p class="mr-4">:</p>
                                <input readonly value="{{ explode(' ',$detailpeminjaman->tgl_pinjam)[0] }}" type="date" id="tgl_pinjam" name="tgl_pinjam" class="flex-1 py-2 px-2 rounded-xl focus:border-green-400 text-gray-600 placeholder-gray-400 shadow-md outline-none">
                            </div>
                            <div class="flex items-center mb-5">
                                <label for="tenggat_kembali" class="inline-block w-1/3 mr-5 text-left font-bold text-gray-600">Tanggal Kembali</label>
                                <p class="mr-4">:</p>
                                <input readonly value="{{ explode(' ',$detailpeminjaman->tgl_kembali)[0] }}" type="date" id="tenggat_kembali" name="tenggat_kembali" class="flex-1 py-2 px-2 rounded-xl focus:border-green-400 text-gray-600 placeholder-gray-400 shadow-md outline-none">
                            </div>
                            <div class="flex items-center mb-5">
                                <label for="tenggat_kembali" class="inline-block w-1/3 mr-5 text-left font-bold text-gray-600">Ststus Pengajuan</label>
                                <p class="mr-4">:</p>
                                <input readonly value="{{ $detailpeminjaman->status->status_pengajuan }}" type="text" name="tenggat_kembali" class="flex-1 py-2 px-2 rounded-xl focus:border-green-400 text-gray-600 placeholder-gray-400 shadow-md outline-none">
                            </div>
                        </div>
                    </div>
                </form>

                <div class="flex justify-end mt-4 mr-2">
                @if (strtolower($detailpeminjaman->status->status_pengajuan) == 'belum dikonfirmasi')
                        <form action="{{ route('peminjaman.tolak', $detailpeminjaman->id_pengajuan) }}" method="POST">
                            @csrf
                            <button class="mr-4 h-10 bg-red-400 px-10 shadow-lg font-semibold rounded-md text-white" type="submit">
                                Tolak
                            </button>
                        </form>
                        <form action="{{ route('peminjaman.konfirmasi', $detailpeminjaman->id_pengajuan) }}" method="POST">
                            @csrf
                            <button class="h-10 bg-green-400 px-10 shadow-lg font-semibold rounded-md text-white" type="submit">
                            Konfirmasi
                            </button>
                        </form>
                        @else
                        <a href="{{ route('poktan.peminjaman') }}" class="py-2 bg-green-400 px-10 shadow-lg font-semibold rounded-md text-white">
                            Kembali
                        </a>
                        @endif
                    </div>
                

            </div>
        </div>
    </div>


</body>
</html>
