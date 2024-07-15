<?php

namespace App\Filament\Resources\LaporanBarangPenemuanResource\Pages;

use Filament\Actions;
use App\Models\CategoryBarang;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\LaporanBarangPenemuanResource;

class ListLaporanBarangPenemuans extends ListRecords
{
    protected static string $resource = LaporanBarangPenemuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTabs(): array
{
    // Ambil semua kategori barang dengan urutan berdasarkan kolom id
    $categories = CategoryBarang::orderBy('id')->get();

    // Inisialisasi array untuk menampung data tab
    $data = [];

    // Tambahkan tab untuk menampilkan semua barang (tanpa modifikasi query)
    $data['all'] = Tab::make()
        ->label('All')
        ->modifyQueryUsing(function (Builder $query) {
            return $query; // Tidak ada modifikasi query diperlukan untuk menampilkan semua data
        });

    // Loop untuk membuat tab untuk setiap kategori berdasarkan urutan id
    foreach ($categories as $category) {
        $data[$category->nama_category] = Tab::make()
            ->label($category->nama_category)
            ->modifyQueryUsing(function (Builder $query) use ($category) {
                // Modifikasi query untuk memfilter berdasarkan kategori barang
                return $query->where('category_id', $category->id);
            });
    }

    return $data;
}

}