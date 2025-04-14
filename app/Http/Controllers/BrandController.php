<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $categories = Category::all();
        $brands = Brand::orderBy('id', 'DESC')->paginate(8);
        return view('admin.brand.index')->with(compact('brands'));
    }

    public function getBrands(){
        $brands = Brand::orderBy('id', 'DESC')->get(['id', 'brand_name','brand_logo']); // Only fetch necessary fields
        return response()->json($brands);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.brand.create')->with(compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'brand_name' => 'required|unique:brands,brand_name',
                'brand_slug' => 'required|unique:brands,brand_slug',
                'brand_logo' => 'required',
                'category_ids' => 'required|array|min:1',
                'category_ids.*' => 'exists:categories,id',
            ],
            [
                'brand_name.required' => 'The Brand Name is required',
                'brand_slug.required' => 'The Brand Slug is required',
                'brand_logo.required' => 'The Brand Logo is required'
            ]
        );


        $file = $request->file('brand_logo');
        $filename = md5($file->getClientOriginalName()) . time() . '.' . $file->getClientOriginalExtension();
        $file->move('./uploads', $filename);

        $brand = Brand::firstOrCreate([
            'brand_name' => $request->brand_name,
            'brand_slug' => $request->brand_slug,
        ], [
            'brand_logo' => $filename,
            'status' => 'ACTIVE'
        ]);

        $brand->categories()->sync($request->category_ids);

        return redirect()->to('/admin/brand')->with('success', 'Brand created and categories assigned successfully!');
    }



    


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $brand = Brand::with('categories')->find($id);
        return view('admin.brand.edit')->with(compact('brand', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $brand = Brand::find($id);

        $this->validate(
            $request,
            [
                'brand_name' => 'required|unique:brands,brand_name,' . $brand->id,
                'brand_slug' => 'required|unique:brands,brand_slug,' . $brand->id,
                'category_ids' => 'required|array|min:1',
                'category_ids.*' => 'exists:categories,id',
            ],
            [
                'brand_name.required' => 'The Brand Name is required',
                'brand_slug.required' => 'The Brand Slug is required',
            ]
        );



        if ($request->hasFile('brand_logo')) {

            if (file_exists('uploads/' . $brand->brand_logo)) {
                unlink('uploads/' . $brand->brand_logo);
            }

            $file = $request->file('brand_logo');
            $filename = md5($file->getClientOriginalName()) . time() . '.' . $file->getClientOriginalExtension();
            $file->move('./uploads', $filename);
        } else {
            $filename = $brand->brand_logo;
        }

        $brand->update([
            'brand_name' => $request->get('brand_name'),
            'brand_slug' => $request->get('brand_slug'),
            'brand_logo' => $filename,
            'status' => 'ACTIVE'
        ]);

        $brand->categories()->sync($request->category_ids);


        return redirect()->to('/admin/brand')->with('success', 'Brand updated and categories assigned successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);
        $brand->categories()->detach();
        if ($brand->brand_logo && file_exists('uploads/' . $brand->brand_logo)) {
            unlink('uploads/' . $brand->brand_logo);
        }
        $brand->delete();
        return redirect()->to('/admin/brand')->with('success', 'Brand and associated categories deleted successfully!');
    }
}
