<?php

namespace App\Http\Controllers;
use App\Http\Requests\AddPelangganRequest;
use App\Http\Requests\EditPelangganRequest;
use Illuminate\Http\Request;
use App\Pelanggan;


class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pelanggan', [
            'title' => 'Pelanggan',
            'pelanggans' => Pelanggan::paginate(10)
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create', [
            'title' => 'Form Pelanggan',
            'pelanggans' => Pelanggan::paginate(10)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddPelangganRequest $request)
    {
        Pelanggan::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);

        return redirect()->route('customer.index')->with('message', 'User added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelanggan $customer)
    {
        return view('customer.edit', [
            'title' => 'Edit Pelanggan',
            'user' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditPelangganRequest $request, Pelanggan $customer)
    {
        $customer->nama = $request->nama;
        $customer->alamat = $request->alamat;
        $customer->no_telp = $request->no_telp;
        $customer->save();

        return redirect()->route('customer.index')->with('message', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelanggan $customer)
    {
        $customer->delete();

        return redirect()->route('customer.index')->with('message', 'User deleted successfully!');
    }
}
