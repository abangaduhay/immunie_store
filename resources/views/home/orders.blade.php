@extends('layout.home')

@section('title', 'Checkout')

@section('content')
<!-- Checkout -->
<section class="section-wrap checkout pb-70">
    <div class="container relative">
        <div class="row">

            <div class="ecommerce col-xs-12">
                <h2>Pembayaran Saya</h2>
                <table class="table table-ordered table-hover table-striped">
                    <thead>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nominal Transfer</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        @foreach ($payments as $index => $payment)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('d-m-Y') }}</td>
                            <td>Rp. {{number_format($payment->jumlah)}}</td>
                            <td>{{$payment->status}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <h2>Pesanan Saya</h2>
                <table class="table table-ordered table-hover table-striped">
                    <thead>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Grand Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($orders as $index => $order)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</td>
                            <td>Rp. {{number_format($order->grand_total)}}</td>
                            <td>{{$order->status}}</td>
                            <td>
                                @if($order->status == 'Dikirim') <!-- Tombol "Diterima" muncul jika pesanan dikirim -->
                                <form action="/pesanan_diterima/{{$order->id}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">DITERIMA</button>
                                </form>
                            @elseif($order->status == 'Diterima') <!-- Tombol "SELESAI" muncul jika pesanan diterima -->
                                <form action="/pesanan_selesai/{{$order->id}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">SELESAI</button>
                                </form>
                            @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div> <!-- end ecommerce -->

        </div> <!-- end row -->
    </div> <!-- end container -->
</section> <!-- end checkout -->
@endsection