## Install Laravel 9
    Install the Laravel Application via command 

##  Install Laravel 9 Auth 
    Install the Laravel Jetstream via command
    https://jetstream.laravel.com/1.x/installation.html
       - composer require laravel/jetstream
       - php artisan jetstream:install livewire
             Create two folders
                - Fortity
                - Jetstream
             Publish Two Configuration Files 
                - /database/migrations
                - /config/sanctum.php
             Create two files in Config folder
                - fortity.php
                - jetstream.php
    - Run the NPM Scripts
        -npm install && npm run dev

##  Create Database and Migrate
    Create a database in mysql
    Add database credentials environemnt variables
    - Run Migrations
        - php artisan migrate

##  Default Auth System Profile Update
     Uncomment the following lines in the config/jetstream.php file to allow to view the photos of the users
       'features' => [
        // Features::termsAndPrivacyPolicy(),
        Features::profilePhotos(),
        // Features::api(),
        // Features::teams(['invitations' => true]),
        Features::accountDeletion(),
    ],
     Create a link  to the storage to be able to show the image/photo
     php artisan storage:link 
    The dashboard is showing the normal user  as simple authentication

##  Setup Admin Table and Seed Data
    This part will be creating the Multi Authentication system
     We need to create an authentication system for the admin
     We will load on the same page 
          Admin: http://e-commerce.test/admin/login
          User:  http://e-commerce.test/login
     View all the route list
          php artisan route:list
     Create a controller for the admin
          php artisan make:controller AdminController
    Create the table for the admin and model
           php artisan make:model Admin -m
    Add the column/field in the admin migration table by copying from user migration table.
    Copy everthing from the user model and paste it in the admin model
    Change the User class to Admin class
    Migration the admin table
           php artisan migrate
    Insert the admin data in the admin table
       https://laravel.com/docs/9.x/seeding
          php artisan make:seeder AdminSeeder 
           php artisan db:seed --class=AdminSeeder 
    Create the factory for the admin
      https://laravel.com/docs/9.x/database-testing
          php artisan make:factory AdminFactory
    Add the admin factory to the database seeder
         Admin::factory()->create();
    Seed the admin data
          php artisan migrate --seed

    For Multi Authentication we need to create Guard

## Create Guards for Admin
    We need to create a Guard for the admin
    Go to the config/auth.php file and the providers section
        'admin' => [
            'driver' => 'session',
            'provider' => 'admin',
        ],
         Providers
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
    Create the password for the admin
       'admins' => [
            'provider' => 'admins',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    We need to work on login  method in the AuthServiceProvider
       login login › Laravel\Fortify › AuthenticatedSessionController@cr…
        \Laravel\Fortify\Http\Controllers\AuthenticatedSessionController
       StatefulGuard is the interface for the guard
       Check into the FortifyServiceProvider file ,there's a method to register the Guard
       There's two fortify file
            app/Providers/FortifyServiceProvider.php
            vendor/laravel/fortify/src/Providers/FortifyServiceProvider.php
        we need to work on register method inside app/Providers/FortifyServiceProvider.php
        we need to create the statefulGuard for our admin
           create a folder called Guards  (app/Guards) and make file called AdminStatefulGuard.php
           copy everything from the StatefulGuard.php file and paste it in the AdminStatefulGuard.php file


## Laravel 9 Multi Auth Part 1
    The StatefulGuard can be found in vendor/laravel/framework/src/IIuminate/Contracts/Auth/StatefulGuard.php:5
    We need tp change our namespace  to namespace App\Guards; in the AdminStatefulGuard.php file
    we need to update our Admincontroller by copying everthing from AuthenticatedSessionController and paste it in the AdminController.php file
       Update our namespace namespace App\Http\Controllers;
    Create a web route 
       create a group of routes in the web.php file for login  and middleware for admin and web
    Create loginForm into AdminController
       public function loginForm()
        {
            return view('auth.login',['guard' =>'admin']);
        }
    We're using the same view for the admin and the user (views/auth/login.blade.php)
       Insiide the auth.login.blade.php file we need to change the guard to admin   
            <form method="POST" action="{{ isset($guard) ? url($guard.'/login') : route('login') }}"></form>
                localhost:8000/admin/login
                localhost:8000/login
    In the AdminController we need to support the following files 
          RedirectIfTwoFactorAuthenticatable::class : null,
         AttemptToAuthenticate::class,
         PrepareAuthenticatedSession::class,
     View all in vendor/laravel/fortify/src/Actions/AttemptToAuthenticate.php
        Copy the following files and paste into the app/actions/Fortity folder
            AttemptToAuthenticate.php
            RedirectIfTwoFactorAuthenticatable.php
    AttemptToAuthenticate file we need to make modifications  
       To change our namespace to App\Actions\Fortify 
            namespace App\Actions\Fortify;
    RedirectIfTwoFactorAuthenticatable.php  file we need to make modifications  
      To change our namespace to App\Actions\Fortify 
            namespace App\Actions\Fortify;
    You dont need to change anytthing , will be the same as the original file

## Laravel 9 Multi Auth Part 2
    We need to create another function inside the RouteServiceProvider
    public static function redirectTo($guard)
    {
    return $guard. '/dashboard';
    }
    Wee need to pass the guard to the RedirectifAuthenticated.php
    return redirect($guard. '/dashboard');
    We need to create a middlware for our AdminRedirectIfAuthenticated
    php artisan make:middleware AdminRedirectIfAuthenticated
    copy everthing from the RedirectIfAuthenticated.php file and paste it in the AdminRedirectIfAuthenticated.php file
    Register the middleware into our kernel
         'admin' => \App\Http\Middleware\AdminRedirectIfAuthenticated::class,
    Go to AdminController  and look for store method , look for LoginResponse and open (vendor/laravel/fortify/src/Http/Responses/LoginResponse.php)
       Create another folder called Responses and make file called LoginResponse.php
       Copy everything from the LoginResponse.php file and paste it in the LoginResponse.php file
       Update the namespace to namespace App\Http\Responses;
       We need to redirect to our admin/dashboard
          : redirect()->intended(Fortify::redirects('admin/dashboard'));
    Test the application if it's working as it should be 
        localhost:8000/admin/login
        localhost:8000/admin/dashboard  some bugs not directing to dashboard but it's working
        

## Laravel 9 Multi Auth Part 3
    We successfully logged in as an admin and user but not redirecting to the dashboard
    The problem is happening in the AdminController  we should change responses
      CHANGE:  use Laravel\Fortify\Contracts\LoginResponse; 
      TO    :  use App\Http\Responses\LoginResponse;

    Inside the AdminController we need to change the redirect to the dashboard
      CHANGE:   : redirect()->intended(Fortify::redirects('admin/dashboard'));
      TO    :  : redirect()->intended('admin/dashboard');
## Laravel 9 Multi Auth Part 4

##  Page Redirect After Logout
