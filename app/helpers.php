<?php

declare(strict_types=1);

function documentTitle(?string $title = null): string
{
    $name = config('app.name');

    if (is_null($title)) {
        return $name;
    }

    return sprintf('%s | %s', $title, $name);
}
