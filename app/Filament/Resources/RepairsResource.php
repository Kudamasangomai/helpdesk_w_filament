<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Repair;
use App\Models\Repairs;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\RepairsResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\RepairsResource\RelationManagers;
use Filament\Forms\Components\Select;

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
                ->searchable()
            ]);
    }

    // $table->id()->startingValue(1000000);
    // $table->foreignId('asset_id')->constrained('assets')->cascadeOnDelete();
    // $table->foreignId('fault_id')->constrained('faults')->cascadeOnDelete();
    // $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
    // $table->enum('status',['Open','Work In Progress','Completed'])->default('Open');
    // $table->integer('closeby')->unsigned()->default(0);
    // $table->string('workdone');

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
