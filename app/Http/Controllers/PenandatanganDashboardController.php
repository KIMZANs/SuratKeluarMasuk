<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenandatanganDashboardController extends Controller
{
    public function index()
    {
        return view('penandatangan.dashboard'); // Pastikan file dashboard.blade.php ada di folder resources/views/admin
    }
}
