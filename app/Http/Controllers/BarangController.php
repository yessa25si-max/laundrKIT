<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = Barang::latest('barang_id')->get();

        return view('admin.barang.index', compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_barang' => 'required|string|max:20|unique:barang,kode_barang',
            'nama_barang' => 'required|string|max:100',
            'kategori' => 'required|in:Deterjen & Sabun,Pewangi & Softener,Plastik & Kemasan,Peralatan & Hanger',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required|string|max:20',
            'harga_beli' => 'required|numeric|min:0',
            'status' => 'required|in:Tersedia,Menipis,Habis',
        ], [
            'kode_barang.required' => 'Kode barang wajib diisi.',
            'kode_barang.unique' => 'Kode barang ini sudah ada, gunakan kode lain.',
            'nama_barang.required' => 'Nama barang perlengkapan wajib diisi.',
            'kategori.required' => 'Pilih kategori barang yang valid.',
            'stok.required' => 'Jumlah stok barang wajib diisi.',
            'stok.integer' => 'Jumlah stok harus berupa angka bulat.',
            'stok.min' => 'Stok tidak boleh bernilai negatif.',
            'satuan.required' => 'Satuan barang wajib diisi (misal: Liter, Pack, Pcs).',
            'harga_beli.required' => 'Harga beli per unit wajib diisi.',
            'harga_beli.numeric' => 'Harga beli harus berupa angka.',
            'status.required' => 'Status stok barang wajib dipilih.',
        ]);

        Barang::create($validated);

        return redirect()
            ->route('barang.index')
            ->with('success', 'Data Barang / Perlengkapan baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $barang = Barang::findOrFail($id);

        return view('admin.barang.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $barang = Barang::findOrFail($id);

        return view('admin.barang.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $barang = Barang::findOrFail($id);

        $validated = $request->validate([
            'kode_barang' => 'required|string|max:20|unique:barang,kode_barang,'.$barang->barang_id.',barang_id',
            'nama_barang' => 'required|string|max:100',
            'kategori' => 'required|in:Deterjen & Sabun,Pewangi & Softener,Plastik & Kemasan,Peralatan & Hanger',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required|string|max:20',
            'harga_beli' => 'required|numeric|min:0',
            'status' => 'required|in:Tersedia,Menipis,Habis',
        ], [
            'kode_barang.required' => 'Kode barang wajib diisi.',
            'kode_barang.unique' => 'Kode barang sudah digunakan oleh barang lain.',
            'nama_barang.required' => 'Nama barang perlengkapan wajib diisi.',
            'kategori.required' => 'Pilih kategori barang yang valid.',
            'stok.required' => 'Jumlah stok barang wajib diisi.',
            'stok.integer' => 'Jumlah stok harus berupa angka bulat.',
            'stok.min' => 'Stok tidak boleh bernilai negatif.',
            'satuan.required' => 'Satuan barang wajib diisi.',
            'harga_beli.required' => 'Harga beli per unit wajib diisi.',
            'harga_beli.numeric' => 'Harga beli harus berupa angka.',
            'status.required' => 'Status stok barang wajib dipilih.',
        ]);

        $barang->update($validated);

        return redirect()
            ->route('barang.index')
            ->with('success', 'Data Barang / Perlengkapan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()
            ->route('barang.index')
            ->with('success', 'Data Barang / Perlengkapan berhasil dihapus!');
    }
}
