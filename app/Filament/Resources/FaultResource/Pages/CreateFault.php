<?php

namespace App\Filament\Resources\FaultsResource\Pages;

use App\Filament\Resources\FaultsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFaults extends CreateRecord
{
    protected static string $resource = FaultsResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
{
    $data['user_id'] = auth()->id();
 
    return $data;
}
}
