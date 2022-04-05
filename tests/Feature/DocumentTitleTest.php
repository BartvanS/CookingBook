<?php

declare(strict_types=1);

it('has fallback title', function (): void {
    $this->assertEquals('Recipes', documentTitle());
});

it('has page title', function (): void {
    $this->assertEquals('Account | Recipes', documentTitle('Account'));
});
