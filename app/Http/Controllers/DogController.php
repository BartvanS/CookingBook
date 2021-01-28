<?php

namespace App\Http\Controllers;

class DogController extends Controller
{
    public function __invoke()
    {
        $dogs = [
            'pug.gif',
            'bruin.gif',
            'wit.gif',
            'witsmol.gif',
            'witzwart.gif',
            'zwart.gif',
        ];

        $randomDog = array_rand($dogs);
        $path = asset('img/' . $dogs[$randomDog]);

        return view('dog')->with('img', $path);
    }
}
