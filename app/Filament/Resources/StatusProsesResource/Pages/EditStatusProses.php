<?php

namespace App\Filament\Resources\StatusProsesResource\Pages;

use App\Filament\Resources\StatusProsesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStatusProses extends EditRecord
{
    protected static string $resource = StatusProsesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
