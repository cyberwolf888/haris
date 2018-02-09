<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductImages;
use Illuminate\Http\Request;

use Image;
use File;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $model = Product::all();
        return view('backend.product.manage',[
           'model'=>$model
        ]);
    }

    public function create()
    {
        $model = new Product();
        return view('backend.product.form',[
            'model'=>$model
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:category|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'weight' => 'required|numeric',
            'discount' => 'required|numeric',
            'available' => 'required',
        ]);

        $model = new Product();
        $model->category_id = $request->category_id;
        $model->name = $request->name;
        $model->price = $request->price;
        $model->weight = $request->weight;
        $model->description = $request->description;
        $model->discount = $request->discount;
        $model->isSale = $request->isSale;
        $model->available = $request->available;
        $model->save();

        $count = count($request->label);
        for ($i=0; $i<$count; $i++){
            $detail = new ProductDetail();
            $detail->product_id = $model->id;
            $detail->label = $request->label[$i];
            $detail->value = $request->value[$i];
            $detail->save();
        }
        return redirect()->route('backend.product.gallery.manage',$model->id)->with('success', 'Add new product!');
    }

    public function show($id)
    {
        $model = Product::findOrFail($id);

        return view('backend.product.detail',[
            'model'=>$model
        ]);
    }

    public function edit($id)
    {
        $model = Product::with('product_detail')->find($id);
        return view('backend.product.form',[
            'model'=>$model,
            'update'=>true
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:category|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'weight' => 'required|numeric',
            'discount' => 'required|numeric',
            'available' => 'required',
        ]);
        $model = Product::findOrfail($id);
        $model->category_id = $request->category_id;
        $model->name = $request->name;
        $model->price = $request->price;
        $model->weight = $request->weight;
        $model->description = $request->description;
        $model->discount = $request->discount;
        $model->isSale = $request->isSale;
        $model->available = $request->available;
        $model->save();

        ProductDetail::where('product_id', $model->id)->delete();
        $count = count($request->label);
        for ($i=0; $i<$count; $i++){
            $detail = new ProductDetail();
            $detail->product_id = $model->id;
            $detail->label = $request->label[$i];
            $detail->value = $request->value[$i];
            $detail->save();
        }
        return redirect()->route('backend.product.manage')->with('success', 'Update product!');
    }

    public function manage_gallery($id)
    {
        $model = ProductImages::where('product_id',$id)->get();
        return view('backend.product.manage_gallery',[
            'id' => $id,
            'model'=>$model
        ]);

    }

    public function create_gallery($id)
    {
        $model = new ProductImages();

        return view('backend.product.form_images',[
            'id'=>$id,
            'model'=>$model
        ]);
    }

    public function store_gallery(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'required|image'
        ]);
        $model = new ProductImages();
        $path = base_path('../assets/img/product/'.$id.'/');
        if(!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        $file = Image::make($request->file('image'))->resize(800, 600)->encode('jpg', 80)->save($path.md5(str_random(12)).'.jpg');
        Image::make($request->file('image'))->resize(270, 311)->encode('jpg', 80)->save($path.'thumb_'.$file->basename);
        $model->product_id = $id;
        $model->image = $file->basename;
        $model->save();
        return redirect()->route('backend.product.gallery.manage',$id)->with('success', 'New Image!');
    }

    public function destroy_gallery($id)
    {
        $model = ProductImages::findOrFail($id);
        $product_id = $model->product_id;
        $path = base_path('../assets/img/product/'.$product_id.'/');
        if(is_file($path.$model->image)){
            unlink($path.$model->image);
            unlink($path.'thumb_'.$model->image);
        }
        $model->delete();
        return redirect()->route('backend.product.gallery.manage',$product_id);
    }
}
