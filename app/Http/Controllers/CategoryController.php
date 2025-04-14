<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(8);
        return view('admin.category.index')->with(compact('categories'));
    }

    public function getCategories()
    {
        // Return all categories in JSON format
        $categories = Category::orderBy('id', 'DESC')->get(['id', 'category_name']); // Only fetch necessary fields
        return response()->json($categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'cat_name' => 'required',
                'cat_slug' => 'required',
                'cat_dscp' => 'required'
            ],
            [
                'cat_name.required' => 'The category name is required',
                'cat_slug.required' => 'The category slug is required',
                'cat_dscp.required' => 'The category description is required',
            ]
        );
        Category::create([
            'category_name' => $request->get('cat_name'),
            'category_slug' => $request->get('cat_slug'),
            'category_dscp' => $request->get('cat_dscp'),
            'status' => 'ACTIVE'
        ]);
        return redirect()->to('/admin/category');
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
        $category = Category::find($id);
        return view('admin.category.edit')->with(compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate(
            $request,
            [
                'cat_name' => 'required',
                'cat_slug' => 'required',
                'cat_dscp' => 'required'
            ],
            [
                'cat_name.required' => 'The category name is required',
                'cat_slug.required' => 'The category slug is required',
                'cat_dscp.required' => 'The category description is required'
            ]
        );
        $category = Category::find($id);
        $category->update([
            'category_name' => $request->get('cat_name'),
            'category_slug' => $request->get('cat_slug'),
            'category_dscp' => $request->get('cat_dscp'),
            'status' => 'ACTIVE'
        ]);
        return redirect()->to('/admin/category');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->to('/admin/category');
    }
}
