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
    <link rel="stylesheet" href="{{ asset('style.css') }}">
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
                <a class="flex items-center p-2 text-base font-normal text-white dark:text-white hover:bg-green-600 dark:hover:bg-gray-700 group" href="{{ route('poktan.peminjaman') }}">
                <i class="fa-solid fa-file ml-3 mr-5"></i>
                <span>Peminjaman</span>
                </a>
            </li>
            <li>
                <a class="flex items-center p-2 text-base font-normal text-white dark:text-white bg-green-800 group" href="{{ route('poktan.tagihan') }}">
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
            <h1 class="text-3xl font-bold text-green-400 mb-4">Pengembalian Poktan</h1>
            <hr class="border-b-4 border-green-400 w-auto mt-2">
        </div>
        <div class="w-auto ml-64 min-h-screen pt-3">
            <div class="p-8 w-full">
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
                @if ($tagihan->id_status_tagihan == 6)
                <div class="flex font-thin gap-4 items-center mb-5">
                    <p>Unduh Tagihan:</p>
                    <form action="{{ route('download.tagihan') }}" method="POST">
                        <input type="hidden" name="id_tagihan" value="{{ $tagihan->id_tagihan }}" id="">
                        <button class="inline-flex bg-white p-2 gap-4 our-shadow rounded-md">
                            <svg width="18" height="24" viewBox="0 0 18 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 0C1.34531 0 0 1.34531 0 3V21C0 22.6547 1.34531 24 3 24H15C16.6547 24 18 22.6547 18 21V7.5H12C11.1703 7.5 10.5 6.82969 10.5 6V0H3ZM12 0V6H18L12 0ZM10.125 10.875V15.6609L11.5781 14.2078C12.0188 13.7672 12.7312 13.7672 13.1672 14.2078C13.6031 14.6484 13.6078 15.3609 13.1672 15.7969L9.79219 19.1719C9.35156 19.6125 8.63906 19.6125 8.20312 19.1719L4.82812 15.7969C4.3875 15.3562 4.3875 14.6438 4.82812 14.2078C5.26875 13.7719 5.98125 13.7672 6.41719 14.2078L7.87031 15.6609V10.875C7.87031 10.2516 8.37187 9.75 8.99531 9.75C9.61875 9.75 10.1203 10.2516 10.1203 10.875H10.125Z" fill="black"/>
                                </svg>
                            <span>Unduh</span>                            
                        </button>
                    </form>
                </div>
                @endif
                <div id="formTagihan" style="z-index: -1;">
                    @csrf
                    <div class="bg-green-50 rounded-xl our-shadow">
                        @if (in_array($tagihan->id_status_tagihan,[2,3,4]) )
                        <h1 class="text-2xl pt-4 font-semibold justify-center flex mb-4">Detail Tagihan Tidak Bisa Bayar</h1>
                        @else
                        <h1 class="text-2xl pt-4 font-semibold justify-center flex mb-4">Detail Tagihan</h1>
                        @endif
                        <hr class="border-b-2 border-green-500 my-3">
                        <div class="px-10 py-5">
                            <!-- Input fields -->
                            <input type="hidden" name="id_tagihan" value="{{ $tagihan->id_tagihan }}" id="">
                            <div class="flex items-center mb-5">
                                <label for="nama_petani" class="inline-block w-1/3 mr-5 text-left font-bold text-gray-600">Nama Petani</label>
                                <p class="mr-4">:</p>
                                <input readonly value="{{ $tagihan->nama_petani }}" id="nama_petani" name="nama_petani" class="flex-1 py-2 px-2 rounded-xl focus:border-green-400 justify-between text-gray-600 placeholder-gray-400 shadow-md outline-none" >
                                </input>
                            </div>
                            <div class="flex items-center mb-5">
                                <label for="alamat_petani" class="inline-block w-1/3 mr-5 text-left font-bold text-gray-600">Alamat Petani</label>
                                <p class="mr-4">:</p>
                                <input readonly value="{{ $tagihan->alamat_petani }}" id="alamat_petani" name="alamat_petani" class="flex-1 py-2 px-2 rounded-xl focus:border-green-400 justify-between text-gray-600 placeholder-gray-400 shadow-md outline-none" >
                                </input>
                            </div>
                            <div class="flex items-center mb-5">
                                <label for="nama_poktan" class="inline-block w-1/3 mr-5 text-left font-bold text-gray-600">Nama Poktan</label>
                                <p class="mr-4">:</p>
                                <input readonly value="{{ $tagihan->nama_poktan }}" id="nama_poktan" name="nama_poktan" class="flex-1 py-2 px-2 rounded-xl focus:border-green-400 justify-between text-gray-600 placeholder-gray-400 shadow-md outline-none" >
                                </input>
                            </div>
                            <div class="flex items-center mb-5">
                                <label for="jml_pinjam" class="inline-block w-1/3 mr-5 text-left font-bold text-gray-600">Jumlah Kembali</label>
                                <p class="mr-4">:</p>
                                <input readonly value="{{ $tagihan->jml_pinjam }}" id="jml_pinjam" name="jml_pinjam" class="flex-1 py-2 px-2 rounded-xl focus:border-green-400 justify-between text-gray-600 placeholder-gray-400 shadow-md outline-none" >
                                </input>
                            </div>
                            <div class="flex items-center mb-5">
                                <label for="tgl_kembali" class="inline-block w-1/3 mr-5 text-left font-bold text-gray-600">Tenggat Kembali</label>
                                <p class="mr-4">:</p>
                                <input readonly value="{{ explode(' ',$tagihan->tgl_kembali)[0] }}" type="date" id="tgl_kembali" name="tgl_kembali" class="flex-1 py-2 px-2 rounded-xl focus:border-green-400 justify-between text-gray-600 placeholder-gray-400 shadow-md outline-none" >
                                </input>
                            </div>
                            <div class="flex items-center mb-5">
                                <label class="inline-block w-1/3 mr-5 text-left font-bold text-gray-600">Metode Bayar</label>
                                <p class="mr-4">:</p>
                                <input readonly type="text" value="{{ $tagihan->metode_bayar ?? 'Belum ada' }}" id="tgl_kembali" name="tgl_kembali" class="flex-1 py-2 px-2 rounded-xl focus:border-green-400 justify-between text-gray-600 placeholder-gray-400 shadow-md outline-none" >
                            </div>
                            @if(in_array($tagihan->id_status_tagihan,[2,3,4]))
                                <div class="flex items-center mb-5">
                                    <label class="inline-block w-1/3 mr-5 text-left font-bold text-gray-600">Tanggal Kembali Bunga</label>
                                    <p class="mr-4">:</p>
                                    <input readonly type="date" value="{{ explode(' ',$tagihan->tgl_kembali_bunga)[0] ?? 'Belum ada' }}" id="tgl_kembali_bunga" name="tgl_kembali_bunga" class="flex-1 py-2 px-2 rounded-xl focus:border-green-400 justify-between text-gray-600 placeholder-gray-400 shadow-md outline-none" >
                                </div>
                            @endisset
                            <div class="flex items-center mb-5">
                                <label for="status_tagihan" class="inline-block w-1/3 mr-5 text-left font-bold text-gray-600">Status Tagihan</label>
                                <p class="mr-4">:</p>
                                <input readonly type="text" value="{{ $tagihan->status_tagihan }}" id="status_tagihan" name="status_tagihan" class="flex-1 py-2 px-2 rounded-xl focus:border-green-400 justify-between text-gray-600 placeholder-gray-400 shadow-md outline-none" >
                                </input>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mt-4 gap-4">
                        @if (isset($tagihan->status_tagihan) && $tagihan->id_status_tagihan == 2)
                        <form action="{{ route('tagihanpoktan.konfirmtidak') }}" method="post" class="mt-4">
                            <input type="hidden" name="id_tagihan" value="{{ $tagihan->id_tagihan }}" id="idTagihan"> 
                            <input type="hidden" name="id_metode_bayar" value="{{ $tagihan->id_metode_bayar }}" id="">
                            @csrf
                                <button class="h-10 bg-green-400 px-10 shadow-lg font-semibold rounded-md text-white" type="submit">
                                    Konfirmasi
                                </button>
                            </form>
                        @elseif (isset($tagihan->status_tagihan) && $tagihan->id_status_tagihan == 4)
                        <form action="{{ route('tagihanpoktan.konfirmbunga') }}" method="post" class="mt-4">
                            <input type="hidden" name="id_tagihan" value="{{ $tagihan->id_tagihan }}" id=""> 
                            <input type="hidden" name="id_metode_bayar" value="{{ $tagihan->id_metode_bayar }}" id="">
                            @csrf    
                                <button class="h-10 bg-green-400 px-10 shadow-lg font-semibold rounded-md text-white" type="submit">
                                    Konfirmasi
                                </button>
                            </form>
                        @elseif (isset($tagihan->status_tagihan) && $tagihan->id_status_tagihan == 5)
                        <form action="{{ route('tagihanpoktan.konfirm') }}" method="post" class="mt-4">
                            <input type="hidden" name="id_tagihan" value="{{ $tagihan->id_tagihan }}" id=""> 
                            <input type="hidden" name="id_metode_bayar" value="{{ $tagihan->id_metode_bayar }}" id="">
                            @csrf    
                                <button class="h-10 bg-green-400 px-10 shadow-lg font-semibold rounded-md text-white" type="submit">
                                    Konfirmasi
                                </button>
                            </form>
                        @else
                            <div class="flex justify-end mt-4 mr-2">
                                <a href="{{ route('poktan.tagihan') }}">
                                    <button class="h-10 bg-green-400 px-10 shadow-lg font-semibold rounded-md text-white" type="button">
                                        Kembali
                                    </button>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="{{ asset('script.js') }}"></script>
</body>
</html>
