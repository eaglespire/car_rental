<?php


use App\Http\Controllers\CarsController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
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

Route::get('/', [\App\Http\Controllers\PageController::class,'welcome'])->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('admin')->name('admin.')->group(function (){
    Route::get('/', function (){
       return view('admin.dashboard');
    })->name('dashboard');
   Route::resource('categories', CategoryController::class);
   Route::resource('testimonials', TestimonialController::class);
   Route::resource('cars', CarsController::class);
});



Route::get('/practice', function(Request $request){
    return view('practice');
});

Route::post('/practice', function (Request $request){
    //dd('It is Working');
    $request->validate([
        'image'=>['image','mimes:jpg,jpeg,png,webp','max:100']
    ]);
    if ($request->hasFile('image')){
       // dd($request->file('image'));
        // getClientOriginalName()
        //getClientOriginalExtension()
        //$originalName = $request->file('image')->getClientOriginalName();
       // dd($originalName);
        $fileExt = $request->file('image')->getClientOriginalExtension();
       // dd($fileExt);
        //storing the image
        $fileName = rand(1,1000000000).time();
        //$fileNameToStore = $fileName.'.'.$fileExt;
        $fileNameToStore = "$fileName.$fileExt";
    $path =  $request->file('image')->storeAs('rooms',$fileNameToStore);
        return $path;
        //request->file returns an instance of the uploaded file
    } else{
        dd('Nothing uploaded');
    }
    // noimage.jpg


    Route::get('/test', function (Request $request){
       $user = User::first();
       //gets the user's name
        $user->name;
        $user->email;
        $user->profile->phone;

        //profiles table
        $profile = \App\Models\Profile::first();
        $profile->user->name;
    }) ;

    //users table
    //name
    //email
    //password

    //profiles table
    //middlename
    //address
    //phone



});
