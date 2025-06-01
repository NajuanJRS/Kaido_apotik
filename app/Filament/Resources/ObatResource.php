<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ObatResource\Pages;
use App\Filament\Resources\ObatResource\RelationManagers;
use App\Models\Obat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ObatResource extends Resource
{
    protected static ?string $model = Obat::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Obat';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(5),
                Forms\Components\TextInput::make('nama_obat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('id_kategori')
                    ->label('Kategori Obat')
                    ->relationship('kategori_obat', 'nama_kategori')
                    ->required(),
                    Forms\Components\Select::make('bentuk_satuan')
                    ->options([
                        'Tablet' => 'Tablet',
                        'Kapsul' => 'Kapsul',
                        'Sirup' => 'Sirup',
                        'Suspensi' => 'Suspensi',
                        'Salep' => 'Salep',
                        'Krim' => 'Krim',
                        'Suppositoria' => 'Suppositoria',
                        'Injeksi' => 'Injeksi',
                        'Drops (tetes)' => 'Drops (tetes)',
                        'Inhaler' => 'Inhaler',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('harga')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('stok')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('kadaluarsa')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_obat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kategori_obat.nama_kategori')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bentuk_satuan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('harga')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('stok')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kadaluarsa')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListObats::route('/'),
            'create' => Pages\CreateObat::route('/create'),
            'edit' => Pages\EditObat::route('/{record}/edit'),
        ];
    }
}
