<?php

namespace App\Filament\Resources\RepairsResource\Pages;

use App\Filament\Resources\RepairsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRepairs extends CreateRecord
{
    protected static string $resource = RepairsResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        $data['workdone'] = 'none';
        $data['assigneduser_id'] = 0;
        return $data;
    }
}
