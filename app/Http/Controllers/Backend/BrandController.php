<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
