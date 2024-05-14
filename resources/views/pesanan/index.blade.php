@extends('layout.app')

@section('title', 'Data Pesanan Baru')

@section('content')
<div class="card shadow">
    <div class="card-header">
        <h4 class="card-title">
            Data Pesanan Baru
        </h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pesanan</th>
                        <th>Invoice</th>
                        <th>Member</th>
                        <th>Alamat Pembeli</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

@endsection


@push('js')
<script>
    $(function() {

        function rupiah(angka){
            const format = angka.toString().split('').reverse().join('');
            const convert = format.match(/\d{1,3}/g);
            return 'Rp ' + convert.join('.').split('').reverse().join('')
        }

        function date(date) {
            var dateObject = new Date(date);
            var day = ("0" + dateObject.getDate()).slice(-2); // tambahkan "0" di depan dan ambil dua digit terakhir
            var month = ("0" + (dateObject.getMonth() + 1)).slice(-2); // tambahkan "0" di depan dan ambil dua digit terakhir
            var year = dateObject.getFullYear();

            return `${day}-${month}-${year}`;
        }

        const token = localStorage.getItem('token')
        $.ajax({
            url: '/api/pesanan/baru',
            headers: {
                "Authorization": 'Bearer ' + token
            },
            success: function({
                data
            }) {

                let row;
                data.map(function(val, index) {
                     // Menambahkan pengkondisian untuk mengecek status pembayaran
                if (val.payment && val.payment.status === 'DITOLAK') {
                // Jika status pembayaran DITOLAK, skip pesanan ini
                return;
                }
                // Menambahkan kondisi untuk tombol "Konfirmasi"
                let konfirmasiButton = '';
                if (val.payment && val.payment.status === 'DITERIMA') {
                    konfirmasiButton = `<a href="#" data-id="${val.id}" class="btn btn-success btn-aksi">Konfirmasi</a>`;
                } else {
                    konfirmasiButton = `<button class="btn btn-success" disabled>Tidak Tersedia</button>`;
                }
                    row += `
                        <tr>
                            <td>${index+1}</td>
                            <td>${date(val.created_at)}</td>
                            <td>${val.invoice}</td>
                            <td>${val.member.nama_member}</td>
                            <td>${rupiah(val.grand_total)}</td>
                            <td>
                                ${val.payment ? val.payment.detail_alamat : 'N/A'}
                            </td>
                            <td>
                                ${konfirmasiButton}
                                <a href="#" data-id="${val.id}" class="btn btn-danger btn-tolak">Tolak</a>
                            </td>
                        </tr>
                        `;
                });

                $('tbody').append(row)
            }
        });

        $(document).on('click','.btn-aksi',function(){
            const id = $(this).data('id')

            $.ajax({
                url : '/api/pesanan/ubah_status/' + id,
                type : 'POST',
                data : {
                    status : 'Dikonfirmasi'
                },
                headers: {
                    "Authorization": 'Bearer ' + token
                },
                success : function(data){
                    location.reload()
                }
            })
        });
        
        $(document).on('click', '.btn-tolak', function() {
            const id = $(this).data('id');

            $.ajax({
            url: '/api/pesanan/ubah_status/' + id,
            type: 'POST',
            data: {
                status: 'Ditolak'
            },
            headers: {
                "Authorization": 'Bearer ' + token
            },
            success: function(data) {
                location.reload();
            }
        });
    });
});
</script>
@endpush