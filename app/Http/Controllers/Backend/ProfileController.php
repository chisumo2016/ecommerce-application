<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

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

    public function changePassword()
    {
        return view('backend.profile.change_password');
    }

    public function updatePassword(Request $request)
    {

        $validatedData = $request->validate([
            'oldpassword'  => 'required',
            'password'      => 'required|confirmed',
            //'password_confirmation' => 'required|min:6',
        ]);

        $hashPassword = Admin::find(1)->password;//db

        if(Hash::check($request->oldpassword,$hashPassword)) {
            $profile_admin = Admin::find(1);
            $profile_admin->password = Hash::make($request->password);
            $profile_admin->save();
            Auth::logout();
            return redirect()->route('admin.logout');
        } else {
            return redirect()->back();
        }
        //$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
        }

}
