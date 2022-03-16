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

## Laravel 9 Multi Auth Part 2

## Laravel 9 Multi Auth Part 3

## Laravel 9 Multi Auth Part 4

##  Page Redirect After Logout
