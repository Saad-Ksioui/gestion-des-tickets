<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        $currentUser = auth()->user();
        return view('auth.profile', compact('currentUser'));
    }
}
