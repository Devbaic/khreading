<?php

namespace App\Filament\Resources\ActicleResource\Pages;

use App\Filament\Resources\ActicleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditActicle extends EditRecord
{
    protected static string $resource = ActicleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
