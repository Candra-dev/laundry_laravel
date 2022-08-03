<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\Http\Requests\AddProdukRequest;
use App\Http\Requests\EditProdukRequest;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('produk', [
            'title' => 'Produk',
            'produks' => Produk::paginate(10)
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.create', [
            'title' => 'Form Kategori',
            'produks' => Produk::paginate(10)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddProdukRequest $request)
    {
        Produk::create([
            'kategori' => $request->kategori,
            'berat' => $request->berat,
            'hari' => $request->hari,
            'harga' => $request->harga,
        ]);

        return redirect()->route('kategori.index')->with('message', 'User added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $kategori)
    {
        return view('kategori.edit', [
            'title' => 'Edit Kategori',
            'produk' => $kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditProdukRequest $request, Produk $kategori)
    {
        $kategori->kategori = $request->kategori;
        $kategori->berat = $request->berat;
        $kategori->hari = $request->hari;
        $kategori->harga = $request->harga;
        $kategori->save();

        return redirect()->route('kategori.index')->with('message', 'Kategori update sukses!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $kategori)
    {
        $kategori->delete();

        return redirect()->route('kategori.index')->with('message', 'Hapus kategori sukses!');
    }
}
