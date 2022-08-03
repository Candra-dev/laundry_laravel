@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->
    <div class="card">
        <div class="card-body">
            <form action="{{ url('transaction') }}" method="post">
                @csrf

                <div class="form-group">
                  <label for="invoice_no">Invoice</label>
                  <input type="text" class="form-control @error('invoice_no') is-invalid @enderror" name="invoice_no" id="invoice_no" placeholder="Invoice" readonly="" value="{{ 'INV/'.date('dmy/').$kd }}" autocomplete="off">
                  @error('invoice_no')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="pelanggan_id">Pelanggan</label>
                  <select name="pelanggan_id" class="form-control @error('pelanggan_id') is-invalid @enderror" value="{{ old('pelanggan_id') }}">
                    <option value="">-- Pilih --</option>
                    @foreach ($pelanggans as $item)
                      <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                  </select>
                  @error('pelanggan_id')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="hargas_id">Kategori</label>
                  <select name="hargas_id" class="form-control @error('hargas_id') is-invalid @enderror" value="{{ old('hargas_id') }}">
                    <option value="">-- Pilih --</option>
                    @foreach ($produks as $item)
                      <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                    @endforeach
                  </select>
                  @error('hargas_id')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="tarif">Berat</label>
                  <input type="number" class="form-control @error('tarif') is-invalid @enderror" name="tarif" id="tarif" placeholder="Berat" autocomplete="off" value="{{ old('Berat') }}">
                  @error('tarif')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="date">Tanggal Order</label>
                  <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" id="date" placeholder="Date" autocomplete="off" value="{{ old('date') }}">
                  @error('date')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="status"></label>
                  <input type="hidden" class="form-control @error('status') is-invalid @enderror" name="status" id="status" readonly="" placeholder="status" autocomplete="off" value="Proses">
                  @error('status')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('transaction.index') }}" class="btn btn-default">Back to list</a>

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