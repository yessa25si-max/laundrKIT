<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Layanan;
use App\Models\Pelanggan;

class AdminController extends Controller
{
    /**
     * Display admin dashboard overview.
     */
    public function index()
    {
        $totalPelanggan = Pelanggan::count();
        $totalLayanan = Layanan::count();
        $totalBarang = Barang::count();

        $latestPelanggan = Pelanggan::latest('pelanggan_id')->take(5)->get();
        $latestLayanan = Layanan::latest('layanan_id')->take(5)->get();
        $latestBarang = Barang::latest('barang_id')->take(5)->get();

        return view('admin.home', compact(
            'totalPelanggan',
            'totalLayanan',
            'totalBarang',
            'latestPelanggan',
            'latestLayanan',
            'latestBarang'
        ));
    }
}
