<?php

namespace App\Filament\Resources\Items\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_barang')
                    ->required(),
                TextInput::make('kode_barang')
                    ->required(),
                TextInput::make('stok')
                    ->required()
                    ->numeric(),
                TextInput::make('harga')
                    ->required()
                    ->numeric(),
                TextInput::make('kondisi')
                    ->required(),
                TextInput::make('lokasi')
                    ->required(),
                Textarea::make('deskripsi')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('image')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('users_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
