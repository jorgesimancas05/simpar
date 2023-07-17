<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function change(Request $request)
    {
        if ($request->isMethod('post')) {
            $language = $request->language;
            if (in_array($language, ['en', 'es'])) {
                session(['locale' => $language]);
            }
        }
        return redirect()->back();
    }

}

