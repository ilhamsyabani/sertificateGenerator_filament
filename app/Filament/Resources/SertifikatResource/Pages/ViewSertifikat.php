<?php

namespace App\Filament\Resources\SertifikatResource\Pages;

use App\Filament\Resources\SertifikatResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSertifikat extends ViewRecord
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
        return $headerActions;
    }
}

