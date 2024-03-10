<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use App\Models\Repair;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use App\Filament\Resources\RepairsResource;
use Filament\Widgets\TableWidget as BaseWidget;

class RepairsTable extends BaseWidget
{

    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';
    protected int | string | array $rowSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->query(RepairsResource::getEloquentQuery()
            )
            ->defaultPaginationPageOption(10)
            ->defaultSort('created_at','Asc')
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
            ]);
    }
}
