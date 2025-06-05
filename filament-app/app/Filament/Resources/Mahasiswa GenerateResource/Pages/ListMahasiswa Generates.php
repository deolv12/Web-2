<?php

namespace App\Filament\Resources\Mahasiswa GenerateResource\Pages;

use App\Filament\Resources\Mahasiswa GenerateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMahasiswa Generates extends ListRecords
{
    protected static string $resource = Mahasiswa GenerateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
