<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LaporanBarangHilang;
use App\Models\LaporanBarangPenemuan;

class KlaimBarangComponent extends Component
{

    public function klaimBarang($id)
    {
        // Misalnya, lakukan update status barang berdasarkan $id
        $laporan = LaporanBarangPenemuan::findOrFail($id);
        $laporan->update(['status_id' => 'Sudah Diklaim']);

        // Refresh tabel setelah mengubah status
        $this->emit('refreshTable');
    }

    public function statusProses($id)
    {
        // Misalnya, lakukan update status barang berdasarkan $id
        $laporan = LaporanBarangHilang::findOrFail($id);
        $laporan->update(['proses_id' => 'Approved']);

        // Refresh tabel setelah mengubah status
        $this->emit('refreshTable');
    }

    public function render()
    {
        return view('livewire.klaim-barang-component');
    }
}
