<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggan = Pelanggan::latest('pelanggan_id')->get();

        return view('admin.pelanggan.index', compact('pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'birthday' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Other',
            'email' => 'required|email|max:255|unique:pelanggan,email',
            'phone' => 'nullable|string|max:20',
        ], [
            'first_name.required' => 'Nama depan wajib diisi.',
            'last_name.required' => 'Nama belakang wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar, silakan gunakan email yang berbeda.',
            'birthday.date' => 'Format tanggal lahir tidak valid.',
            'gender.in' => 'Pilihan jenis kelamin tidak valid.',
        ]);

        Pelanggan::create($validated);

        return redirect()
            ->route('pelanggan.index')
            ->with('success', 'Data Pelanggan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        return view('admin.pelanggan.show', compact('pelanggan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        return view('admin.pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'birthday' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Other',
            'email' => 'required|email|max:255|unique:pelanggan,email,'.$pelanggan->pelanggan_id.',pelanggan_id',
            'phone' => 'nullable|string|max:20',
        ], [
            'first_name.required' => 'Nama depan wajib diisi.',
            'last_name.required' => 'Nama belakang wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan pelanggan lain.',
            'birthday.date' => 'Format tanggal lahir tidak valid.',
            'gender.in' => 'Pilihan jenis kelamin tidak valid.',
        ]);

        $pelanggan->update($validated);

        return redirect()
            ->route('pelanggan.index')
            ->with('success', 'Data Pelanggan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()
            ->route('pelanggan.index')
            ->with('success', 'Data Pelanggan berhasil dihapus!');
    }
}
