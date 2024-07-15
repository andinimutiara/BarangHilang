<?php

namespace App\Filament\Resources\StatusBarangResource\Pages;

use App\Filament\Resources\StatusBarangResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStatusBarangs extends ListRecords
{
    protected static string $resource = StatusBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
