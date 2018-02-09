<?php

namespace App\Http\Controllers\Backend;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index()
    {
        return view('backend.report.form');
    }

    public function transaction(Request $request)
    {
        $this->validate($request, [
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required|numeric'
        ]);
        $start_date = date('Y/m/d', strtotime($request->start_date));
        $end_date = date('Y/m/d', strtotime($request->end_date));
        $transaction = Transaction::whereRaw('created_at >= "'.$start_date.'"')->whereRaw('created_at <= "'.$end_date.'"');
        if($request->status != '6'){
            $transaction->where('status', $request->status);
        }

        $total = $transaction->sum('total');
        $model = $transaction->get();
        $count = $transaction->count();
        return view('backend.report.result',[
            'model'=>$model,
            'start_date'=>$start_date,
            'end_date'=>$end_date,
            'total'=>$total
        ]);
    }
}
