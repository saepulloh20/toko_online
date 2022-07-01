<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Submission;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SubmissionRequest;

class DashboardValidateController extends Controller
{
    public function index()
    {
        $validates = Submission::with(['product', 'categories'])
            ->orderBy('created_at', 'desc')
            ->where('users_id', Auth::user()->id)
            ->get();
        $km = Submission::where('users_id', Auth::user()->id)->where('status', 1)->sum('distance');
        // $time = Submission::where('users_id', Auth::user()->id)->where('status', 1)->sum('time');
        $time = DB::table('submissions')
            ->select(DB::raw(
                "SEC_TO_TIME( SUM( TIME_TO_SEC( `time` ) ) ) AS timeSum"
            ))->where('users_id', Auth::user()->id)->where('status', 1)->first();
        $pace = Submission::where('users_id', Auth::user()->id)->where('status', 1)->avg('average_pace');




        return view('pages.dashboard-validate', [
            'validates' => $validates,
            'km' => $km,
            'time' => $time->timeSum,
            'pace' => $pace
        ]);
    }

    public function create()
    {
        $buyTransactions = TransactionDetail::with(['transaction.user'])
            ->whereHas('transaction', function ($transaction) {
                $transaction->where('users_id', Auth::user()->id);
            })->get();
        return view(
            'pages.dashboard-validate-create',
            [
                'buyTransactions' => $buyTransactions,
                'users_id' => Auth::user()->id
            ]
        );
    }

    public function store(SubmissionRequest $request)
    {
        $data = $request->all();
        $data['photos'] = $request->file('photos')->store('assets/product', 'public');
        $data['status'] = 0;
        if (strlen($data['time']) == 5) {
            $data['time'] = '00:' . $data['time'];
        }

        Submission::create($data);


        return redirect()->route('dashboard/validate');
    }
    public function details(Request $request, $id)
    {
        $validates = Submission::with((['product', 'categories', 'user']))->findOrFail($id);

        return view('pages.dashboard-validate-details', [
            'validates' => $validates,

        ]);
    }
}
