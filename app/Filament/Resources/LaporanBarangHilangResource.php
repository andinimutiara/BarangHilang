<?php

namespace App\Filament\Resources;

use Str;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\CategoryBarang;
use Filament\Resources\Resource;
use App\Models\LaporanBarangHilang;
use Filament\Forms\Components\Card;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextArea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\BelongsToSelect;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use EightyNine\Approvals\Tables\Actions\ApprovalActions;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\LaporanBarangHilangResource\Pages;
use EightyNine\Approvals\Tables\Columns\ApprovalStatusColumn;
use App\Filament\Resources\LaporanBarangHilangResource\RelationManagers;

class LaporanBarangHilangResource extends Resource
{
    protected static ?string $model = LaporanBarangHilang::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    BelongsToSelect::make('category_id')
                        ->relationship('categoryBarang', 'nama_category')
                        ->label('Category Barang')
                        ->required(),
                    TextInput::make('nama_barang')
                        ->required(),
                    TextArea::make('deskripsi_barang'),
                    TextArea::make('deskripsi_kronologi'),
                    BelongsToSelect::make('lokasi_id')
                        ->relationship('lokasiKejadian', 'nama_lokasi')
                        ->label('Lokasi Kejadian')
                        ->required(),
                    DateTimePicker::make('tanggal_kehilangan')
                        ->seconds(false),
                    SpatieMediaLibraryFileUpload::make('foto'),
                    // BelongsToSelect::make('proses_id')
                    //     ->relationship('statusProses', 'nama_proses')
                    //     ->label('Status Proses')
                    //     ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {

        $isAdmin = Auth::check() && Auth::user()->role === 'ADMINISTRATOR';

        return $table
            ->columns([
                TextColumn::make('No')->state(
                    static function (HasTable $livewire, $rowLoop): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * (
                                $livewire->getTablePage() - 1
                            ))
                        );
                    }
                ),
                TextColumn::make('id')->label('Nomor Laporan')->searchable(),
                TextColumn::make('nama_barang')->limit('50')->sortable()->searchable(),
                TextColumn::make('deskripsi_barang')->limit('50')->sortable(),
                TextColumn::make('deskripsi_kronologi')->limit('50')->sortable(),
                TextColumn::make('categoryBarang.nama_category')->label('Category'),
                TextColumn::make('lokasiKejadian.nama_lokasi')->label('Lokasi Kejadian'),
                TextColumn::make('tanggal_kehilangan'),
                SpatieMediaLibraryImageColumn::make('cover'),
                // TextColumn::make('statusProses.nama_proses')->label('Nama Proses'),
                // ApprovalStatusColumn::make("approvalStatus.status"),
            ])
            ->filters([
                //
            ])
            ->actions(
            //     Tables\Actions\EditAction::make(),
            //     Tables\Actions\Action::make('Submit')
            //         ->url(fn ($record) => route('statusProses', ['id' => $record->id]))
            //         ->visible(fn ($record) => $record->proses_id != 1)
            // ]
                // // Show approval actions only if the user is an administrator
                $isAdmin
                    ? ApprovalActions::make(
                        Action::make("Done"),
                        [
                            Tables\Actions\EditAction::make()
                        ]
                    )
                    : [],
            )
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->hidden(fn() => !$isAdmin),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLaporanBarangHilangs::route('/'),
            'create' => Pages\CreateLaporanBarangHilang::route('/create'),
            'edit' => Pages\EditLaporanBarangHilang::route('/{record}/edit'),
        ];
    }

}
