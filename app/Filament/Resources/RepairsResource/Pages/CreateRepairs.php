<?php

namespace App\Filament\Resources\RepairsResource\Pages;

use Filament\Actions;
use App\Enums\RepairStatus;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\RepairsResource;

class CreateRepairs extends CreateRecord
{
    protected static string $resource = RepairsResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        $data['workdone'] = 'none';
        $data['assigneduser_id'] = 0;
        $data['status'] = RepairStatus::Open->value;
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
