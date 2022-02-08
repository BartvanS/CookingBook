<?php

declare(strict_types=1);

namespace App\Filament\Resources\CommentResource\Pages;

use App\Filament\Resources\CommentResource;
use Filament\Resources\Pages\ListRecords;

final class ListComments extends ListRecords
{
    protected static string $resource = CommentResource::class;
}