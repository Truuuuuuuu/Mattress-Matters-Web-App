<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings', [
            'theme' => auth()->user()->theme,
        ]);
    }

    public function updateTheme(Request $request)
    {
        $request->validate(['theme' => ['required', 'in:light,dark']]);

        auth()->user()->update(['theme' => $request->theme]);

        return redirect()->route('settings.index');
    }
}
