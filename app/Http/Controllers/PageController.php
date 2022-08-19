<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Testimonial;
use Illuminate\Http\Request;

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
}
