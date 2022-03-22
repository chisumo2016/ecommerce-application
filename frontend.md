### PROJECT FRONTEND TEMPLATE SETUP

## Frontend Template Setup Part 1
       Load the frontend template 
       Create frontend folder in views 
          Inside frontend folder create index.blade.php file and main.blade.php file
       Create frontend folder and subfolders in public save some css js and images
      Use the asset() function to load the css and js files
      Segment the frontend template into multiple files
            Header.blade.php
            Footer.blade.php
            Brands.blade.php
    Create a home routes file in web.php
       Route::get('/logout', [IndexController::class ,'index']);

## Frontend Template Setup Part 2
      Create a IndexController class in controllers folder
      Rertun the index view in the index method of the IndexController class
      Link the images and css files in the public folder
      We segment all the parts of the frontend template into different files


## Frontend Template Login Page Setup
    When we install the laravel authentication system , we get the default login page
    The theme is loaded from resources/views/auth/login.blade.php
    We want to change the login page to our own login page(theme)
    we need to extends the file to main master of frontend template
    Copy theme and paste to the main.blade.php file
    Use the existing(default) login page to compare with new login page
    Separate the brands
    Compare the default login with new login page to change value and try login


## Frontend Template Register Page Setup
    We have the register default page from jetsream package
    we need to change the register page to our own register page(theme)
    we have add the new fields in the register page
    we need to Update the users table in the database
    Update the user model
    Update the register page
    Update the createNewUser in fortify 
    To show the validatioon errors
    Works fine
    Try to access the localhost:8000/register ,show the default register page
    Copy evertying from the login page and paste to the register page
    Update the login button in the header
      <li><a href="{{ route('login')  }}"><i class="icon fa fa-lock"></i>Login/Register</a></li>
    Update the url('/) to access the home page
    We can disable the link above by
           @guest()
           @else
            @endguest

            @auth
            @else
            @endauth

## Frontend Template Password Page Setup


