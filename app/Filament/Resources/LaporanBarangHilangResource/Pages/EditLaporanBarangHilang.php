<?php

namespace App\Filament\Resources\LaporanBarangHilangResource\Pages;

use Filament\Actions;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Resources\Pages\EditRecord;
use EightyNine\Approvals\Models\ApprovableModel;
use App\Filament\Resources\LaporanBarangHilangResource;
use EightyNine\Approvals\Tables\Actions\ApprovalActions;

class EditLaporanBarangHilang extends EditRecord
{

    use  \EightyNine\Approvals\Traits\HasApprovalHeaderActions;
    protected static string $resource = LaporanBarangHilangResource::class;

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
        $user = auth()->user();

        return Action::make("Done")
            ->color("success")
            ->hidden(function (ApprovableModel $record) use ($user) {
                if ($user && $user->isAdministrator()) {
                    return false; // Always show for admin
                }
                return $record->shouldBeHidden();
            });
    }

    protected function getTableActions(): array
    {
        $user = auth()->user();
        $isAdmin = $user && $user->isAdministrator();

        return [
            EditAction::make(),
            // Show approval actions only if the user is an administrator
            $isAdmin ? ApprovalActions::make(
                Action::make("Done"),
                [
                    EditAction::make()
                ]
            ) : [],
        ];
    }
}
