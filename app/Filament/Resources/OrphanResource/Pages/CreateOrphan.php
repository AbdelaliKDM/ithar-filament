<?php

namespace App\Filament\Resources\OrphanResource\Pages;

use App\Filament\Resources\OrphanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrphan extends CreateRecord
{
    protected static string $resource = OrphanResource::class;
}
