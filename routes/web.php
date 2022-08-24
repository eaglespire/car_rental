<?php


use App\Http\Controllers\CarRentalController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Carbon\Carbon;

Route::get('/', [PageController::class,'welcome'])->name('welcome');
 Route::post('/rent', [ PageController::class,'rent' ])->name('rent');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('admin')->name('admin.')->group(function (){
    Route::get('/', function (){
       return view('admin.dashboard');
    })->name('dashboard');
   Route::resource('categories', CategoryController::class);
   Route::resource('testimonials', TestimonialController::class);
   Route::resource('cars', CarsController::class);
   Route::resource('bookings', CarRentalController::class);



});






Route::get('/practice', function(Request $request){
   $newDate = Carbon::create(2022,8,26);
   dd(date('Y'));
})->name('practice');


