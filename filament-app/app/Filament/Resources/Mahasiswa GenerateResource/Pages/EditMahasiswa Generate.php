<?php

namespace App\Filament\Resources\Mahasiswa GenerateResource\Pages;

use App\Filament\Resources\Mahasiswa GenerateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMahasiswa Generate extends EditRecord
{
    protected static string $resource = Mahasiswa GenerateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
