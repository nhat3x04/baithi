<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\BillDetail;
use App\Models\TypeProduct;
use App\Models\User;
use App\Models\Favorite;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
class PageController extends Controller
{
    public function index(){
        $new_products=Product::where('new',1)->get();
        return view('banhang.index-show',compact('new_products'));
    }
    public function indexvtmb(){
        $new_products=Product::where('danhmuc','vitamin B')->get();
        return view('banhang.index-show',compact('new_products'));
    }public function indexvtmc(){
        $new_products=Product::where('danhmuc','vitamin C')->get();
        return view('banhang.index-show',compact('new_products'));
    }

    public function getChiTietsp($id){
        $product =Product::where('id',$id)->get();
        return view('banhang.product', compact('product'));
    }
    public function show($id)
    {
        $detail=Product::find($id);
        return view('banhang.detail',compact('detail'));
    }

    public function addToCart(Request $request,$id){
        $product=Product::find($id);
        $oldCart=Session('cart')?Session::get('cart'):null;
        $cart=new Cart($oldCart);
        $cart->add($product,$id);
        $request->session()->put('cart',$cart);
        return redirect()->back();
     }
     public function removeFromCart($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->back();
    }

    public function addToFavorites(Request $request, $productId)
{
    $user = Auth::user();

    if ($user) {
        $user->addToFavorites($productId);
        return redirect()->back()->with('success', 'Product added to favorites.');
    }

    return redirect()->back()->with('error', 'Unable to add product to favorites.');
}

public function removeFromFavorites(Request $request, $productId)
{
    $user = Auth::user();

    if ($user) {
        $user->removeFromFavorites($productId);
        return redirect()->back()->with('success', 'Product removed from favorites.');
    }

    return redirect()->back()->with('error', 'Unable to remove product from favorites.');
}

    public function favorites()
    {
        $user = Auth::user();

        if ($user) {
            $favoriteProductIds = $user->favorites ?? [];
            $favorites = Product::whereIn('id', $favoriteProductIds)->get();
            return view('banhang.favorites', compact('favorites'));
        }

        return redirect()->route('login');
    }



    public function getCheckout() {
        if (!Session::has('cart')) {
            return view('cart.checkout')->with('products', null);
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $products = $cart->items;
        $totalPrice = $cart->totalPrice;

        return view('cart.checkout', compact('products', 'totalPrice'));
    }
    public function postCheckout(Request $request) {
        if (!Session::has('cart')) {
            return redirect()->back()->with('error', 'Cart is empty');
        }
    
        $cart = Session::get('cart');
    
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'gender' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'note' => 'nullable|string',
            'payment_method' => 'required|string'
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Assigning request data to variables for better debugging
        $name = $request->input('name');
        $gender = $request->input('gender');
        $email = $request->input('email');
        $address = $request->input('address');
        $phone_number = $request->input('phone_number');
        $note = $request->input('note');
        $payment_method = $request->input('payment_method');
    
        // Debug individual variables
        // dd($name, $gender, $email, $address, $phone_number, $note, $payment_method);
    
        // Creating a new Customer
        $customer = new Customer();
        $customer->name = $name;
        $customer->gender = $gender;
        $customer->email = $email;
        $customer->address = $address;
        $customer->phone_number = $phone_number;
        $customer->note = $note;
        $customer->save();
    
        // Creating a new Bill
        $bill = new Bill();
        $bill->id_customer = $customer->id;
        $bill->date_order = now();
        $bill->total = $cart->totalPrice;
        $bill->payment = $payment_method;
        $bill->note = $note;
    
        // Debugging bill data before saving
        // This should reveal if any attribute is incorrectly set as an array
        
    
        $bill->save();
    
        foreach ($cart->items as $key => $value) {
            $billDetail = new BillDetail();
            $billDetail->id_bill = $bill->id;
            $billDetail->id_product = $key;
            $billDetail->quantity = $value['qty'];
            $billDetail->unit_price = $value['price'] / $value['qty'];
            $billDetail->save();
        }
    
        Session::forget('cart');
        return redirect()->back()->with('success', 'Order placed successfully');
    }
    
    
    
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),
        [
            "name"  => "required",
            // "id_type"=> "required",
            "unit_price" => "required",
            "promotion_price" => "required",
            "description"  => "required",
            "unit" =>"required",
            "new" =>"required",
            'image_file'=>'mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        if ($validation->fails()){
            return redirect('them')->withErrors($validation)->withInput();
        }
        $name = null;
        if($request->hasfile('image_file'))
        {
            $file = $request->file('image_file');
            $name=time().'_'.$file->getClientOriginalName();
            $destinationPath=public_path('image'); //project\public\images, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images/
        }
     
