<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $sellTransactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
            ->whereHas('product', function ($product) {
                $product->where('users_id', Auth::user()->id);
            })->get();

        return view('pages.admin.transaction.dashboard-transaction', [
            'sellTransactions' => $sellTransactions
        ]);
    }

    public function details(Request $request, $id)
    {
        $transaction = TransactionDetail::with(['transaction.user', 'product.galleries'])->findOrFail($id);

        return view('pages.admin.transaction.dashboard-transaction-details', [
            'transaction' => $transaction
        ]);
    }
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $item = TransactionDetail::findOrFail($id);
        $item->update($data);

        return redirect()->route('transactions-details', $id);
    }
}
