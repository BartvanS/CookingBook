<?php

namespace Tests\Feature\Services;

use App\Services\DurationConverter;
use Tests\TestCase;

class DurationConverterTest extends TestCase
{
    /**
     * @dataProvider durationProvider
     */
    public function testToMinutes(string $time, int $minutes)
    {
        $this->assertEquals(DurationConverter::toMinutes($time), $minutes);
    }

    /**
     * @dataProvider durationProvider
     */
    public function testToTime(string $time, int $minutes)
    {
        $this->assertEquals(DurationConverter::toTime($minutes), $time);
    }

    /**
     * @dataProvider durationProvider
     */
    public function testToHuman(string $time, int $minutes, string $human)
    {
        $this->assertEquals(DurationConverter::toHuman($minutes), $human);
    }

    public function durationProvider(): array
    {
        return [
            ['00:00', 0, '0 min'],
            ['00:01', 1, '1 min'],
            ['00:59', 59, '59 min'],
            ['01:00', 60, '1 uur'],
            ['01:01', 61, '1 uur 1 min'],
            ['02:30', 150, '2 uur 30 min'],
        ];
    }
}
