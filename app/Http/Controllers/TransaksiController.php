<?php

namespace App\Http\Controllers;

use App\Pelanggan;
use App\Produk;
use Illuminate\Http\Request;
use App\Transaksi;
use GuzzleHttp\Promise\Create;
use App\Http\Requests\AddTransaksiRequest;
use App\Http\Requests\EditTransaksiRequest;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksis = Transaksi::with('pelanggan')->get();
        $transaksis = Transaksi::with('produk')->get();

        return view('transaksi', compact('transaksis'));
    }

    public function show()
    {
        $transaksis = Transaksi::with('pelanggan')->get();
        $transaksis = Transaksi::with('produk')->get();

        return view('laporan', compact('transaksis'));
    }

    public function loadpdf()
    {
        $transaksis = Transaksi::with('pelanggan')->get();
        $transaksis = Transaksi::with('produk')->get();

        $pdf = Pdf::loadView('laporan', compact('transaksis'));
        return $pdf->stream();

        set_time_limit(300);
    }

    /**
     * 
     * 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pelanggans = Pelanggan::all();
        $produks = Produk::all();

        $voice = DB::table('transaksi')->select(DB::raw('MAX(RIGHT(invoice_no,3)) as kode'));
        $kd = "";
        if ($voice->count() > 0) {
            foreach ($voice->get() as $k) {
                $temp = ((int)$k->kode) + 1;
                $kd = sprintf("%04s", $temp);
            }
        } else {
            $kd = "001";
        }

        //return "NBW.".$kd;
        return view('transaction.create', compact('pelanggans', 'produks', 'kd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddTransaksiRequest $request)
    {
        $transaksi = new Transaksi();
        $transaksi->invoice_no = $request->invoice_no;
        $transaksi->pelanggan_id = $request->pelanggan_id;
        $transaksi->hargas_id = $request->hargas_id;
        $transaksi->tarif = $request->tarif;
        $transaksi->date = $request->date;
        $transaksi->status = $request->status;

        //$transaksi->status = Produk::where('id', $transaksi->id)->update(['harga' => DB::raw("harga * berat")]);
        //$transaksi->status = Produk::select(DB::raw('harga * $transaksi->tarif'))->get(); //

        //$transaksi->status = DB::table('hargas AS t')
        //->leftJoin('hargas AS h', 'p.hargas.id', '=', 't.id')
        // ->selectRaw('t.id AS "hargas.id", t.harga AS "status", SUM(harga * tarif)')->get();

        $transaksi->save();

        //   Produk::create([
        //  'invoice_no' => $request->invoice_no,
        //  'pelanggan_id' => $request->pelanggan_id,
        //  'hargas_id' => $request->hargas_id,
        //  'tarif' => $request->tarif,
        // 'status' => ('tarif * invoice_no'),
        //]);

        return redirect('transaction')->with('message', 'User added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaction)
    {
        return view('transaction.edit', [
            'title' => 'Edit Proses Pesanan',
            'transaksi' => $transaction
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditTransaksiRequest $request, Transaksi $transaction)
    {
        $transaction->status = $request->status;
        $transaction->save();

        return redirect()->route('transaction.index')->with('message', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaction)
    {
        $transaction->delete();

        return redirect()->route('transaction.index')->with('message', 'Hapus kategori sukses!');
    }
}
