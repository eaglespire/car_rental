<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Models\Testimonial;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    public function welcome()
    {
        $testimonials = Testimonial::orderBy('created_at','DESC')->get();
       // $cars = Car::orderBy('created_at','DESC')->take(4)->get();
        $cars = Car::with('category')->get();
        //dd($testimonials);
        return view('welcome', compact('testimonials','cars'));
    }
    public function rent(Request $request)
    {
        //dd($request->all());
        $request->validate([
           'pick_up_location'=>['required','string','max:255'],
            'drop_off_location'=>['required','string','max:255'],
            'pick_up_date'=>['required','date'],
            'drop_off_date'=>['required','date'],
            'name'=>['required','string','max:255'],
            'phone'=>['required','string','max:14']
        ]);
       // dd('Validation passed');
        //dd($request->all());
       //validate
        try {
           Booking::create($request->all());
           return back()->with('success','Request sent');
        } catch (\Exception $e){
            Log::error($e->getMessage());
            return back()->with('error','Error!');
        }
    }


}
