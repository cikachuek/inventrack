<?php

namespace App\Filament\Resources\Suppliers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SupplierForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_perusahaan')
                    ->required(),
                TextInput::make('nama_kontak')
                    ->required(),
                TextInput::make('telepon')
                    ->tel()
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                Textarea::make('alamat')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('image')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
