## BACKEND - ADMIN PANEL
    In admin section , user is unable to access the profile page .Will sorted
    We will use a two theme to archive the admin panel and frontend.
            Admin Theme
            Frontend Theme
## Admin Template Setup
    We need to load the admin panel template to the admin area ,when the admin has logged in.
    - Create a folder named backend  in public and paste the css image and js file in it.
    - Create a folder named admin in views  and create a admin_master.blade.php file in it.
    - Create a folder named partials in views/admin
         header.blade.php
         footer.blade.php
         sidebar.blade.php
    Our main content will be a yield in the admin_master.blade.php file.
        @yield('admin_content')
    Extends  to the admin/index file  
         @extends('admin.admin_master')
         @section('admin_content')
            staff
         @endsection

## Dashboard Page Segmentation
    We gonna seperate the dashboard page into tthree segmentation from our master file.
         header.blade.php
         footer.blade.php
         sidebar.blade.php
    In the master file you should use the @include('admin.partials.header')

## Admin Logout Option
    Once you have login as the admin , you will be redirected admin/dashboard page ,but 
      you will not have the access to logout option.
    We need to create a logout option file in the admin panel.
     Add the logout link in sidebar file in the admin panel.
       and add the logout link href="{{ route('admin.logout') }}"
     Create a route in web file. to create a logout route
         Route::get('/admin/logout', [AdminController::class ,'destroy'])->name('admin.logout');
     In the adminController , there's  destroy method to logout the system
    Call the destroy method in the web route file.
         Route::get('/admin/logout', [AdminController::class ,'destroy'])->name('admin.logout');
    Try - OK

## Customize Login Form
    Customize the login form in the admin panel.we need to have two separate login page for our admin and user.
       before we were sharing one login page.
    Create a new file within the auth folder named admin_login.blade.php
    Select everything from the login form template (theme)and paste it in the auth/admin_login.blade.php file.
    We need to customize the login form by add the {{ asset('backend/') }}
    In order to access the new admin_login file, we need to go to the AdminController and change 
      the view to access the view('auth.admin_login')
    We need to customize the login form as  login.blade.php is for normal user login and we need to 
     create another login for our admin .(admin_login.blade.php)
    Take the value from the normal login form and put into  admin_login.blade.php file.
    In adminController we have logged tp use view('auth.admin_login')
    Try to log as admin and see the difference.
    You can access the admin panel by typing the url http://localhost/admin/login

## Refresh Admin Template
    To clean our dashboard so that can be more organized.
    To clean the sidebar and the index page

## Admin Profile & Image Part 1
     - Create a view page for our profile page.
     - Create a folder named profile in views and create a profile.blade.php file in it.
     - Create the url in the web file for our profile page.
     - Create a controller for our profile page.    
          php artisan make:controller Backend/ProfileController
     - Add  functionality to our Profile Controller
     -Display the profile page information to the view page.
         <img
            class="profile-user-img img-fluid img-circle"
            src="{{ (!empty($data->profile_photo_path)) ? url('upload/admin_images'.$data->profile_photo_path) : url('upload/no_image.jpg') }}" 
            alt="User profile picture">
    - Create a folder upload/admin_images
