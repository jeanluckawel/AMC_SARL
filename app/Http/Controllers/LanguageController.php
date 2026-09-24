<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{
    public function switch(string $locale): RedirectResponse
    {

        if (!in_array($locale, ['fr', 'en'], true)) {
            $locale = 'fr';
        }


        session(['locale' => $locale]);


        return back();
    }
}
