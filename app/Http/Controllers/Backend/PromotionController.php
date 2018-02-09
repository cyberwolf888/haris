<?php

namespace App\Http\Controllers\Backend;

use App\Models\Member;
use App\Models\Sms;
use App\Models\Subscribe;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PromotionController extends Controller
{
    public function index()
    {
        $subscriber = Subscribe::all();
        return view('backend.promotion.manage', [
            'subscriber'=>$subscriber
        ]);
    }

    public function process(Request $request)
    {
        if($request->status == 0){
            $member = User::where('type',User::MEMBER)->get();
            $subscribe = Subscribe::all();
            foreach ($member as $m){
                Sms::send($m->phone, $request->promotions);
            }
            foreach ($subscribe as $s){
                Sms::send($s->phone, $request->promotions);
            }
        }elseif ($request->status == 1){
            $member = Member::all();
            foreach ($member as $m){
                Sms::send($m->phone, $request->promotions);
            }
        }elseif ($request->status == 2){
            $subscribe = Subscribe::all();
            foreach ($subscribe as $s){
                Sms::send($s->phone, $request->promotions);
            }
        }

        return redirect()->back()->with('success','All promotion has been sent.');
    }

    public function delete($id)
    {
        $model = Subscribe::findOrFail($id);
        $model->delete();
        return redirect()->back();
    }
}
