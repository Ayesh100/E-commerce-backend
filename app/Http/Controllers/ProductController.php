<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(8);
        $brands = Brand::all();
        return view('admin.product.index')->with(compact('products', 'brands'));
    }

    public function getProducts()
    {
        return response()->json([
            'products' => Product::latest()->get()->map(function ($product) {
                return [
                    'id' => $product->id,
                    'product_name' => $product->product_name,
                    'product_price' => $product->product_price,
                    'product_img' => $product->product_img ? asset('uploads/' . $product->product_img) : null,
                ];
            }),
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.product.create')->with(compact('brands', 'categories'));
    }


    public function getBrandsByCategory($categoryId)
    {
        $brands = Brand::whereHas('categories', function ($query) use ($categoryId) {
            $query->where('categories.id', $categoryId);
        })->get();

        return response()->json(['brands' => $brands]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required|exists:categories,id|not_in:none',
            'brand_id' => 'required|exists:brands,id|not_in:none',
            'product_name' => 'required|unique:products,product_name',
            'product_slug' => 'required|unique:products,product_slug',
            'product_dscp' => 'required',
            'product_price' => 'required|integer|min:0',
            'product_qty' => 'required|integer|min:0',
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $brandCategoryExists = DB::table('brand_category')
            ->where('brand_id', $request->brand_id)
            ->where('category_id', $request->category_id)
            ->exists();

        if (!$brandCategoryExists) {
            return back()->withErrors(['category_id' => 'The selected brand and category combination is invalid.'])
                ->withInput();
        }

        $file = $request->file('product_img');
        $filename = md5($file->getClientOriginalName()) . time() . '.' . $file->getClientOriginalExtension();
        $file->move('./uploads', $filename);

        Product::create([
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'product_name' => $request->product_name,
            'product_slug' => $request->product_slug,
            'product_dscp' => $request->product_dscp,
            'product_price' => $request->product_price,
            'product_qty' => $request->product_qty,
            'product_img' => $filename,
            'status' => 'ACTIVE'
        ]);

        return redirect()->to('/admin/product')->with('success', 'Product created successfully!');
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
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::whereHas('categories', function ($query) use ($product) {
            $query->where('categories.id', $product->category_id);
        })->get();

        return view('admin.product.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $this->validate($request, [
            'category_id' => 'required|exists:categories,id|not_in:none',
            'brand_id' => 'required|exists:brands,id|not_in:none',
            'product_name' => 'required|unique:products,product_name,' . $product->id,
            'product_slug' => 'required|unique:products,product_slug,' . $product->id,
            'product_dscp' => 'required',
            'product_price' => 'required|min:0',
            'product_qty' => 'required|min:0',
            'product_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $brandCategoryExists = DB::table('brand_category')
            ->where('brand_id', $request->brand_id)
            ->where('category_id', $request->category_id)
            ->exists();

        if (!$brandCategoryExists) {
            return back()->withErrors(['category_id' => 'The selected brand and category combination is invalid.'])
                ->withInput();
        }

        // Handle image upload if a new image is provided
        if ($request->hasFile('product_img')) {
            if (file_exists(public_path('uploads/' . $product->product_img))) {
                unlink(public_path('uploads/' . $product->product_img));
            }

            $file = $request->file('product_img');
            $filename = md5($file->getClientOriginalName()) . time() . '.' . $file->getClientOriginalExtension();
            $file->move('./uploads', $filename);
        } else {
            $filename = $product->product_img;
        }

        $product->update([
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'product_name' => $request->product_name,
            'product_slug' => $request->product_slug,
            'product_dscp' => $request->product_dscp,
            'product_price' => $request->product_price,
            'product_qty' => $request->product_qty,
            'product_img' => $filename,
            'status' => 'ACTIVE'
        ]);

        return redirect()->to('/admin/product')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        if (file_exists(public_path('uploads/' . $product->product_img))) {
            unlink(public_path('uploads/' . $product->product_img));
        }

        $product->delete();

        return redirect()->to('/admin/product')->with('success', 'Product deleted successfully!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return response()->json([]);
        }

        // Search products by name (modify as needed)
        $products = Product::where('product_name', 'LIKE', "%{$query}%")->limit(5)->get();

        return response()->json($products);
    }

    public function getProductById($id) {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }
    
}
