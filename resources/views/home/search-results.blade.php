@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
    <h1>Search Results for "{{ $query }}"</h1>

    @if ($products->count() > 0)
        <ul>
            @foreach ($products as $result)
                <li>{{ $result->nama_barang }}</li>
                <li>{{ $result->deskripsi }}</li>
                <li>{{ $result->harga }}</li>
                <li>{{ $result->gambar }}</li>
            @endforeach
        </ul>
    @else
        <p>No results found.</p>
    @endif
@endsection