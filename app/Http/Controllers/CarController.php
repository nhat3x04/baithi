<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Mf;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;


class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $car=Car::paginate(5);
        return view('car.car-list',compact('car'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mfs=Mf::all();
        return view('car.car-create',compact('mfs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),
        [
            "description"  => "required",
            "model" => "required",
            "product_on"  => "required|date",
            "mf_id" =>"required",
            'image_file'=>'mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        if ($validation->fails()){
            return redirect('car/create')->withErrors($validation)->withInput();
        }
        $name = null;
        if($request->hasfile('image_file'))
        {
            $file = $request->file('image_file');
            $name=time().'_'.$file->getClientOriginalName();
            $destinationPath=public_path('image'); //project\public\images, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images/
        }
     
        $car=new Car();
        $car->description=$request->input('description');
        $car->model=$request->input('model');
        $car->product_on=$request->input('product_on');
        $car->mf_id=$request->input('mf_id');
        $car->image=$name ?? '';
        $car->save();
        return redirect('car')->with('message','Thêm xe thành công');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car=Car::find($id);
        //tương đương select* from where
        return view('car.car-show',compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mfs=Mf::all();
        $car=Car::find($id);
        return view('car.car-edit',compact('mfs','car'));
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
            "description"  => "required",
            "model" => "required",
            "product_on"  => "required|date",
            "mf_id" =>"required",
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
        $car=Car::find($id);
        if($car!=null){
            $car->description=$request->input('description');
            $car->model=$request->input('model');
            $car->product_on=$request->input('product_on');
            $car->mf_id=$request->input('mf_id');
            if($name==''){
                $name=$car->image;
            }    
            $car->image=$name;  
            $car->save();
        }
        return redirect('car')->with('message','Sửa xe thành công');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
* @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car=Car::find($id);
        
        $linkImage=public_path('image/').$car->image;
        if(File::exists($linkImage)){
            File::delete($linkImage);
        }
        $car->delete();
        return redirect()->back()->with('message', 'bạn đã xóa thành công !');
    }
  
    public function postSearch(Request $request)
    {
        $query = $request->input('query');
    
        $car = Car::with('mf') // Eager load the related mf table
                    ->where('model', 'LIKE', '%' . $query . '%')
                    ->orWhere('description', 'LIKE', '%' . $query . '%')
                    ->orWhereHas('mf', function ($q) use ($query) {
                        $q->where('mf_name', 'LIKE', '%' . $query . '%');
                    })
                    ->paginate(5);
    
        return view('car.car-list', compact('car'))->with('search_query', $query);
    }
    
}