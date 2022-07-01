<?php

namespace App\Http\Controllers\Admin;


use App\Models\Submission;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubmissionRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\SubmissionEditRequest;

class DashboardValidationController extends Controller

{
    public function index()
    {
        if (request()->ajax()) {
            $query = Submission::with(['product', 'categories', 'user']);

            return Datatables::of($query)
                ->addColumn('date', function ($item) {
                    return date_format($item->created_at, 'Y-m-d');
                })
                ->addColumn('status', function ($item) {
                    return $item->status == 1 ? 'Verify' : 'In Review';
                })
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . route('validation.edit', $item->id) . '">Sunting
                                    </a>
                                    <form action="' . route('validation.destroy', $item->id) . '" method="POST">' . method_field('DELETE') . csrf_field() . '
                                        <button class="dropdown-item text-danger" type="submit">Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns(['action', 'photo'])
                ->make();
        }
        return view('pages.admin.validation.index');
    }
    public function edit($id)
    {
        $item = Submission::findOrFail($id);
        return view('pages.admin.validation.edit', [
            'item' => $item
        ]);
    }
    public function update(SubmissionEditRequest $request, $id)
    {
        $data = $request->all();
        $item = Submission::findOrFail($id);
        $item->update($data);

        return redirect()->route('validation.index')->with('success', 'Validation berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $item = Submission::findOrFail($id);
        $item->delete();

        return redirect()->route('validation.index')->with('success', 'Validation berhasil dihapus');
    }
}
