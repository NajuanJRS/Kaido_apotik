<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RiwayatResource\Pages;
use App\Filament\Resources\RiwayatResource\RelationManagers;
use App\Models\Riwayat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RiwayatResource extends Resource
{
    protected static ?int $navigationSort = 3;
    protected static ?string $model = Riwayat::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Riwayat';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_resep')
                    ->required()
                    ->numeric(),
                Forms\Components\DateTimePicker::make('tanggal_diterima')
                    ->required(),
                Forms\Components\DateTimePicker::make('tanggal_selesai')
                    ->required(),
                Forms\Components\TextInput::make('status')
                    ->required(),
            ]);
    }

    public static function getNavigationIcon(): string|\Illuminate\Contracts\Support\Htmlable|null
    {
        return view('components.icons.riwayat');
    }

    public static function canViewAny(): bool
    {
        $user = auth()->user();
        return $user->hasRole(['super_admin', 'admin', 'petugas']);
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canViewAny();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_resep')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_diterima')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status'),
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
            'index' => Pages\ListRiwayats::route('/'),
            'create' => Pages\CreateRiwayat::route('/create'),
            'edit' => Pages\EditRiwayat::route('/{record}/edit'),
        ];
    }
}
