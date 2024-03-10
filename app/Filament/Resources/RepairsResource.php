<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Repair;
use App\Models\Repairs;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Tables\Table;
use App\Enums\RepairStatus;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Actions\SelectAction;
use Illuminate\Support\HtmlString;
use Filament\Actions\RestoreAction;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\RepairsResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\RepairsResource\RelationManagers;

class RepairsResource extends Resource
{
    protected static ?string $model = Repair::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench';
    
    protected static ?string $navigationGroup = 'Repairs';

    protected static ?string $navigationBadgeTooltip = 'Open Repairs';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'Open')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::where('status', 'Open')->count() > 1 ? 'danger' : 'primary';
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
                // Select::make('status')
                //     ->options(RepairStatus::class)
                //     ->rules(['required']),
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
                        return(new HtmlString( $r->id. ' <br /> '. $r->created_at->format('d M y')  )) ;
                    }),
                    // ->label(new HtmlString('Home <br /> number'))
                Tables\Columns\TextColumn::make('asset.assetno')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fault.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Created By')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('assignedto.name')
                    ->label('Assigned To')
                    ->default('Not Assinged.')
                    ->searchable(),
                // TextColumn::make('created_at')
            ])
            ->filters([
                //
            ])
            ->toggleColumnsTriggerAction(
                fn (Action $action) => $action
                    ->button()
                    ->label('Toggle columns'),
            )
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
                    ExportBulkAction::make()
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
            'view' => Pages\ViewRepair::route('/{record}'),          
            'edit' => Pages\EditRepairs::route('/{record}/edit'),
        ];
    }
}
