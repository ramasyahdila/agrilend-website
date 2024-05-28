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
    <div class="w-full h-full flex flex-col bg-gray-50">
        <div class="px-8 flex flex-col py-4 mt-4 mr-4 ml-64 w-auto h-auto">
            <h1 class="text-3xl font-bold text-green-400 mb-4">Form Ubah Pengajuan Modal</h1>
            <hr class="border-b-4 border-green-400 w-auto mt-2">
        </div>
        <div class="w-auto ml-64 min-h-screen pt-3">
            <div class="p-8 w-full">
                <form action="{{ route('update.peminjaman', ['id' => $ubahpeminjaman->id_pengajuan]) }}" method="POST" style="z-index: -1;">
                    @csrf
                    <div class="bg-green-50 rounded-xl shadow-lg">
                        <h1 class="text-2xl pt-4 font-semibold justify-center flex mb-4">Silahkan isi data berikut dengan lengkap</h1>
                        <hr class="border-b-2 border-green-500 my-3">
                        <div class="px-10 py-5">
                            <!-- Input fields -->
                            <div class="flex items-center mb-5">
                                <label for="jml_pinjam" class="inline-block w-1/3 mr-5 text-left font-bold text-gray-600">Jumlah Peminjaman</label>
                                <p class="mr-4">:</p>
                                <select id="jml_pinjam" value="{{ $ubahpeminjaman->jml_pinjam }}" name="jml_pinjam" class="flex-1 py-2 px-2 rounded-xl focus:border-green-400 justify-between text-gray-600 placeholder-gray-400 shadow-md outline-none" >
                                    <option value="500000">500.000</option>
                                    <option value="1000000">1.000.000</option>
                                </select>
                            </div>
                            <div class="flex items-center mb-5">
                                <label for="jumlah_diterima" class="inline-block w-1/3 mr-5 text-left font-bold text-gray-600">Jumlah Diterima</label>
                                <p class="mr-4">:</p>
                                <select id="jml_diterima" value="{{ $ubahpeminjaman->jml_diterima }}" name="jml_diterima" class="flex-1 py-2 px-2 rounded-xl focus:border-green-400 justify-between text-gray-600 placeholder-gray-400 shadow-md outline-none" >
                                    <option value="500000">500.000</option>
                                    <option value="1000000">1.000.000</option>
                                </select>
                            </div>
                            <div class="flex items-center mb-5">
                                <label for="bunga" class="inline-block w-1/3 mr-5 text-left font-bold text-gray-600">Bunga</label>
                                <p class="mr-4">:</p>
                                <input type="number" id="bunga" value="{{ $ubahpeminjaman->bunga }}" name="bunga" placeholder="Masukan Bunga" class="flex-1 py-2 px-2 rounded-xl focus:border-green-400 text-gray-600 placeholder-gray-400 shadow-md outline-none">
                            </div>
                            <div class="flex items-center mb-5">
                                <label for="tgl_pinjam" class="inline-block w-1/3 mr-5 text-left font-bold text-gray-600">Tanggal Pinjam</label>
                                <p class="mr-4">:</p>
                                <input type="date" id="tgl_pinjam" value="{{ date($ubahpeminjaman->tgl_pinjam) }}" name="tgl_pinjam" placeholder="Masukan Tanggal Pinjam" class="flex-1 py-2 px-2 rounded-xl focus:border-green-400 text-gray-600 placeholder-gray-400 shadow-md outline-none">
                            </div>
                            <div class="flex items-center mb-5">
                                <label for="tenggat_kembali" class="inline-block w-1/3 mr-5 text-left font-bold text-gray-600">Tanggal Kembali</label>
                                <p class="mr-4">:</p>
                                <input type="date" id="tgl_kembali" value="{{ date($ubahpeminjaman->tenggat_kembali) }}" name="tenggat_kembali" placeholder="Masukan Tanggal Kembali" class="flex-1 py-2 px-2 rounded-xl focus:border-green-400 text-gray-600 placeholder-gray-400 shadow-md outline-none">
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-4 mb-4">
                        <a href="{{ route('layout.Peminjaman') }}" class="py-3 rounded-xl px-8 shadow-lg bg-red-600 text-white font-bold mr-4">Batal</a>
                        <button type="submit" name="submit" class="py-3 rounded-xl px-8 shadow-lg bg-green-600 text-white font-bold">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
