<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class AddressRelationManager extends RelationManager
{
    protected static string $relationship = 'address';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('full_name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255),

                TextInput::make('phone')
                    ->label('Nomor Telepon')
                    ->required()
                    ->tel()
                    ->maxLength(20),

                TextInput::make('province')
                    ->label('Provinsi')
                    ->required()
                    ->maxLength(255),

                TextInput::make('city')
                    ->label('Kabupaten/Kota')
                    ->required()
                    ->maxLength(255),

                TextInput::make('subdistrict')
                    ->label('Kecamatan')
                    ->required()
                    ->maxLength(255),

                TextInput::make('zip_code')
                    ->label('Kode Pos')
                    ->required()
                    ->numeric()
                    ->maxLength(10),
                
                Textarea::make('street_address')
                    ->label('Alamat Lengkap')
                    ->required()
                    ->columnSpanFull()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('street_address')
            ->columns([
                TextColumn::make('full_name')
                    ->label('Nama Lengkap'),

                TextColumn::make('phone')
                    ->label('Nomor Telepon'),
                
                TextColumn::make('province')
                    ->label('Provinsi'),

                TextColumn::make('city')
                    ->label('Kabupaten/Kota'),
                
                TextColumn::make('subdistrict')
                    ->label('Kecamatan'),

                TextColumn::make('zip_code')
                    ->label('Kode Pos'),

                TextColumn::make('street_address')
                    ->label('Alamat Lengkap')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
