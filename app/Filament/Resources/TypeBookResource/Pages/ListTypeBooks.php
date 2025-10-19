<?php

namespace App\Filament\Resources\TypeBookResource\Pages;

use App\Filament\Resources\TypeBookResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTypeBooks extends ListRecords
{
    protected static string $resource = TypeBookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
