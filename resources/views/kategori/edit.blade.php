@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('kategori.update', $produk->id) }}" method="post">
                @csrf
                @method('put')

                <div class="form-group">
                  <label for="nama">Kategori</label>
                  <input type="text" class="form-control @error('kategori') is-invalid @enderror" name="kategori" id="kategori" placeholder="Kategori" autocomplete="off" value="{{ old('kategori') ?? $produk->kategori }}">
                  @error('Kategori')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="berat">Minimal Berat</label>
                  <input type="number" class="form-control @error('berat') is-invalid @enderror" name="berat" id="berat" placeholder="Nama Pelanggan" value="{{ old('berat') ?? $produk->berat }}">
                  @error('berat')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="hari">Lama Hari</label>
                  <input type="number" class="form-control @error('hari') is-invalid @enderror" name="hari" id="hari" placeholder="Lama Hari" autocomplete="off" value="{{ old('hari') ?? $produk->hari }}">
                  @error('hari')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="harga">Harga/kg</label>
                  <input type="number" class="form-control @error('harga') is-invalid @enderror" name="harga" id="harga" placeholder="Harga/kg" autocomplete="off" value="{{ old('harga') ?? $produk->harga }}">
                  @error('harga')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('kategori.index') }}" class="btn btn-default">Back to list</a>

            </form>
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
