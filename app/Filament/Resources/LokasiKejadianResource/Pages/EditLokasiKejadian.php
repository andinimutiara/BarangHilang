<?php

namespace App\Filament\Resources\LokasiKejadianResource\Pages;

use App\Filament\Resources\LokasiKejadianResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLokasiKejadian extends EditRecord
{
    protected static string $resource = LokasiKejadianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
