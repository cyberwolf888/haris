<?php

namespace App\Http\Controllers\Backend;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index()
    {
        $model = Setting::orderBy('id','desc')->get();
        return view('backend.setting.manage',['model'=>$model]);
    }

    public function create()
    {
        $model = new Setting();
        return view('backend.setting.form',['model'=>$model]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => 'required|max:100',
            'value' => 'required|max:100',
        ]);

        $model = new Setting();
        $model->type = $request->type;
        $model->value = $request->value;
        $model->save();

        return redirect()->route('backend.setting.manage')->with('success','Setting added!');
    }

    public function edit($id)
    {
        $model = Setting::findOrFail($id);
        return view('backend.setting.form',['model'=>$model,'update'=>true]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'type' => 'required|max:100',
            'value' => 'required|max:100',
        ]);

        $model = Setting::findOrFail($id);
        $model->type = $request->type;
        $model->value = $request->value;
        $model->save();

        return redirect()->route('backend.setting.manage')->with('success','Setting updated!');
    }

    public function destroy($id)
    {
        $model = Setting::findOrFail($id);
        $model->delete();
        return redirect()->route('backend.setting.manage')->with('success','Setting deleted!');
    }
}
