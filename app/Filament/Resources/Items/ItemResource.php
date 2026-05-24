<?php

namespace App\Filament\Resources\Items;

use App\Filament\Resources\ItemResource\Pages\CreateItem as PagesCreateItem;
use App\Filament\Resources\Items\Pages\CreateItem;
use App\Filament\Resources\Items\Pages\EditItem;
use App\Filament\Resources\Items\Pages\ListItems;
use App\Models\Item;
use BackedEnum;
use Filament\Actions\BulkActionGroup as ActionsBulkActionGroup;
use Filament\Actions\DeleteAction as ActionsDeleteAction;
use Filament\Actions\DeleteBulkAction as ActionsDeleteBulkAction;
use Filament\Actions\EditAction as ActionsEditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'item';

    public static function form(Schema $form): Schema
    {
        return $form
            ->schema([
                TextInput::make('nama_barang')
                    ->label('Nama Barang')
                    ->placeholder('Contoh: Laptop Lenovo ThinkPad')
                    ->required()
                    ->maxLength(255),

                TextInput::make('kode_barang')
                    ->label('Kode Barang')
                    ->placeholder('Contoh: BRG-001')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                TextInput::make('stok')
                    ->label('Jumlah Stok')
                    ->numeric()
                    ->required()
                    ->minValue(0),

                TextInput::make('harga')
                    ->label('Harga Satuan (Rp)')
                    ->numeric()
                    ->required()
                    ->minValue(0)
                    ->prefix('Rp'),

                Select::make('kondisi')
                    ->label('Kondisi Barang')
                    ->options([
                        'Baik' => 'Baik',
                        'Rusak Ringan' => 'Rusak Ringan',
                        'Rusak Berat' => 'Rusak Berat',
                    ])
                    ->required(),

                Select::make('lokasi')
                    ->label('Lokasi Penyimpanan')
                    ->options([
                        'Gudang A' => 'Gudang A',
                        'Gudang B' => 'Gudang B',
                        'Gudang C' => 'Gudang C',
                    ])
                    ->required(),

                Textarea::make('deskripsi')
                    ->label('Deskripsi Barang')
                    ->placeholder('Jelaskan detail barang ini')
                    ->required()
                    ->rows(3),

                FileUpload::make('image')
                    ->label('Foto Barang')
                    ->image()
                    ->directory('items')
                    ->visibility('public')
                    ->required(),

                Hidden::make('users_id'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Foto')
                    ->disk('public'),

                TextColumn::make('kode_barang')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nama_barang')
                    ->label('Nama Barang')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('stok')
                    ->label('Stok')
                    ->sortable(),

                TextColumn::make('harga')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('kondisi')
                    ->label('Kondisi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Baik' => 'success',
                        'Rusak Ringan' => 'warning',
                        'Rusak Berat' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('lokasi')
                    ->label('Lokasi')
                    ->badge(),

                TextColumn::make('user.name')
                    ->label('Ditambahkan Oleh'),

                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionsEditAction::make(),
                ActionsDeleteAction::make(),
            ])
            ->bulkActions([
                ActionsBulkActionGroup::make([
                    ActionsDeleteBulkAction::make(),
                ]),
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
            'index' => ListItems::route('/'),
            'create' => PagesCreateItem::route('/create'),
            'edit' => EditItem::route('/{record}/edit'),
        ];
    }
}