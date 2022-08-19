<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Category;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Image;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $categories = Category::get();
        $cars = Car::paginate(2);
        return view('admin.cars', compact('categories','cars'));
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
       // dd($request->all());
        $request->validate([
            'name'=>['required','string'],
            'brand'=>['required','string'],
            'body'=>['required','string'],
            'image'=>['nullable','image','max:10000'],
            'price'=>['required','numeric'],
        ]);

        //Handle image upload
        $fileNameToStore = null;
        if ($request->hasFile('image')){
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileName = rand(1,100000).time();
            $fileNameToStore = "$fileName.$fileExt";
            $request->file('image')->storeAs('cars',$fileNameToStore,'public');
            $image = public_path("storage/cars/$fileNameToStore");
            Image::make($image)->resize(600,400)->save();
        }
        try {
            Car::create([
                'name'=>$request->input('name'),
                'brand'=>$request->input('brand'),
                'body'=>$request->input('body'),
                'price'=>$request->input('price'),
                'category_id'=>$request->input('category_id'),
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
