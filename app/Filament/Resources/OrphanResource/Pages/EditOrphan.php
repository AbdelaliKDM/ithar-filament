<?php

namespace App\Filament\Resources\OrphanResource\Pages;

use App\Filament\Resources\OrphanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrphan extends EditRecord
{
    protected static string $resource = OrphanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
