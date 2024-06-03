<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SertifikatResource\Pages;
use App\Filament\Resources\SertifikatResource\RelationManagers;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Models\Instansi;
use App\Models\Sertifikat;
use Doctrine\DBAL\Schema\Schema;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Infolist;

class SertifikatResource extends Resource
{
    protected static ?string $model = Sertifikat::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-badge';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Sertifikat'),
                        TextInput::make('recipient_name')
                            ->label('Pemilik Sertifikat'),
                        Select::make('instansi_id')
                            ->label('Instansi')
                            ->options(Instansi::all()
                                ->pluck('institusi_name', 'id')),
                        Textarea::make('description')
                            ->label('Isi Setifikat'),
                        DatePicker::make('validated_at')
                            ->label('Mas Berlaku')
                            ->native(false)
                            ->firstDayOfWeek(7),
                        TextInput::make('certificate_url')
                            ->label('Link Sertifikat'),
                    ])
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Sertifikat')
                    ->schema([
                        TextEntry::make('id'),
                        TextEntry::make('sertifikat_name')->size('lg')->weight('bold')
                    ])
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('certificate_url')->label('URL')->copyable()
                    ->copyMessage('Copied!'),
                TextColumn::make('title')
                    ->label('Judul Sertifikat')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('recipient_name')
                    ->label('Pemilik Sertifikat')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('institusi.institusi_name')
                    ->label('Instansi')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('validity_period')
                    ->label('Masa Berlaku'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                ExportBulkAction::make(),
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
            'index' => Pages\ListSertifikats::route('/'),
            'create' => Pages\CreateSertifikat::route('/create'),
            'view' => Pages\ViewSertifikat::route('/{record}'),
            'edit' => Pages\EditSertifikat::route('/{record}/edit'),
        ];
    }
}
