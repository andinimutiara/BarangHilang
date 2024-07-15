<?php

namespace App\Filament\Resources\LaporanBarangHilangResource\Pages;

use App\Models\CategoryBarang;
use App\Models\LaporanBarangHilang;
use Filament\Resources\Pages\Page;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Concerns\InteractsWithForms;
use App\Filament\Resources\LaporanBarangHilangResource;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class FormBarangHilangClass extends Page implements HasForms

{
    use InteractsWithForms;
    protected static string $resource = LaporanBarangHilangResource::class;

    protected static string $view = 'filament.resources.laporan-barang-hilang-resource.pages.form-barang-hilang-class';

    public $category = '';

    public function mount(): void
    {
        $this->form->fill();
    }

    public function getFormSchema(): array
    {
        return [
            Card::make()->schema([
                Select::make('category_id')
                ->options(CategoryBarang::all()->pluck('nama_category', 'id'))
                ->label('Category')
            ])
        ];
    }

    public function save (){
        $laporan = $this->laporan;
        $insert = [];
        foreach($laporan as $row) {
        array_push($insert, [
            'category_id'=> $this->category,
            'is_open' => 1
        ]);

    }

        LaporanBarangHilang::insert($insert);

        return redirect()->to('admin/baranghilang-has-classes');
    }


}
