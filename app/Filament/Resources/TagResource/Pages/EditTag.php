<?php

declare(strict_types=1);

namespace App\Filament\Resources\TagResource\Pages;

use App\Filament\Resources\TagResource;
use Filament\Resources\Pages\EditRecord;

final class EditTag extends EditRecord
{
    protected static string $resource = TagResource::class;
}
