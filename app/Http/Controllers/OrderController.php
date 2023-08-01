<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return view('order.index_order', compact('orders'));
    }


    // public function show_order(Order $order)
    // {
    //     // $id = Auth::id();
    //     // $oderUser = Order::where('user_id', $id)->get();
    //     $orders = Order::where('user_id', '=', Auth::id())->get();
    //     // dd(Auth::id());
    //     // dd($orders);
    //     return view('order.show_order', compact('orders', 'order'));
    // }

    public function show_order(Order $order)
    {
        return view('order.show_order', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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

    public function checkout()
    {
        $user_id = Auth::id();
        $carts = Cart::where('user_id', $user_id)->get();

        if ($carts == null) {
            return redirect()->back();
        }

        $order = Order::create([
            'user_id' => $user_id,
        ]);

        foreach ($carts as $cart) {
            $product = Product::find($cart->product_id);
            $product->update([
                'stock' => $product->stock - $cart->amount,
            ]);
            Transaction::create([
                'amount' => $cart->amount,
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
            ]);
            $cart->delete();
        }

        return redirect()->back()->with('toast_success', 'Checkout Successfully!');
    }

    public function submit_payment_receipt(Order $order, Request $request)
    {
        // $request->validate([
        //     'payment_receipt' => 'max:'
        // ]);
        $file = $request->file('payment_receipt');
        // $path = time() . '_' . $order->id . '.' . $file->getClientOriginalExtension();
        $path = time() . '_' . $order->id . '.' . $file->getClientOriginalExtension();
        // dd($file->getClientOriginalExtension());
        Storage::disk('local')->put('public/payment_receipts/' . $path, file_get_contents($file));
        $order->update([
            'payment_receipt' => $path,
        ]);

        return redirect()->back();
    }

    public function confirm_payment(Order $order)
    {
        $order->update([
            'is_paid' => true
        ]);
        return redirect()->back();
    }
}
