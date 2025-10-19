<?php

namespace App\Filament\Resources\ActicleResource\Pages;

use App\Filament\Resources\ActicleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListActicles extends ListRecords
{
    protected static string $resource = ActicleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
