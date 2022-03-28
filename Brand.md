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
    We're going to use Image Intervention package
    Links
       https://image.intervention.io/v2
       composer   require intervention/image  
        php artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravelRecent"
 
## Brand CRUD  part 1
    - we need to create the brand record
    - Add the customs message via request
    -Validate the images via controller
    -Use IIntervation to upload the image
    - Create the folder upload/brand
    - Brand::create($request->all());
    - Brand::insert([
            'brand_name_en' => $request->brand_name_en,
            'brand_name_tz' => $request->brand_name_tz,
            'slug_en' => strtolower(str_replace(' ', '_',$request->brand_name_en)),
            'slug_tz' => str_replace(' ', '_',$request->brand_name_tz),
            'image'         => $save_image,
        ]);
            Brand::create([
            'brand_name_en' => $request->brand_name_en,
            'brand_name_tz' => $request->brand_name_tz,
            'slug_en' => strtolower(str_replace(' ', '_',$request->brand_name_en)),
            'slug_tz' => str_replace(' ', '_',$request->brand_name_tz),
            'image'         => $save_image,
        ]);

         $image = $request->file('image');
        $name_gen = hexdec(uniqid()) .'.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
        $save_image = 'upload/brand/'.$name_gen;

        Brand::create([
            'brand_name_en' => $request->brand_name_en,
            'brand_name_tz' => $request->brand_name_tz,
            'slug_en' => strtolower(str_replace(' ', '_',$request->brand_name_en)),
            'slug_tz' => str_replace(' ', '_', $request->brand_name_tz),
            'image'         => $save_image,
        ]);
       The cleaner way 
           $data = $request->validated();

        $data['image'] =  '/upload/no_image.jpg';

        $image = $request->file('image');
        if ($image){
            $name_gen = hexdec(uniqid()) .'.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);

            $data['image'] =  'upload/brand/'.$name_gen;
        }

        $data['slug_en'] = Str::slug($data['brand_name_en']);
        $data['slug_tz'] = Str::slug($data['brand_name_tz']);

        Brand::create($data);

        $notification = array(
            'message' => 'Brand created  Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('brand.index')->with($notification);

      For Update the Image 
         public function update(UpdateBrandRequest $request, Brand $brand)
    {

        if ($request->file('image')){
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) .'.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
            $save_image = 'upload/brand/'.$name_gen;

            $brand->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_tz' => $request->brand_name_tz,
                'slug_en' => strtolower(str_replace(' ', '_',$request->brand_name_en)),
                'slug_tz' => str_replace(' ', '_', $request->brand_name_tz),
                'image'         => $save_image,
            ]);
            $notification = array(
                'message' => 'Brand updated  Successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('brand.index')->with($notification);
        }else{

            $brand->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_tz' => $request->brand_name_tz,
                'slug_en' => strtolower(str_replace(' ', '_',$request->brand_name_en)),
                'slug_tz' => str_replace(' ', '_', $request->brand_name_tz),
            ]);
            $notification = array(
                'message' => 'Brand updated  Successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('brand.index')->with($notification);
        }
    }

    Better way 
             public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $data = $request->validated();

        //assign any image already exist in database to $data['image']
        $data['image'] = $brand->image;

        if ($request->file('image')){
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) .'.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);

            //DO handle delete existing image and
            //Override $data['image'] if any file is uploaded.
            $data['image'] = 'upload/brand/'.$name_gen;
        }

            $data['slug_en'] = Str::slug($data['brand_name_en']);
            $data['slug_tz'] = Str::slug($data['brand_name_tz']);
    
            $brand->update($data);
    
            $notification = array(
                'message' => 'Brand updated  Successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('brand.index')->with($notification);
        
    }
 ## Brand CRUD  part 2
     Implement the edit functionality
     Create the route in index page oof brand
     Add to the web route 
    Implemented the update function in BrandCController

 ## Brand CRUD  part 3 Delete with sweet alert alert2
      We're going to delete the image with sweetalert2
         https://sweetalert2.github.io/
      Add the sweetalert2 tpo the admin master
      Call the id to the index of the page
      Add the route name oon index page
     Add the route to the web file
     Add the funcctionality of delete 
    Use the icon instead if the text 
