function fileAnnounce(file) {
    document.querySelector('#boxLaporan > div > p').innerText = file.files[0].name
}
function jumlahPeminjamanClick(option) {
    let value = option.value;
    if(value == '1000000') {
        document.getElementById('jml_diterima').value = '906000';
        document.getElementById('bunga').value = '94.000';
    } else if (value == '500000') {
        document.getElementById('jml_diterima').value = '441000';
        document.getElementById('bunga').value = '59.000';
    }
}
function tglPinjamClick(input) {
    var today = new Date(input.value);
    today.setDate(today.getDate() + 30*4);
    var month = today.getMonth().length > 1 ? (today.getMonth()) : ('0' + today.getMonth());
    var next =  today.getFullYear() + '-' + month + '-' + today.getDate();
    document.querySelector('#tgl_kembali').value = next
}

function tagihanSubmit(bayar) {
    const form = document.getElementById('formTagihan')
    if(bayar) {
        form.setAttribute('action','/tagihan/bayar');
        form.submit();
    } else {
        form.setAttribute('method','GET');
        form.setAttribute('action','/tagihan/tidak-bayar');
        console.log(form)
        form.submit();
    }
}