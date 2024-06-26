<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CarController;
use App\Models\Car;
use App\Models\cart;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BillController;

    

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/', function () {
    //return view('welcome');
//});
//Route::get('/helo', function () {
    //return "<h1>helo <h1>";
//});
//Route::get('/hello2', function () {
    //return view('hello2');
//});
//Route::get('giaipt', [Giaicontroller::class,'getPt1'])->name('getPt1');

//Route::post('giaipt', [Giaicontroller::class,'postPt1'])->name ('postPt1');
    
//Route::get('car/{id}',[CarController::class,'show'])->name('car-show');

//Route::resource('car',CarController::class);
//Route::post('/car/search', [CarController::class, 'postSearch'])->name('car.search');
Route::get('index', function () {
    return view('banhang.index-show');
});
Route::get('index',[PageController::class,'index'])->name('banhang.index-show');

Route::get('indexvtmb',[PageController::class,'indexvtmb'])->name('banhang.indexvtmb');

Route::get('indexvtmc',[PageController::class,'indexvtmc'])->name('banhang.indexvtmc');

Route::get('/product/{id}', [PageController::class, 'getChiTietsp'])->name('banhang.product');
Route::get('checkout', function () {
    return view('cart.checkout');
});
Route::get('shoppingcart', function () {
    return view('cart.shopping_cart');
});
Route::get('pricing', function () {
    return view('cart.pricing');
});
Route::get('signup', function () {
    return view('acc.signup');
});
Route::get('login', function () {
    return view('acc.login');
});
Route::get('/add-to-cart/{id}',[PageController::class,'addToCart'])->name('banhang.addtocart');
Route::get('xoagiohang/{id}', [PageController::class, 'removeFromCart'])->name('banhang.xoagiohang');

// Route::get('/banhang/favorite/{id}',[PageController::class,'addToFavorites'])->name('banhang.addToFavorites');
// Route::get('/banhang/unfavorite/{id}', [PageController::class,'removeFromFavorites'])->name('banhang.removeFromFavorites');

Route::post('add-to-favorites/{id}', [PageController::class, 'addToFavorites'])->name('banhang.addToFavorites');
Route::post('remove-from-favorites/{id}', [PageController::class, 'removeFromFavorites'])->name('banhang.removeFromFavorites');


Route::get('/favorites', [PageController::class,'favorites'])->name('banhang.favorite.list');


Route::get('dathang', [PageController::class, 'getCheckout'])->name('banhang.getdathang');
Route::get('checkout',[PageController::class,'getCheckout'])->name('banhang.getdathang');
Route::post('checkout',[PageController::class,'postCheckout'])->name('banhang.postdathang');
Route::post('them',[PageController::class,'store'])->name('products.store');
Route::get('them',[PageController::class,'create'])->name('products.them');
Route::get('/dangky',[PageController::class,'getSignin'])->name('getsignin');
Route::post('/dangky',[PageController::class,'postSignin'])->name('postsignin');
Route::get('/dangnhap',[PageController::class,'getLogin'])->name('getlogin');
Route::post('/dangnhap',[PageController::class,'postLogin'])->name('postlogin');
Route::get('/dangxuat',[PageController::class,'getLogout'])->name('getlogout');
Route::get('adminlist', function () {
    return view('admin.list');
})
;Route::get('admincreate', function () {
    return view('admin.create');
});
;Route::get('adminedit', function () {
    return view('admin.edit');
});
Route::get('adminlogin', function () {
    return view('admin.login');
});
Route::get('productlist', function () {
    return view('admin.productlist');
})
;Route::get('productadd', function () {
    return view('admin.productadd');
});
;Route::get('productedit', function () {
    return view('admin.productedit');
});
Route::get('userlist', function () {
    return view('admin.userlist');
})
;Route::get('useradd', function () {
    return view('admin.useradd');
});
;Route::get('useredit', function () {
    return view('admin.useredit');
});
Route::post('/input-email',[PageController::class,'postInputEmail'])->name('postInputEmail');
Route::get('/input-email',[PageController::class,'getInputEmail'])->name('getInputEmail');
Route::get('contact', function () {
    return view('emails.contacts');
});
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
// Route cho trang danh sách liên hệ quản trị viên
Route::get('/contacts', [ContactController::class, 'index'])->name('admin.contacts.index');

// Route cho trả lời liên hệ
Route::post('/admin/contacts/reply/{id}', [ContactController::class, 'reply'])->name('admin.contacts.reply');
Route::get('/admin/contacts/{id}/reply', [ContactController::class, 'showReplyForm'])->name('admin.contacts.showReplyForm');
Route::get('admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::group(['middleware' => 'admin'], function () {
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');
});
Route::get('/detail/{id}', [PageController::class, 'show'])->name('detail.show');
Route::get('destroy/{id}',[AdminController::class,'destroy'])->name('products.destroy');

Route::get('edit/{id}',[AdminController::class,'edit'])->name('products.edit');

Route::post('edit/{id}',[AdminController::class,'update'])->name('products.update');

Route::post('products/search',[AdminController::class,'postSearch'])->name('postSearch');
Route::get('danhsach',[AdminController::class,'show'])->name('admin.list');

Route::get('/categories/create', 'CategoryController@create')->name('categories.create');

// Route for storing (creating) a new category
Route::post('/categories', 'CategoryController@store')->name('categories.store');
Route::get('/search', [PageController::class, 'search'])->name('products.search');
Route::get('billlist', [BillController::class, 'index'])->name('bill.list');
Route::get('billadd', [BillController::class, 'create'])->name('bill.add');
Route::post('billadd', [BillController::class, 'store'])->name('bill.store');
Route::get('billedit/{id}', [BillController::class, 'edit'])->name('bill.edit');
Route::post('billedit/{id}', [BillController::class, 'update'])->name('bill.update');
Route::get('/bills/{id}',[BillController::class, 'show'])->name('bill.details');

