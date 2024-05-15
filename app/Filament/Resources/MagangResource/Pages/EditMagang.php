<?php

namespace App\Filament\Resources\MagangResource\Pages;

use App\Filament\Resources\MagangResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMagang extends EditRecord
{
    protected static string $resource = MagangResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
