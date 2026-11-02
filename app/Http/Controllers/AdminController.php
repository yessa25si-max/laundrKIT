<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Layanan;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

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

        // 2 CRUD Baru: Transaksi (Eloquent) & Testimoni (Query Builder)
        $totalTransaksi = Transaksi::count();
        $totalTestimoni = DB::table('testimoni')->count();
        $totalOmset = Transaksi::sum('total_biaya');

        $latestPelanggan = Pelanggan::latest('pelanggan_id')->take(5)->get();
        $latestLayanan = Layanan::latest('layanan_id')->take(5)->get();
        $latestBarang = Barang::latest('barang_id')->take(5)->get();
        $latestTransaksi = Transaksi::with(['pelanggan', 'layanan'])->latest('transaksi_id')->take(5)->get();

        return view('admin.admin-home', compact(
            'totalPelanggan',
            'totalLayanan',
            'totalBarang',
            'totalTransaksi',
            'totalTestimoni',
            'totalOmset',
            'latestPelanggan',
            'latestLayanan',
            'latestBarang',
            'latestTransaksi'
        ));
    }
}
