<?php

namespace App\Filament\Resources\WidowResource\Pages;

use App\Filament\Resources\WidowResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWidow extends EditRecord
{
    protected static string $resource = WidowResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
