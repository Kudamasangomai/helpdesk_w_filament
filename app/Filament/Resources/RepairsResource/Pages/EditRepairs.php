<?php

namespace App\Filament\Resources\RepairsResource\Pages;

use App\Filament\Resources\RepairsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRepairs extends EditRecord
{
    protected static string $resource = RepairsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
