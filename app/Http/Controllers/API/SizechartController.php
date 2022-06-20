<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SizeChart;
use App\Models\StockProduct;

class SizechartController extends Controller
{
    public function product(Request $request)
    {
        return Product::with(['category'])->get();
    }

    public function size(Request $request, $categories_id)
    {
        return SizeChart::where('categories_id', $categories_id)->get();
    }
}
