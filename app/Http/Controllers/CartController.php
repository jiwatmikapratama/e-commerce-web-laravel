<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function add_to_cart(Request $request, Product $product)
    {
        $user_id = Auth::id();
        $product_id = $product->id;
        $existing_cart = Cart::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();
        $request->validate([
            'amount' => 'required|gte:1|lte:' . $product->stock,
        ]);

        // dd($existing_cart);
        if ($existing_cart == null) {
            $request->validate([
                'amount' => 'required|gte:1|lte:' . $product->stock,
            ]);
            Cart::create([
                'amount' => $request->amount,
                'user_id' => $user_id,
                'product_id' => $product_id,
            ]);
        } else {
            $request->validate([
                'amount' => 'required|gte:1|lte:' . ($product->stock - $existing_cart->amount),
            ]);
            $existing_cart->update([
                'amount' => $request->amount + $existing_cart->amount
            ]);
        }
        return redirect()->route('index.product');
    }

    public function show_cart()
    {
        $user_id = Auth::id();

        $carts = Cart::where('user_id', $user_id)->get();
        // dd($carts);
        $title = 'Delete Product From Cart!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('cart.show_cart', compact('carts'));
    }

    public function update_cart(Cart $cart, Request $request)
    {
        $request->validate([
            'amount' => 'required|gte:1|lte:' . $cart->product->stock,
        ]);

        $cart->update([
            'amount' => $request->amount,
        ]);
        return redirect()->back()->with('toast_success', 'Cart Updated Successfully!');
    }

    public function destroy_cart(Cart $cart)
    {
        $cart->delete();
        return redirect()->back()->with('toast_success', 'Product Deleted From Cart!');
    }
}
