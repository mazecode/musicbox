<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SinglePageController extends Controller
{
    /**
     * Single Page Application method
     *
     * @return void
     */
    public function index()
    {
        $config = [
            'appName' => config('app.name'),
            'locale' => app()->getLocale(),
            'locales' => config('app.locales'),
            'apiUrl' => url('/api'),
        ];

        return view('app', compact('config'));
    }
}
