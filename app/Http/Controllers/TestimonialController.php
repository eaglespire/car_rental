<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
//use Intervention\Image\Facades\Image;
use Image;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $testimonials = Testimonial::orderBy('created_at','DESC')->get();
        return view('admin.testimonials', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required','string'],
            'job_title'=>['required','string'],
            'body'=>['required','string'],
            'image'=>['nullable','image','max:10000'],
        ]);
        //Handle image upload
          $fileNameToStore = null;
        if ($request->hasFile('image')){
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileName = rand(1,100000).time();
            $fileNameToStore = "$fileName.$fileExt";
            $request->file('image')->storeAs('testimonials',$fileNameToStore,'public');
                //obtain an image
             $img = public_path("storage/testimonials/$fileNameToStore");
            Image::make($img)->resize(400,300)->save();
        }

        try {
            Testimonial::create([
                'name'=>$request->input('name'),
                'job_title'=>$request->input('job_title'),
                'body'=>$request->input('body'),
                'image'=>$fileNameToStore
            ]);
            return back()->with('success','Success!!');
        }   catch (\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error','Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        //
    }
}
