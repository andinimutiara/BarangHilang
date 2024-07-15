<?php

namespace App\Filament\Resources\LaporanBarangPenemuanResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use EightyNine\Approvals\Models\ApprovableModel;
use App\Filament\Resources\LaporanBarangPenemuanResource;

class EditLaporanBarangPenemuan extends EditRecord
{

    use  \EightyNine\Approvals\Traits\HasApprovalHeaderActions;
    protected static string $resource = LaporanBarangPenemuanResource::class;

    protected function getHeaderActions(): array
    {
        // return [
        //     Actions\DeleteAction::make(),
        // ];

        $user = auth()->user();
        $actions = [];

        
        if ($user && $user->role === 'ADMINISTRATOR') {
            $actions[] = Actions\DeleteAction::make();
        }

        return $actions;
    }

    protected function getOnCompletionAction(): Action
    {
        return Action::make("Done")
            ->color("success")
            // Do not use the visible method, since it is being used internally to show this action if the approval flow has been completed.
            // Using the hidden method add your condition to prevent the action from being performed more than once
            ->hidden(fn(ApprovableModel $record)=> $record->shouldBeHidden());
    }
}

