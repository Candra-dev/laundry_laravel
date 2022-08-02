@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('customer.update', $user->id) }}" method="post">
                @csrf
                @method('put')

                <div class="form-group">
                  <label for="nama">Nama Lengkap</label>
                  <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Nama" autocomplete="off" value="{{ old('nama') ?? $user->nama }}">
                  @error('nama')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" placeholder="Alamat" autocomplete="off" value="{{ old('alamat') ?? $user->alamat }}">
                  @error('alamat')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="no_telp">Telpon</label>
                  <input type="no_telp" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" id="no_telp" placeholder="no_telp" autocomplete="off" value="{{ old('no_telp') ?? $user->no_telp }}">
                  @error('no_telp')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('customer.index') }}" class="btn btn-default">Back to list</a>

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
