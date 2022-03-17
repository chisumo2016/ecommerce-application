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
