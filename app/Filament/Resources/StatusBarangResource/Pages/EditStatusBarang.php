<?php

namespace App\Filament\Resources\StatusBarangResource\Pages;

use App\Filament\Resources\StatusBarangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStatusBarang extends EditRecord
{
    protected static string $resource = StatusBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
