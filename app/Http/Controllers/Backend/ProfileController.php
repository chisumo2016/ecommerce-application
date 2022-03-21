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

    public function edit()
    {
        $profile_edit = Admin::find(1);
        return view('backend.profile.edit', compact('profile_edit'));
    }

    public function store(Request $request)
    {
        $profile_update = Admin::find(1);
        $profile_update->name = $request->name;
        $profile_update->email = $request->email;

        if($request->hasFile('profile_photo_path')) {
            $image = $request->file('profile_photo_path');
            @unlink(public_path('/upload/admin_images'.$profile_update->profile_photo_path));
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/upload/admin_images');
            $image->move($destinationPath, $image_name);
            $profile_update->profile_photo_path = $image_name;
        }
        $profile_update->save();

        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.profile')->with($notification);
    }

}
