<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function jenisBarangHilang()
    {
        $categories = DB::table('category')
            ->join('category', '=', 'barang.category')
            ->select('category.name', DB::raw('count(barang.id) as total'))
            ->groupBy('category.name')
            ->get();

        // Contoh: mengirimkan data ke view untuk ditampilkan
        return view('dashboard.jenis_barang_hilang', compact('category'));
    }
}
