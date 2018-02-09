<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $model = Category::all();
        return view('backend.category.manage',[
            'model'=>$model
        ]);
    }

    public function create()
    {
        $model = new Category();
        return view('backend.category.form',[
            'model'=>$model
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:category|max:255',
            'description' => 'required|max:255'
        ]);
        $model = new Category();
        $model->name = $request->name;
        $model->description = $request->description;
        $model->save();

        return redirect()->route('backend.category.manage')->with('success', 'Add new category!');
    }

    public function show($id)
    {
        $model = Category::findOrFail($id);
        return view('backend.category.detail',[
            'model'=>$model
        ]);
    }

    public function edit($id)
    {
        $model = Category::findOrFail($id);
        return view('backend.category.form',[
            'model'=>$model,
            'update'=>true
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:255'
        ]);
        $model = Category::findOrFail($id);
        $model->name = $request->name;
        $model->description = $request->description;
        $model->save();

        return redirect()->route('backend.category.manage')->with('success', 'Edit category!');
    }
}
