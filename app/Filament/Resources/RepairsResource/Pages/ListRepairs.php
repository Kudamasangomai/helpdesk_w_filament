<?php

namespace App\Filament\Resources\RepairsResource\Pages;

use App\Filament\Resources\RepairsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRepairs extends ListRecords
{
    protected static string $resource = RepairsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
