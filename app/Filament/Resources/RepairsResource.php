<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Repair;
use App\Models\Repairs;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Enums\RepairStatus;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Actions\SelectAction;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\RepairsResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\RepairsResource\RelationManagers;
use Filament\Pages\Page;

class RepairsResource extends Resource
{
    protected static ?string $model = Repair::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench';
    protected static ?string $navigationGroup = 'Repairs';
 
    public static function getNavigationBadge(): ?string
{
    return static::getModel()::where('status','Open')->count();
}

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('asset_id')
                    ->relationship('asset', 'assetno'),
                Select::make('fault_id')
                    ->relationship('fault', 'name')
                    ->searchable(),
                Select::make('status')
                    ->options(RepairStatus::class)
                    ->rules(['required']),
                // Select::make('users_id')
                // ->label('Assigned User')
                // ->multiple()
                // ->relationship('user','name')



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
      
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Jobcard number')
                    ->formatStateUsing(function ($state, Repair $r) {
                        return $r->created_at . ' - ' . $r->id;
                    }),
                Tables\Columns\TextColumn::make('asset.assetno'),
                Tables\Columns\TextColumn::make('fault.name'),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Created By'),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('assignedto.name')
                    ->label('Assigned To'),
                // TextColumn::make('created_at')
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('Assign user')
                ->label('')
                ->icon('heroicon-o-user-plus')
                    ->form([
                        Select::make('assigneduser_id')
                            ->label('Assign User')
                            ->searchable()
                            ->relationship('assignedto', 'name')
                            ->required(),
                    ])->action(function (Repair $repair, array $data): void {
                        $repair->assigneduser_id = $data['assigneduser_id'];
                        $repair->status = RepairStatus::Work_In_Progress->value;
                        $repair->save();

                        Notification::make()
                            ->title('User successfully Assigned')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\ViewAction::make()->label(''),
                Tables\Actions\EditAction::make()->label(''),
                Tables\Actions\DeleteAction::make()->label(''),


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
            'view' => Pages\ViewRepair::route('/{record}'),
            'create' => Pages\CreateRepairs::route('/create'),
            'edit' => Pages\EditRepairs::route('/{record}/edit'),
        ];
    }

    

    
}
