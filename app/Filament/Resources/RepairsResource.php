<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Repair;
use App\Models\Repairs;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\RepairsResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\RepairsResource\RelationManagers;

class RepairsResource extends Resource
{
    protected static ?string $model = Repair::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('asset_id')
                ->relationship('asset','assetno')
                ->searchable(),
                Select::make('fault_id')
                ->relationship('fault','name')
                ->searchable(),
          
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('asset.assetno'),
                Tables\Columns\TextColumn::make('fault.name'),
                TextColumn::make('status')
                ->badge(),
                TextColumn::make('created_at')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListRepairs::route('/'),
            'create' => Pages\CreateRepairs::route('/create'),
            'edit' => Pages\EditRepairs::route('/{record}/edit'),
        ];
    }
}
