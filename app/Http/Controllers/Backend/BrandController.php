<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::latest()->get();
        return view('backend.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.brands.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {

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


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //dd($brand);
        return view('backend.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $image = $brand->image;
        unlink($image);
        $brand->delete();
        $notification = array(
            'message' => 'Brand deleted  Successfully',
            'alert-type' => 'danger'
        );
        return redirect()->route('brand.index')->with($notification);


    }
}
