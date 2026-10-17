<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        // Ganti 'welcome' sesuai nama file Blade landing page di folder resources/views/
        return view('welcome');
    }
}
