<?php

namespace App\Http\Controllers\Backend;

use App\Models\Payment;
use App\Models\Product;
use App\Models\Sms;
use App\Models\Transaction;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function index()
    {
        $model = Transaction::orderBy('created_at','desc')->get();
        return view('backend.transaction.manage',[
            'model'=>$model
        ]);
    }

    public function show($id)
    {
        $model = Transaction::findOrFail($id);
        return view('backend.transaction.detail',[
            'model'=>$model
        ]);
    }

    public function approve(Request $request)
    {
        $model = Transaction::findOrFail($request->transaction_id);
        $member = User::find($model->member_id);
        $payment = Payment::find($request->payment_id);

        $model->status = Transaction::VERIFIED;
        $model->save();

        $payment->status = 1;
        $payment->save();

        Sms::send($member->phone, 'Psanan anda #'.$model->id.' berhasil diverifikasi.');
        return redirect()->back();
    }

    public function decline(Request $request)
    {
        $model = Transaction::findOrFail($request->transaction_id);
        $member = User::find($model->member_id);
        $payment = Payment::find($request->payment_id);

        /*if(is_file($path = base_path('../assets/img/payment/'.$payment->image))){
            unlink(base_path('../assets/img/payment/'.$payment->image));
        }*/
        $payment->status = 2;
        $payment->save();

        $model->status = Transaction::NEW_ORDER;
        $model->save();

        Sms::send($member->phone, 'Pembayaran untuk Psanan #'.$model->id.' ditolak, harap verifikasi kembali.');
        return redirect()->back();
    }

    public function shipped(Request $request)
    {
        $model = Transaction::findOrFail($request->transaction_id);
        $member = User::find($model->member_id);

        $model->status = Transaction::SHIPPED;
        $model->resi = $request->resi;
        $model->save();

        Sms::send($member->phone, 'Psanan anda #'.$model->id.' sedang dikirim.');
        return redirect()->back();
    }

    public function finish(Request $request)
    {
        $model = Transaction::findOrFail($request->transaction_id);
        $member = User::find($model->member_id);

        $model->status = Transaction::FINISH;
        $model->save();

        Sms::send($member->phone, 'Psanan anda #'.$model->id.' sudah diterima.');
        return redirect()->back();
    }

    public function cancel(Request $request)
    {
        $model = Transaction::findOrFail($request->transaction_id);
        $member = User::find($model->member_id);

        $model->status = Transaction::CANCEL;
        $model->save();

        foreach($model->transaction_detail as $detail)
        {
            $product = Product::find($detail->product_id);
            $product->stock = $product->stock + $detail->qty;
            $product->save();
        }

        Sms::send($member->phone, 'Psanan anda #'.$model->id.' telah dibatalkan.');
        return redirect()->back();
    }
}
