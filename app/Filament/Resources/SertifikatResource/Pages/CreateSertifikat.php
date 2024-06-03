<?php

namespace App\Filament\Resources\SertifikatResource\Pages;

use App\Filament\Resources\SertifikatResource;
use App\Models\Sertifikat;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Tables\Columns\TextColumn;

class CreateSertifikat extends CreateRecord
{
    protected function afterCreate(): void
    {
        //  Mengambil instance Sertifikat yang baru dibuat
        $sertifikat = Sertifikat::find($this->record->id);

        // Mengabil url aplikasi dari ENV
        $appUrl = config('app.url');
        // Memperbaiki kesalahan penulisan dan mengupdate link sertifikat
        $sertifikat->certificate_url = "{$appUrl}/sertifikat/{$this->record->id}";

        // Menyimpan perubahan ke database
        $sertifikat->save();

    }

    protected static string $resource = SertifikatResource::class;
}
