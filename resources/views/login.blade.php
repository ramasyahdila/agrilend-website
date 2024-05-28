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

    <title>@yield('title')</title>
</head>
<body class="flex flex-col h-screen">
    <header class="h-16 w-full bg-white shadow-lg z-10">
        <div class="mx-4 h-full flex justify-between p-2">
            <img src="{{ asset('img/AgrilendLogo.png') }}" alt="Logo" class="w-auto h-auto">
        </div>
    </header>
    <div class="flex h-full z-0">
        <div class="w-1/2 h-full bg-cover bg-center" style="background-image: url('img/LoginPage.jpg')"></div>
        <div class="w-1/2 flex h-full items-center justify-center bg-green-400">
            <!-- Gambar kanan bawah -->
            <div class="w-96 bg-transparent p-8 m-auto rounded-lg z-10">
                <h2 class="text-4xl font-bold text-center text-white mb-16">Selamat Datang Di Agrilend</h2>
                <hr class="border-2 border-white mb-8">

                @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 alert-dismiss" role="alert">
                        <strong class="font-bold">Sukses!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Terjadi kesalahan!</strong>
                        <span class="block sm:inline">Silakan periksa inputan Anda.</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Close</title>
                                <path d="M14.348 5.652a1 1 0 011.414 1.414L11.414 11l4.348 4.348a1 1 0 01-1.414 1.414L10 12.414l-4.348 4.348a1 1 0 01-1.414-1.414L8.586 11 4.24 6.652a1 1 0 111.414-1.414L10 9.586l4.348-4.348z"/>
                            </svg>
                        </span>
                        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h6 class="text-sm font-regular mb-4 text-center text-white">Silahkan isi form login berikut untuk masuk ke dalam website</h6>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="block text-white font-bold mb-2">Username</label>
                        <input type="text" id="username" name="username" class="shadow-lg appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Masukkan Username" required>
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-white font-bold mb-2">Password</label>
                        <input type="password" id="password" name="password" class="shadow-lg appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter password" required>
                    </div>
                    <div class="mb-4">
                        <label for="role" class="block text-white font-bold mb-2">Login sebagai</label>
                        <select id="role" name="role" class="shadow-lg appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <option value="petani">Petani</option>
                            <option value="poktan">Poktan</option>
                            <option value="pemerintah">Pemerintah</option>
                        </select>
                    </div>
                    <div class="flex items-center justify-center">
                        <button class="w-full text-center bg-green-600 hover:bg-blue-green text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline shadow-lg" type="submit">
                            Masuk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
         setTimeout(function() {
            document.querySelector('.alert-dismiss').style.display = 'none';
        }, 3000);
    </script>
</body>
</html>
