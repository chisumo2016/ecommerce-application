<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        $data = Admin::find(1);
        return view('backend.profile.index', compact('data'));
    }
}
