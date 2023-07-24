<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('name')->get();
        // dd($products);
        $order = Auth::id();
        // dd($order);
        return view('product.index_product', compact('products', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create_product');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);

        $file = $request->file('image');
        $path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();


        Storage::disk('local')->put('public/products/' . $path, file_get_contents($file));
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $path,
        ]);

        return redirect()->route('create.product');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('product.show_product', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('product.edit_product', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $file = $request->file('image');

        $path = 'public/products/' . $product->image;

        if ($request->hasFile('image')) {
            if (Storage::exists($path)) {
                Storage::delete($path);
            }
        }


        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'required',

        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();
            Storage::disk('local')->put('public/products/' . $path, file_get_contents($file));
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $path,
        ]);

        return redirect()->route('edit.product', compact('product'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        Storage::delete('public/products/' . $product->path);
        return redirect()->route('index.product');
    }
}
