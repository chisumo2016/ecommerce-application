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
