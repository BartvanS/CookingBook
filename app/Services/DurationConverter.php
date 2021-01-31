<?php


namespace App\Services;

class DurationConverter
{
    public static function toMinutes(string $time): int
    {
        $parts = explode(':', $time);

        return (intval($parts[0]) * 60) + intval($parts[1]);
    }

    public static function toTime(int $duration): string
    {
        $hours = intval($duration / 60);
        $minutes = intval($duration % 60);

        return sprintf('%02d', $hours) . ':' . sprintf('%02d', $minutes);
    }

    public static function toHuman(int $duration): string
    {
        $hours = intval($duration / 60);
        $minutes = intval($duration % 60);

        if ($hours > 0) {
            if ($minutes > 0) {
                return $hours . ' uur ' . $minutes . ' min';
            }

            return $hours . ' uur';
        }

        return $minutes . ' min';
    }
}
