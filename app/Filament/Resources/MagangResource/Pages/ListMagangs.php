<?php

namespace App\Filament\Resources\MagangResource\Pages;

use App\Filament\Resources\MagangResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMagangs extends ListRecords
{
    protected static string $resource = MagangResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
