<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductGallery;
use App\Http\Controllers\Controller;

class PhotoGalleryController extends Controller
{
    public function uploadGallery(Request $request)
    {
        $data = $request->all();
        $data['photos'] = $request->file('photos')->store('assets/product', 'public');
        ProductGallery::create($data);

        return redirect()->route('admin/products/edit', $request->products_id);
    }

    public function deleteGallery(Request $request, $id)
    {
        $item = ProductGallery::findOrFail($id);
        $item->delete();

        return redirect()->route('admin/products', $item->products_id);
    }

    public function edit(Request $request, $id)
    {
        $product = Product::with((['galleries', 'category', 'user']))->findOrFail($id);
        $categories = Category::all();
        return view('pages.admin.product.edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }
}
