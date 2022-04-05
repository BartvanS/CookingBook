<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\DogService;

/**
 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 * ====================================
 * legacy code, dont remove or code breaks!
 * ====================================
 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 */
final class DogController extends Controller
{
    public function __invoke(DogService $dogService)
    {
        return view('dog')->with('img', $dogService->randomImage());
    }
}
