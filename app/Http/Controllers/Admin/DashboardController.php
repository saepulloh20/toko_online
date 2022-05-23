<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Product;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $costumer = User::count();
        $revenue = Transaction::where('transaction_status', 'SUCCESS')->sum('total_price');
        $transaction = Transaction::count();

        $transactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
            ->whereHas('product', function ($product) {
                $product->where('users_id', Auth::user()->id);
            });
        return view('pages.admin.dashboard', [
            'costumer' => $costumer,
            'revenue' => $revenue,
            'transaction' => $transaction,
            'transaction_data' => $transactions->get(),
        ]);
    }

    public function details(Request $request, $id)
    {
        $product = Product::with((['galleries', 'category', 'user']))->findOrFail($id);
        $categories = Category::all();

        return view(
            'pages.admin.product.transaction-detail',
        );
    }
}
