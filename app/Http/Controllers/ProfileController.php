<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{

    public function index()
    {
        return view('profiles.index');
    }

    public function show(Request $request, $uuid)
    {
        $user = Session::get('users')[$uuid] ?? null;
        if (!$user) {
            return redirect()->route('profiles.index')->with('error', 'User not found');
        }

        return view('profiles.show', compact('user'));
    }
}
