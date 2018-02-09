<?php

namespace App\Http\Controllers\Member;

use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $model = Auth::user();
        return view('member.profile.form',[
            'model'=>$model
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $filter = [
            'fullname' => 'required|max:255',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required'
        ];

        if($request->email === $user->email){
            $filter['email'] = 'required|string|email|max:255';
        }else{
            $filter['email'] = 'required|string|email|max:255|unique:users';
        }

        if($request->password != null){
            $filter['password'] = 'required|string|min:6|confirmed';
            $user->password = bcrypt($request->password);
        }

        $validator = Validator::make($request->all(),$filter);

        if ($validator->fails()) {
            return redirect()
                ->route('member.profile.index')
                ->withErrors($validator)
                ->withInput();
        }

        $user->name = $request->fullname;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->save();

        return redirect()->route('member.profile.index')->with('success', 'Update profile!');
    }
}
