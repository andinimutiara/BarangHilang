<?php

namespace App\Http\Controllers;

use App\Models\LaporanBarangHilang;
use App\Models\LaporanBarangPenemuan;
use Illuminate\Http\Request;

class KlaimBarangController extends Controller
{

    public function klaimBarang(Request $request)
    {
        // Ambil id dari input form (gunakan input() untuk POST request)
        $id = $request->input('id');
        
        // Cari laporan berdasarkan ID, atau lemparkan error jika tidak ditemukan
        $laporan = LaporanBarangPenemuan::findOrFail($id);
        
        // Tampilkan pop-up pertanyaan konfirmasi
        return view('klaim-barang.konfirmasi', compact('laporan'));
    }

    public function statusProses(Request $request)
{
    // Ambil id dari input form (gunakan input() untuk POST request)
    $id = $request->input('id');
    
    try {
        // Cari laporan berdasarkan ID, atau lemparkan error jika tidak ditemukan
        $laporan = LaporanBarangHilang::findOrFail($id);
        
        // Simpan data laporan yang berhasil diklaim ke dalam session
        $request->session()->flash('success', 'Barang berhasil diklaim.');
        $request->session()->flash('laporan', $laporan);

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        // Handle jika laporan tidak ditemukan
        $request->session()->flash('error', 'Laporan tidak ditemukan.');
    }
    
    // Redirect kembali ke halaman sebelumnya
    return redirect()->back();
}

    public function simpanJawabanKonfirmasi(Request $request)
    {
        $laporanId = $request->input('laporan_id');
        $jawaban = $request->input('jawaban');

        // Gunakan ::find() jika Anda yakin bahwa laporan_id sudah valid
        $laporan = LaporanBarangPenemuan::find($laporanId);
        
        if (!$laporan) {
            return redirect()->back()->with('error', 'Laporan tidak ditemukan.');
        }

        // Update laporan dengan status_id dan jawaban
        $laporan->status_id = 1;
        $laporan->jawaban_konfirmasi = $jawaban;
        $laporan->save();

        return redirect()->back()->with('success', 'Barang berhasil diklaim.');
    }

}