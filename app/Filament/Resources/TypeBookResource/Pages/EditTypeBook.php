<?php

namespace App\Filament\Resources\TypeBookResource\Pages;

use App\Filament\Resources\TypeBookResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypeBook extends EditRecord
{
    protected static string $resource = TypeBookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
