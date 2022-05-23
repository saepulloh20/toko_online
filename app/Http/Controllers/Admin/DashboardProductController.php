<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductGallery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\ProductRequest;

class DashboardProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['galleries', 'category'])
            ->where('users_id', Auth::user()->id)
            ->get();

        return view('pages.admin.product.index', [
            'products' => $products,
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.admin.product.dashboard-product-create', [
            'categories' => $categories,
        ]);
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $product = Product::create($data);

        $gallery = [
            'products_id' => $product->id,
            'photos' => $request->file('photo')->store('assets/product', 'public'),
        ];

        ProductGallery::create($gallery);
        return redirect()->route('admin-products');
    }
    public function details(Request $request, $id)
    {
        $product = Product::with((['galleries', 'category', 'user']))->findOrFail($id);
        $categories = Category::all();

        return view('pages.admin.product.dashboard-product-details', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $item = Product::findOrFail($id);
        $data['slug'] = Str::slug($request->name);

        $item->update($data);

        return redirect()->route('admin-products');
    }

    public function uploadGallery(Request $request)
    {
        $data = $request->all();
        $data['photos'] = $request->file('photos')->store('assets/product', 'public');
        ProductGallery::create($data);

        return redirect()->route('admin/products-details', $request->products_id);
    }

    public function deleteGallery(Request $request, $id)
    {
        $item = ProductGallery::findOrFail($id);
        $item->delete();

        return redirect()->route('admin/products-details', $item->products_id);
    }

    public function destroy($id)
    {
        $item = Product::findOrFail($id);
        $item->delete();

        return redirect()->route('admin-products');
    }
}
