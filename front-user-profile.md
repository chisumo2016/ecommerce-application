### PROJECT FRONTEND USER PROFILE SETUP

 ## User Profile Design Part 1
    Once the user has been login in , will be redirected to the dashboard.
    Dashboard is loaded from  web 
        Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
         return view('dashboard');
        })->name('dashboard');
    resources/views/dashboard.blade.php
    Extends tpo the frontend layout master






 ## User Profile Design Part 2
 ## User Profile Design Part  3
