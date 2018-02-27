<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Subscribe;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Cart;
use Validator;
use Auth;
use Image;

class HomeController extends Controller
{

    //Home
    public function index()
    {
        return view('home');
    }

    //Category
    public function category($id)
    {
        $id = base64_decode($id);
        $category = Category::find($id);
        $products = Product::where('category_id',$id)->where('available',1)->get();

        return view('category',['category'=>$category,'products'=>$products]);

    }

    //Hot Sales
    public function hot_sales()
    {
        $products = Product::where('isSale',1)->where('available',1)->get();

        return view('hotsales',['products'=>$products]);
    }

    //New Item
    public function new_item()
    {
        $products = Product::where('available',1)->orderBy('created_at','desc')->limit(16)->get();

        return view('newitem',['products'=>$products]);
    }

    //Contact
    public function contact()
    {
        return view('contact');
    }

    public function contact_proses(Request $request)
    {
        return "Your message has been sent.";
    }

    //Search
    public function search(Request $request)
    {
        $products = Product::where('available',1)
            ->where('name', 'like', '%'.$request->keywords.'%')
            ->where('available',1)
            ->orderBy('id', 'desc')
            ->get();
        return view('search',[
            'products'=>$products,
            'keywords'=>$request->keywords
        ]);
    }

    //Product
    public function product_detail($id)
    {
        $model = Product::findOrFail($id);
        $detail = ProductDetail::where('product_id',$id)->where('label','Size')->first();
        $size = [];
        if(!is_null($detail)){
            $_size = explode(',', $detail->value);
            foreach ($_size as $s){
                $size[$s] = $s;
            }
        }else{
            $size = ['All Size'=>'All Size'];
        }
        return view('product_detail',['model'=>$model,'size'=>$size]);
    }

    //Cart
    public function cart_manage()
    {
        return view('cart');
    }

    public function cart_insert(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $price = $product->price;
        if($product->discount>0){
            $price = $product->price-($product->price*$product->discount/100);
        }
        Cart::instance('cart')->add($product->id, $product->name, $request->qty, $price, ['size'=>$request->size])->associate('App\Models\Product');
        return response()->json([
            'status' => '1'
        ]);
    }

    public function cart_update(Request $request)
    {
        Cart::instance('cart')->update($request->rowId, $request->qty);
    }

    public function cart_delete(Request $request)
    {
        $rowId = $request->rowId;
        Cart::instance('cart')->remove($rowId);

        return redirect()->back();
    }

    //Checkout
    public function checkout()
    {
        if(!Auth::check())
            return redirect('login');

        return view('checkout');
    }

    public function checkout_proses(Request $request)
    {
        $model = new Transaction();
        $cart = Cart::instance('cart');

        $model->id = $model->createId();
        $model->member_id = Auth::user()->id;
        $model->fullname =Auth::user()->name;
        $model->phone = Auth::user()->phone;
        $model->address = $request->address;
        $model->city = $request->city;
        $model->subtotal = $cart->total(0,'','');
        $berat = 0;
        foreach ($cart->content() as $row)
        {
            $berat+=($row->model->weight*$row->qty);
        }
        if(Auth::user()->city == "Denpasar" || Auth::user()->city == "Badung"){
            $model->shipping = 0;
        }else{
            $model->shipping = $berat*\App\Models\Setting::find(1)->value;
        }
        $model->total = $model->shipping+$model->subtotal;
        $model->status = Transaction::NEW_ORDER;
        $model->note = $request->note;
        $model->save();

        foreach ($cart->content() as $row)
        {
            $detail = new TransactionDetail();
            $detail->transaction_id = $model->id;
            $detail->product_id = $row->id;
            $detail->size = $row->options['size'];
            $detail->qty = $row->qty;
            $detail->price = $row->price;
            $detail->total = $row->qty*$row->price;
            $detail->save();
        }
        $cart->destroy();

        return redirect()->route('frontend.invoice',base64_encode($model->id));
    }

    //Invoice
    public function invoice($id)
    {
        $id = base64_decode($id);
        $transaction = Transaction::findOrFail($id);
        return view('invoice',['transaction'=>$transaction]);
    }

    public function invoice_print($id)
    {
        $id = base64_decode($id);
        $transaction = Transaction::findOrFail($id);
        return view('print',['transaction'=>$transaction]);
    }

    //Payment
    public function payment($id)
    {
        $id = base64_decode($id);
        $transaction = Transaction::findOrFail($id);

        return view('payment',['id'=>$id,'transaction'=>$transaction]);
    }

    public function payment_proses(Request $request,$id)
    {
        $id = base64_decode($id);
        $transaction = Transaction::findOrFail($id);

        $path = base_path('assets/img/payment/');
        $file = Image::make($request->file('image'))->resize(800, 600)->encode('jpg', 80)->save($path.md5(str_random(12)).'.jpg');

        $model = new Payment();
        $model->transaction_id = $id;
        $model->image = $file->basename;
        $model->status = Payment::NOT_VERIFIED;
        $model->save();

        $transaction->status = Transaction::WAITING_VERIFIED;
        $transaction->save();

        return redirect()->route('member.transaction.show',$id);
    }

    //Subscribe
    public function subscribe(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'phone' => 'required|max:255|unique:subscribe,email'
        ]);

        if ($validator->fails()) {
            return '0';
        }

        $model = new Subscribe();
        $model->email = $request->phone;
        $model->save();
        return '1';
    }
}
