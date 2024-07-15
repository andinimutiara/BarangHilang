<?php

namespace App\Filament\Resources;

use Str;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Tables\Actions\Button;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Card;
use Filament\Tables\Filters\Filter;
use App\Models\LaporanBarangPenemuan;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextArea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\BelongsToSelect;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\LaporanBarangPenemuanResource\Pages;
use App\Filament\Resources\LaporanBarangPenemuanResource\RelationManagers;

class LaporanBarangPenemuanResource extends Resource
{
    protected static ?string $model = LaporanBarangPenemuan::class;

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
                DateTimePicker::make('tanggal_penemuan')
                    ->seconds(false),
                SpatieMediaLibraryFileUpload::make('foto'),
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
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
            TextColumn::make('categoryBarang.nama_category'),
            TextColumn::make('lokasiKejadian.nama_lokasi'),
            TextColumn::make('tanggal_penemuan'),
            SpatieMediaLibraryImageColumn::make('foto')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Klaim Barang')
                    ->url(fn ($record) => route('klaimBarang', ['id' => $record->id]))
                    ->visible(fn ($record) => $record->status_id != 1)
                    
         
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->hidden(fn() => auth()->user()->role !== 'ADMINISTRATOR'),
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
            'index' => Pages\ListLaporanBarangPenemuans::route('/'),
            'create' => Pages\CreateLaporanBarangPenemuan::route('/create'),
            'edit' => Pages\EditLaporanBarangPenemuan::route('/{record}/edit'),
        ];
    }

    // public static function getEloquentQuery(): Builder
    // {
    //     return parent::getEloquentQuery()
    //         ->whereHas('user', function ($query) {
    //             $user = auth()->user();
    //             $query->where('user_id', $user->id);
    //          });
    //     }

}