        $products=new product();
        $products->name=$request->input('name');
        $products->unit_price=$request->input('unit_price');
        $products->promotion_price=$request->input('promotion_price');
        $products->description=$request->input('description');
        // $products->id_type=$request->input('id_type');
        $products->unit=$request->input('unit');
        $products->new=$request->input('new');

        $products->image=$name ?? '';
        $products->save();
        return redirect('products.index')->with('message','Thêm thành công');
    }
    public function create()
    {
        $products=Product::all();
        return view('admin.create',compact('products'));
    }
    public function getSignin(){
       
        return view('acc.signup');
    }

    public function postSignin(Request $req){
        $validator = Validator::make($req->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:20',
            'fullname' => 'required',
            'repassword' => 'required|same:password',
            'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'address' => 'nullable|string|max:255',
            'role' => 'required|in:user,admin',
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Không đúng định dạng email',
            'email.unique' => 'Email đã có người sử dụng',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu ít nhất 6 ký tự',
            'password.max' => 'Mật khẩu tối đa 20 ký tự',
            'fullname.required' => 'Vui lòng nhập tên đầy đủ',
            'repassword.required' => 'Vui lòng xác nhận mật khẩu',
            'repassword.same' => 'Mật khẩu không giống nhau',
            'phone.regex' => 'Số điện thoại không hợp lệ',
            'phone.min' => 'Số điện thoại phải có ít nhất 10 chữ số',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User(); // Correctly instantiate the User model
        $user->full_name = $req->fullname;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->phone = $req->phone;
        $user->address = $req->address;
        $user->role = $req->role;
        $user->save();

        return redirect()->back()->with('success', 'Tạo tài khoản thành công');
    }
    public function getLogin(){
        return view('acc.login');
    }

public function postLogin(Request $req){
        $this->validate($req,
        [
            'email'=>'required|email',
            'password'=>'required|min:6|max:20'
        ],
        [
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Không đúng định dạng email',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'password.min'=>'Mật khẩu ít nhất 6 ký tự'
        ]
        );
        $credentials=['email'=>$req->email,'password'=>$req->password];
        if(Auth::attempt($credentials)){//The attempt method will return true if authentication was successful. Otherwise, false will be returned.
            return redirect('/index')->with(['flag'=>'alert','message'=>'Đăng nhập thành công']);
        }
        else{
            return redirect()->back()->with(['flag'=>'danger','message'=>'Đăng nhập không thành công']);
        }
    }
    public function getLogout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('banhang.index-show');
    }
    public function getInputEmail(){
        return view('emails.input-email');
    }

//hàm xử lý gửi email
    public function postInputEmail(Request $req){
        $email=$req->txtEmail;
        //validate

        // kiểm tra có user có email như vậy không
        $user=User::where('email',$email)->get();
        //dd($user);
        if($user->count()!=0){
            //gửi mật khẩu reset tới email
            $sentData = [
                'title' => 'Mật khẩu mới của bạn là:',
                'body' => '123456'
            ];
            Mail::to($email)->send(new \App\Mail\SendMail($sentData));
            Session::flash('message', 'Send email successfully!');
            return view('acc.login');  //về lại trang đăng nhập của khách
        }
        else {
              return redirect()->route('getInputEmail')->with('message','Your email is not right');
        }
    }//hết postInputEmail
    public function search(Request $request)
{
    $query = $request->input('query');
    $products = Product::where('name', 'LIKE', "%{$query}%")
                        ->orWhere('description', 'LIKE', "%{$query}%")
                        ->get();

    return view('banhang.search-results', compact('products', 'query'));
}
 
}