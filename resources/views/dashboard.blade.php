@extends('layout.app')


@section('content')
    
@php
$date = now()->format('Y-m-d'); // Sesuaikan dengan format datetime di database
$today = App\Models\Order::whereRaw("DATE(updated_at) = ?", [$date])
    ->where('status', 'Selesai')
    ->sum('grand_total');

// $month = date('F');
// $month = App\Models\Order::where('order_month',$month)->sum('amount');

// $year = date('Y');
// $year = App\Models\Order::where('order_year',$year)->sum('amount');

$baru = App\Models\Order::where('status','Baru')->get();

@endphp
<div class="container-full">

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Penjualan Hari Ini</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp{{ number_format($today,0,'','.') }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-xl-4 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">
                        <div class="icon bg-warning-light rounded w-60 h-60">
                            <i class="text-warning mr-0 font-size-24 fa fa-calendar-check-o"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Penjualan Bulan Ini </p>
                            <h3 class="text-white mb-0 font-weight-500">Rp{{ number_format($month,0,'','.') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">
                        <div class="icon bg-info-light rounded w-60 h-60">
                            <i class="text-info mr-0 font-size-24 mdi mdi-sale"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Penjualan Tahun Ini </p>
                            <h3 class="text-white mb-0 font-weight-500">Rp{{ number_format($year,0,'','.') }}</h3>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pesanan Baru</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($baru) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


            <div class="col-12 mt-5">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title align-items-start flex-column">
                            Semua Pesanan Baru
                        </h4>
                    </div>

                    @php
                    $orders = App\Models\Order::where('status','Baru')->orderBy('id','DESC')->get();

                    @endphp

                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-border">
                                <thead>

                                    <tr class="text-uppercase bg-lightest">
                                        <th style="min-width: 250px"><span class="text-black">Tanggal</span></th>
                                        <th style="min-width: 100px"><span class="text-fade">Invoice</span></th>
                                        <th style="min-width: 100px"><span class="text-fade">Total Bayar</span></th>
                                        {{-- <th style="min-width: 150px"><span class="text-fade">Metode Pembayaran</span></th> --}}
                                        <th style="min-width: 130px"><span class="text-fade">Status</span></th>
                                        <th style="min-width: 120px"><span class="text-fade">Opsi</span> </th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection

@push('js')

<script>
    $(document).ready(function() {
        // Mengambil data pesanan menggunakan Ajax saat halaman dimuat
        $.ajax({
            url: "{{ route('getNewOrders') }}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                // Mengisi data pesanan ke dalam tabel
                $.each(data, function(index, order) {
                    var formattedDate = new Date(order.created_at);
                    var formattedDateString = formattedDate.toLocaleDateString('en-GB'); // Ubah sesuai format yang diinginkan
                    
                    var row = '<tr>' +
                        '<td>' + formattedDateString + '</td>' +
                        '<td>' + order.invoice + '</td>' +
                        '<td>Rp' + order.grand_total.toLocaleString() + '</td>' +
                        '<td>' + order.status + '</td>' +
                        '<td><button class="btn btn-info btn-detail" data-id="' + order.id + '">Detail</button></td>' +
                        '</tr>';
                    $('tbody').append(row);
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
       
        $(document).ready(function() {
    // ...
    $('body').on('click', '.btn-detail', function() {
        var orderId = $(this).data('id');
        window.location.href = "/pesanan/baru";
    });
    // ...
    });
    });
    </script>

@endpush