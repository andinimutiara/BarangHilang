<?php

namespace App\Filament\Widgets;

use App\Models\LaporanBarangHilang;
use App\Models\LaporanBarangPenemuan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        
        return [

            Stat::make('Jumlah Laporan Kehilangan', LaporanBarangHilang::count()),

            Stat::make('Jumlah Laporan Penemuan', LaporanBarangPenemuan::count()),
        ];
    }
}
