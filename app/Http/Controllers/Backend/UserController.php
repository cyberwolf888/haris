<?php

namespace App\Http\Controllers\Backend;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class UserController extends Controller
{
    /*
     * Admin
     */
    public function admin()
    {
        $model = User::where('type',User::ADMIN)->get();

        return view('backend.user.admin',[
            'model'=>$model
        ]);

    }

    public function create_admin()
    {
        $model = new User();
        return view('backend.user.form_admin',[
            'model'=>$model
        ]);
    }

    public function store_admin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('backend.admin.user.create')
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User();
        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->password = bcrypt($request['password']);
        $user->isActive = $request->status == 'on' ? 1 : 0;
        $user->type = User::ADMIN;
        $user->save();

        return redirect()->route('backend.user.admin.manage')->with('success', 'Add new admin!');
    }

    public function edit_admin($id)
    {
        $model = User::findOrFail($id);

        return view('backend.user.form_admin',[
            'model'=>$model,
            'update'=>true
        ]);
    }

    public function update_admin(Request $request, $id)
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
                ->route('backend.user.admin.update')
                ->withErrors($validator)
                ->withInput();
        }
        $user->name = $request->fullname;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->isActive = $request->status == 'on' ? 1 : 0;
        $user->save();

        return redirect()->route('backend.user.admin.manage')->with('success', 'Update admin!');
    }

    /*
     * Owber
     */
    public function owner()
    {
        $model = User::where('type',User::OWNER)->get();

        return view('backend.user.owner',[
            'model'=>$model
        ]);

    }

    public function create_owner()
    {
        $model = new User();
        return view('backend.user.form_owner',[
            'model'=>$model
        ]);
    }

    public function store_owner(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('backend.admin.owner.create')
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User();
        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->password = bcrypt($request['password']);
        $user->isActive = $request->status == 'on' ? 1 : 0;
        $user->type = User::OWNER;
        $user->save();

        return redirect()->route('backend.user.owner.manage')->with('success', 'Add new owner!');
    }

    public function edit_owner($id)
    {
        $model = User::findOrFail($id);

        return view('backend.user.form_owner',[
            'model'=>$model,
            'update'=>true
        ]);
    }

    public function update_owner(Request $request, $id)
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
                ->route('backend.user.owner.update')
                ->withErrors($validator)
                ->withInput();
        }
        $user->name = $request->fullname;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->isActive = $request->status == 'on' ? 1 : 0;
        $user->save();

        return redirect()->route('backend.user.owner.manage')->with('success', 'Update owner!');
    }

    /*
     * Member
     */
    public function member()
    {
        $model = User::where('type',User::MEMBER)->get();

        return view('backend.user.member',[
            'model'=>$model
        ]);

    }

    public function create_member()
    {
        $model = new User();
        return view('backend.user.form_member',[
            'model'=>$model
        ]);
    }

    public function store_member(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('backend.admin.member.create')
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User();
        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->password = bcrypt($request['password']);
        $user->isActive = $request->status == 'on' ? 1 : 0;
        $user->type = User::MEMBER;
        $user->save();

        return redirect()->route('backend.user.member.manage')->with('success', 'Add new member!');
    }

    public function edit_member($id)
    {
        $model = User::findOrFail($id);

        return view('backend.user.form_member',[
            'model'=>$model,
            'update'=>true
        ]);
    }

    public function update_member(Request $request, $id)
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
                ->route('backend.user.member.update')
                ->withErrors($validator)
                ->withInput();
        }
        $user->name = $request->fullname;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->isActive = $request->status == 'on' ? 1 : 0;
        $user->save();

        return redirect()->route('backend.user.member.manage')->with('success', 'Update member!');
    }
}
