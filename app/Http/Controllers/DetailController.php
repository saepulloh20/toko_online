<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\sizeChart;
use Illuminate\Support\Facades\Auth;


class DetailController extends Controller
{
    //
    public function index(Request $request, $id)
    {
        $product = Product::with(['galleries', 'user'])->where('slug', $id)->firstOrFail();
        $size =  SizeChart::where('categories_id', $product->categories_id)->get();
        return view('pages.detail', [
            'size' => $size,
            'product' => $product
        ]);
    }

    public function add(Request $request, $id)
    {

        $data = [
            'products_id' => $id,
            'users_id' => Auth::user()->id,

        ];
        Cart::create($data);

        return redirect()->route('cart');
    }
}
