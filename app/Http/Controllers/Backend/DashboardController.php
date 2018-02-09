<?php

namespace App\Http\Controllers\Backend;

use App\Models\Member;
use App\Models\Transaction;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index()
    {
        $start_date = date("Y-m-d");
        $end_date = date("Y-m-d", strtotime('-1 week', strtotime($start_date)));
        $sales = Transaction::where('created_at','>=',$end_date)->sum('total');
        //dd($sales);
        $count_transaction = Transaction::where('created_at','>=',$end_date)->count('id');
        $member = User::where('type',3)->where('created_at','>=',date("Y-m-d", strtotime('-4 week', strtotime($start_date))))->count('id');
        $transaction = Transaction::limit(5)->orderBy('id','DESC')->get();


        $bulan = [1=>'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Aug','Spt','Oct','Nov','Dec'];
        $labels='[]';
        $series='[]';
        $transaksi = \DB::select('select sum(t.total) as total_transaksi, MONTH(t.created_at) AS bulan from transaction AS t group by MONTH(t.created_at)');
        if (count($transaksi)>0){
            $series = '[';
            $labels ='[';
            foreach ($transaksi as $row){
                $series.=$row->total_transaksi.',';
                $labels.="'".$bulan[$row->bulan]."',";
            }
            $series = substr($series, 0, -1).']';
            $labels = substr($labels, 0, -1).']';
        }



        return view('backend.dashboard.index',[
            'sales'=>$sales,
            'member'=>$member,
            'count_transaction'=>$count_transaction,
            'transaction'=>$transaction,
            'series'=>$series,
            'labels'=>$labels
        ]);
    }

}
