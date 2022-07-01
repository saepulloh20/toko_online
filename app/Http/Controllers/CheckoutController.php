<?php

namespace App\Http\Controllers;

use Exception;
use Midtrans\Snap;

use App\Models\Cart;
use Midtrans\Config;
use Midtrans\Notification;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // Save user data
        $user = Auth::user();
        $user->update($request->except('total_price'));

        // Process checkout
        $code = 'STORE-' . mt_rand(000000, 999999);
        $carts = Cart::with(['product', 'user'])->where('users_id', Auth::user()->id)->get();

        // Transaction create
        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'insurance_price' => 0,
            'shipping_price' => 0,
            'total_price' => (int) $request->total_price,
            'transaction_status' => 'PENDING',
            'code' => $code,
        ]);

        foreach ($carts as $cart) {
            $trx = 'BIB-' . mt_rand(0000, 10000);
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'products_id' => $cart->product->id,
                'price' => $cart->product->price,
                'shipping_status' => 'PENDING',
                'resi' => '',
                'code' => $trx,
            ]);
        }

        // Delete Cart data
        cart::where('users_id', Auth::user()->id)
            ->delete();

        // Masuk ke configurasi Midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Buat array untuk dikirim ke Midtrans
        $midtrans = [
            'transaction_details' => [
                'order_id' => $code,
                'gross_amount' => (int) $request->total_price,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone_number,
                '75916882266' => Auth::user()->address_one
            ],
            'enabled_payments' => [
                'gopay', 'bca_va', 'bank_transfer'
            ],
            'vtweb' => [],
        ];

        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            // Redirect to Snap Payment Page
            return $paymentUrl;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function callback(Request $request)
    {
        // Set Midtrans Configuration
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Intance Notification Midtrans
        $notification = new Notification();

        // Asign ke variable untuk melakukan coding
        $transaction_status = $notification->transaction_status;
        $fraud = $notification->fraud_status;
        $order_id   = $notification->order_id;

        // Cari transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($order_id);

        // Handle Notifikation Status
        if ($transaction_status == 'capture') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'challenge'
                $transaction->$transaction_status = 'PENDING';
            } else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'success'
                $transaction->$transaction_status = 'SUCCESS';
            }
        } else if ($transaction_status == 'cancel') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'failure'
                $transaction->$transaction_status = 'FAILED';
            } else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'failure'
            }
        } else if ($transaction_status == 'deny') {
            // TODO Set payment status in merchant's database to 'failure'
            $transaction->$transaction_status = 'FAILED';
        } else if ($transaction_status == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $transaction->$transaction_status = 'SUCCESS';
        } else if ($transaction_status == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            $transaction->$transaction_status = 'PENDING';
        } else if ($transaction_status == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $transaction->$transaction_status = 'FAILED';
        }
        $transaction->save();
        return view('pages.success');
    }
}
