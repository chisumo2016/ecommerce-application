### PROJECT BACKEND BRAND OPTION SETUP

 ## Brand Page Design Part 1
    Gonna woork with bacckend design for the brand page.
    Open the sidebar for our admin panel 
         resources/views/admin/partials/sidebar.blade.php
    Add the name as Brand include the link to view all brand in admin (brand.index)
    Add the route for our brand in web file
    Create the controller for our brand
      php artisan make:controller Backend/BrandController --resource --model=Brand
    Create migration for our brand
      php artisan make:migration create_brands_table --create=brands
    Add the mass assignment to our brand
      //php artisan make:model Brand --migration --fillable=name,slug,description,logo,status
    Migrate our brand
      php artisan migrate
    create a mmethod for our brandController
    Create a folder called brands in our resources/views/admin/brands/index
        Design the Index to display thee data 
        Loop the brands 
        access the property


 ## Brand Page Design Part 2
     - Design the create ui
     - Add the anchor tag to create a brand in index page
     - Add the route name in the form
     - Add the enctype too uplad the image
     - Create the route in the web

 ## Brand Page Design Part 3
     - Design the create ui
     - Add the anchor tag to create a brand in index page
     - Add the route name in the form
     - Add the enctype too uplad the image
     - Create the route in the web

 ## Add Active Side Menu
      - add the active on side menu
      @php
            $prefix = Request::route()->getPrefix();
            $route = Route::current()->getName();
            dd($route)
        @endphp
     <a href="{{ url('admin/dashboard') }}" class="nav-link {{ ($route == 'dashboard') ? 'active' : '' }}">
 ## Install Image Intervation Package
 ## Brand CRUD  part 1
 ## Brand CRUD  part 2
 ## Brand CRUD  part 3 Delete with sweet alert alert2