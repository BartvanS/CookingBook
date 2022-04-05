<?php

declare(strict_types=1);

beforeEach(function (): void {
    config()->set('app.name', 'Laravel');
});

it('has fallback title', function (): void {
    $this->assertEquals('Laravel', documentTitle());
});

it('has page title', function (): void {
    $this->assertEquals('Account | Laravel', documentTitle('Account'));
});
