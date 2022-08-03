@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Transaksi') }}</h1>

    <!-- Main Content goes here -->
    <a href="{{ route('transaction.create') }}" class="btn btn-primary mb-3">+ Tambah</a>

    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Invoice</th>
                        <th>Tanggal Transaksi</th>
                        <th>Nama Pelanggan</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Status Pesanan</th>
                        <th>Aksi</th>
                    </tr>
                    @foreach ($transaksis as $transaksi)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $transaksi->invoice_no }}</td>
                        <td>{{ $transaksi->date }}</td>
                        <td>{{ $transaksi->pelanggan->nama }}</td>
                        <td>{{ $transaksi->Produk->kategori }}</td>
                        <td>Rp.{{ number_format($transaksi->Produk->harga) }}</td>
                        <td>{{ $transaksi->status }}</td>
                        <td>
                            <div class="d-flex">
                            <a href="{{ route('transaction.edit', $transaksi->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                                <form action="{{ route('transaction.destroy', $transaksi->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </thead>
            </table>
        </div>
    </div>
</div>
    <!-- End of Main Content -->
@endsection

@push('notif')
@if (session('success'))
<div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('status'))
    <div class="alert alert-success border-left-success" role="alert">
        {{ session('status') }}
    </div>
@endif
@endpush
