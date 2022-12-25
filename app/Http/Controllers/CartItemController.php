<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartItemRequest;
use App\Http\Requests\UpdateCartItemRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCartItemRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCartItemRequest $request, Product $product)
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->first();
        $cart_item = CartItem::where('product_id', $product->id)->first();
        if ($cart_item) {
            $cart_item->quantity += 1;
            $cart_item->save();
        } else {
            CartItem::create([
                'product_id' => $product->id,
                'cart_id' => $cart->id,
                'quantity' => 1
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function show(CartItem $cartItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function edit(CartItem $cartItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCartItemRequest  $request
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCartItemRequest $request, CartItem $cartItem)
    {
        $cartItem->quantity = $cartItem->quantity + $request->number;
        $cartItem->save();

        $price = number_format($cartItem->quantity*$cartItem->product->price, 2, '.', '');

        return response()->json([
            'success' => true,
            'price' => $price
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
