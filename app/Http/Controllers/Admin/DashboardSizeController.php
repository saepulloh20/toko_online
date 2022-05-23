<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SizeRequest;
use App\Models\sizeChart;

use Yajra\DataTables\Facades\DataTables;

class DashboardSizeController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = SizeChart::with('category')->get();
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
        return view('pages.admin.size.index');
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.admin.size.create', [
            'categories' => $categories
        ]);
    }

    public function store(SizeRequest $request)
    {
        $data = $request->all();
        $size = sizeChart::create($data);

        return redirect()->route('admin-size');
    }
}
