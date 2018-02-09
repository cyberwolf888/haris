<?php

namespace App\Http\Controllers\Backend;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $model = Auth::user();
        return view('backend.profile.form',[
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
                ->route('backend.profile.index')
                ->withErrors($validator)
                ->withInput();
        }

        $user->name = $request->fullname;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->save();

        return redirect()->route('backend.profile.index')->with('success', 'Update profile!');
    }
}
