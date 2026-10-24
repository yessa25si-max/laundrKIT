<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengembalikan template dashboard utama LaundryKIT
        return view('admin.dashboard');
    }
}
