<?php

namespace App\Filament\Resources\RepairsResource\Pages;

use App\Enums\RepairStatus;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\RepairsResource;
use App\Models\Repair;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListRepairs extends ListRecords
{
    protected static string $resource = RepairsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }


    public function getTabs(): array
    {
        return [
            'all' => Tab::make()
                ->badgeColor('gray')
                ->badge(Repair::query()->count()),
            'My Repairs' => Tab::make()
                ->icon('heroicon-m-user')
                ->badgeColor('primary')
                ->badge(Repair::query()->where('assigneduser_id', Auth::id())->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('assigneduser_id', Auth::id())),
            'Open' => Tab::make()

                ->badgeColor('danger')
                ->badge(Repair::query()->where('status', RepairStatus::Open->value)->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Open')),
            'In Progress' => Tab::make()

                ->badge(Repair::query()->where('status', RepairStatus::Work_In_Progress->value)->count())
                ->badgeColor('warning')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Work_In_Progress')),
            'Completed' => Tab::make()
                ->badgeColor('success')
                ->icon('heroicon-o-check-circle')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', RepairStatus::Completed->value)),


        ];
    }
}
