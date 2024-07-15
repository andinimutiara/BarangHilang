<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use App\Models\LokasiKejadian;
use App\Models\LaporanBarangHilang;
use App\Models\LaporanBarangPenemuan;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\TableWidget as BaseWidget;

class LokasiBarangHilang extends BaseWidget
{

    protected static ?int $sort = 4;
    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query($this->getTableQuery())
            ->columns($this->getTableColumns())
            ->filters($this->getTableFilters()); // Tambahkan filter di sini
    }

    protected function getTableQuery(): Builder
    {
        // Mengambil pengguna yang terakhir beraktifitas berdasarkan kolom 'updated_at'
        return LaporanBarangHilang::query()->orderBy('updated_at', 'desc');
    }

    public function lokasiKejadian()
    {
        return $this->belongsTo(LokasiKejadian::class, 'lokasi_id');
    }


    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('lokasiKejadian.nama_lokasi') // gunakan dot notation
                ->label('Lokasi Kehilangan Barang'),
            Tables\Columns\TextColumn::make('tanggal_kehilangan')
                ->label('Tanggal Kehilangan')
                ->date(), // Menampilkan tanggal saja
            Tables\Columns\TextColumn::make('updated_at')
                ->label('Terakhir Aktivitas')
                ->dateTime('d M Y, H:i:s'), // Menampilkan waktu dalam format tanggal dan jam
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            SelectFilter::make('tanggal_kehilangan')
                ->label('Bulan')
                ->options($this->getMonthOptions())
                ->query(function (Builder $query, array $data): Builder {
                    if (isset($data['value'])) {
                        return $query->whereMonth('tanggal_kehilangan', $data['value']);
                    }

                    return $query;
                }),
        ];
    }

    protected function getMonthOptions(): array
    {
        return [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
    }


}
