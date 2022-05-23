<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
    public function index()
    {
        $carts = Cart::with(['product.galleries', 'user', 'size_chart'])
            ->where('users_id', Auth::user()->id)->get();
        $user = Auth::user();

        return view('pages.cart', [
            'user' => $user,
            'carts' => $carts
        ]);
    }

    public function delete(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->route('cart');
    }
    public function success()
    {
        return view('pages.success');
    }
}
