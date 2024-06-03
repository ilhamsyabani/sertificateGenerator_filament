<?php

namespace App\Filament\Resources\SertifikatResource\Pages;

use App\Filament\Resources\SertifikatResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\Sertifikat;

class ListSertifikats extends ListRecords
{
    protected static string $resource = SertifikatResource::class;

    protected function getHeaderActions(): array
    {
        $headerActions = [
            \EightyNine\ExcelImport\ExcelImportAction::make()
                ->slideOver()
                ->color("primary")
                ->use(\App\Imports\SertifikatImport::class),
            Actions\CreateAction::make(),
            
        ];
        // dd($headerActions);
        // // Memperbaiki kesalahan penulisan dan mengupdate link sertifikat setelah import
        // $this->afterCreate(); // Memanggil metode afterCreate untuk menambahkan link setelah import

        return $headerActions;
    }

    protected function afterCreate(): void
    {
        dd($this);
        // Mengambil instance Sertifikat yang baru dibuat
        $sertifikat = Sertifikat::find($this->id);

        // Memperbaiki kesalahan penulisan dan mengupdate link sertifikat
        $sertifikat->sertifikat_link = "https://sertifikat.test/serifikat/{$this->record->id}";

        // Menyimpan perubahan ke database
        $sertifikat->save();
    }
}
