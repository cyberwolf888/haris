<?php

namespace App\Http\Controllers\Member;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $model = Transaction::where('member_id', Auth::user()->id)->get();
        return view('member/transaction/manage',[
            'model'=>$model
        ]);
    }

    public function show($id)
    {
        $model = Transaction::findOrFail($id);
        return view('member/transaction/detail',[
            'model'=>$model
        ]);
    }

    public function approve(Request $request)
    {
        $model = Transaction::findOrFail($request->transaction_id);
        $model->status = Transaction::FINISH;
        $model->save();
        return redirect()->back();
    }
}
