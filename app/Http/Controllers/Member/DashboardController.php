<?php

namespace App\Http\Controllers\Member;

use App\Models\Transaction;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        $transaction = Transaction::where('member_id',Auth::user()->id)->limit(5)->orderBy('id','DESC')->get();
        return view('member/dashboard/index',[
            'transaction'=>$transaction
        ]);
    }
}
