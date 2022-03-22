<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
     public function index()
    {
        return view('frontend.index');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

    public function profile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_profile', compact('user'));
    }

    public function UserProfile(Request $request)
    {
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if($request->hasFile('profile_photo_path')) {
            $image = $request->file('profile_photo_path');
            @unlink(public_path('/upload/user_images'.$data->profile_photo_path));
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/upload/user_images');
            $image->move($destinationPath, $image_name);
            $data->profile_photo_path = $image_name;
        }
        $data->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('dashboard')->with($notification);
    }

    public function UserChangePassword()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.change_password',compact('user'));

    }

    public function UserUpdatePassword(Request $request)
    {
        $validatedData = $request->validate([
            'oldpassword'  => 'required',
            'password'      => 'required|confirmed',
            //'password_confirmation' => 'required|min:6',
        ]);

        $hashPassword = Auth::user()->password;// authenticated user password

        if(Hash::check($request->oldpassword,$hashPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();

            $notification = array(
                'message' => 'User Password Changed Successfully',
                'alert-type' => 'success'
            );

            Auth::logout();
            return redirect()->route('user.logout')->with($notification);
        } else {
            return redirect()->back();
        }

    }
}

