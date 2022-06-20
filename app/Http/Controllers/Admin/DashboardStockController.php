<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\SizeChart;
use App\Models\StockProduct;
use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use App\Http\Requests\StockRequest;
use Yajra\DataTables\Facades\DataTables;

class DashboardStockController extends Controller

{
    public function index()
    {
        if (request()->ajax()) {
            $query = StockProduct::with('sizechart', 'product')->get();
            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . route('category.edit', $item->id) . '">Sunting
                                    </a>
                                    <form action="' . route('category.destroy', $item->id) . '" method="POST">' . method_field('DELETE') . csrf_field() . '
                                        <button class="dropdown-item text-danger" type="submit">Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('pages.admin.stock.index');
    }

    public function create()
    {
        $sizecharts = SizeChart::with(['category'])->get();
        $products = Product::all();
        return view('pages.admin.stock.create', [
            'sizecharts' => $sizecharts,
            'products' => $products
        ]);
    }

    public function store(StockRequest $request)
    {
        $data = $request->all();
        $stock = StockProduct::create($data);


        return redirect()->route('admin-stock');
    }
}
