### PROJECT FRONTEND USER PROFILE SETUP

 ## User Profile Design Part 1
    Once the user has been login in , will be redirected to the dashboard.
    Dashboard is loaded from  web 
        Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
         return view('dashboard');
        })->name('dashboard');
    resources/views/dashboard.blade.php
    Extends tpo the frontend layout master
    Design the the user profile via dashboard

 ## User Profile Design Part 2
    Add the route name to logout 
       <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
    Add the route name in web file
        Route::get('/user/logout', 'Auth\LoginController@logout')->name('user.logout');
    Add the function to logout IndexController
        public function logout()
        {
            Auth::logout();
            return redirect()->route('user.login');
        }
    To update the user profile, add the link in dashboard of the user profile
        <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
    Add the route name in web file
       Route::get('/user/profile', [IndexController::class ,'profile'])->name('user.profile');
    Add the funcctionality to update the profile ,by passing the user id to the function
        public function profile($id)
        {
            $user = User::findOrFail($id);
            return view('user.profile', compact('user'));
        }
        
 ## User Profile Design Part  3
    we need to copy the dashboard.blade.php to the user profile
    create the form for the user profile
    add the field in the form
    create the route for the user
    Add the functionality in store IndexController , copy the code from AdminProfileController
    Create a folder user_images in public/upload  public/upload/user_images
    Display the image in the user profile
    we need to pass the data into dashboard via web file
       $id = Auth::user()->id;
       $user = User::find($id);
    Pass the varioable into the dashboard
    Add the unlink method @unlink(public_path('/upload/user_images'.$data->profile_photo_path));

## Toastr Alert Add Toastr Alert
    To add  alert message in the dashboard with Toastr
    To dispaly the toastr  in the dashboad
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            @if(Session::has('success'))
                toastr.success("{{ Session::get('success') }}")
            @endif
        </script>
    To use the toasr in indexController
         $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('dashboard')->with($notification);

## User Profile Password Change 1
    The  login user can change the password by clicking the change password button
    Create thee route name in the user_profile.blade.php
        <a href="{{ route('user.change.password') }}" class="btn btn-primary btn-sm btn-block">Change Password</a>
    Add the route name in the web file
        Route::get('/user/change-password', [IndexController::class ,'changePassword'])->name('user.change-password');
    Create the method above in Index Controller
          public function changePassword()
            {
                return view('frontend.profile.change_password');
        
            }
     Load the page called change-password.blade.php
     Take the code from user_profile.blade.php and paste it in change_password.blade.php
     Open the update-password.blade.php and compare the code
           resources/views/profile/update-password-form.blade.php
    use the query builder to display the image, PASS THE UI 
      @php
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
     @endphp

## User Profile Password Change 2
## Upload Project to Github
