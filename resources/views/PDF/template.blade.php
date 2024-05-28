<div class="bg-green-50 rounded-xl our-shadow">
    <h1 class="text-2xl pt-4 font-semibold justify-center flex mb-4">Detail Tagihan</h1>
    <hr class="border-b-2 border-green-500 my-3">
    <div class="px-10 py-5">
        <!-- Input fields -->
        <div class="flex items-center mb-5">
            Nama Petani : {{ $tagihan->nama_petani }}
        </div>
        <div class="flex items-center mb-5">
            Alamat Petani : {{ $tagihan->alamat_petani }}
        </div>
        <div class="flex items-center mb-5">
            Nama Poktan : {{ $tagihan->nama_poktan }}
        </div>
        <div class="flex items-center mb-5">
            Jumlah Kembali : {{ $tagihan->jml_pinjam }}
        </div>
        <div class="flex items-center mb-5">
            Tenggat Kembali : {{ explode(' ',$tagihan->tgl_kembali)[0] }}
        </div>
        <div class="flex items-center mb-5">
                Metode Bayar : {{ $tagihan->metode_bayar ?? 'Belum ada' }}
        </div>
        <div class="flex items-center mb-5">
            Status Tagihan : {{ $tagihan->status_tagihan }}
        </div>
    </div>
</div>