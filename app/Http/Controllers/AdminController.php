<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TypeProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                Auth::logout();
                return back()->with('error', 'Bạn không có quyền truy cập khu vực quản trị.');
            }
        }

        return back()->withErrors(['email' => 'Thông tin đăng nhập không hợp lệ'])->withInput();
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }
    public function show()
    {
        $products=Product::paginate(10);
        //tương đương select* from where
        return view('admin.list',compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $product=Product::find($id);
        return view('admin.edit',compact('TypeProduct','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name='';
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
            return redirect()->back()->withErrors($validation)->withInput();
        }
        if($request->hasfile('image_file'))
        {
            $file = $request->file('image_file');
            $name=time().'_'.$file->getClientOriginalName();
            $destinationPath=public_path('images'); //project\public\images, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images/
        }
        //lấy về xe cần sửa
        $product=Product::find($id);
        if($product!=null){
            $products=new product();
            $products->name=$request->input('name');
            $products->unit_price=$request->input('unit_price');
            $products->promotion_price=$request->input('promotion_price');
            $products->description=$request->input('description');
            // $products->id_type=$request->input('id_type');
            $products->unit=$request->input('unit');
            $products->new=$request->input('new');
            if($name==''){
                $name=$product->image;
            }    
            $product->image=$name;  
            $product->save();
        }
        return redirect('product')->with('message','Sửa  thành công');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
* @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);
        
        $linkImage=public_path('image/').$product->image;
        if(File::exists($linkImage)){
            File::delete($linkImage);
        }
        $product->delete();
        return redirect()->back()->with('message', 'bạn đã xóa thành công !');
    }
    public function postSearch(Request $req){
        $search_value=$req->txSearch;
        $products=product::where('name','like','%'.$search_value.'%')
        ->get();
        return view('admin.list',compact('products'));
        }
    
}
