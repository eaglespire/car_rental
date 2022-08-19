<?php

namespace App\Http\Controllers;

//use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        //compact()
        // fetch the categories from the database
       // $categories = Category::get();
       // $categories = Category::where('id','>=',1);
        $categories = Category::orderBy('id','DESC')->get();
        return view('admin.categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.categories.create');
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
            'name'=>['required','string']
         ]);

        try {
            //create a new model in the database
            Category::create([
                'name'=>$request->input('name')
            ]);
            //return back()->with('success','Data created successfully');
            return redirect()->route('admin.categories.index')->with('success','Data created successfully');
        } catch (\Exception $exception){
            Log::info($exception->getMessage());
            return back()->with('error','Ooops!!!, Seems something went wrong');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        try {
            $category = Category::findOrFail($id);
            return view('admin.categories.show', compact('category'));
        } catch (\Exception $exception){
             Log::info($exception->getMessage());
             return back()->with('error','Oops, what you are trying to fetch does not exist in our database');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        try {
          $category = Category::findOrFail($id);
          return view('admin.categories.edit', compact('category'));
        } catch (\Exception $exception){
             Log::info($exception->getMessage());
             return back()->with('error','The data you are trying to access does not exist');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>['required','string']
        ]);
        //find the category to update
        try {
           $category = Category::findOrFail($id);
           $category->update([
               'name'=>$request->input('name')
           ]);
           return back()->with('success','Updated Successfully');
        } catch (\Exception $exception){
            Log::info($exception->getMessage());
            return back()->with('error','Unable to edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
           $category = Category::findOrFail($id);
           $category->delete();
           return redirect()->route('admin.categories.index')->with('success','Deleted Successfully');
        }  catch (\Exception $exception){
            Log::info($exception->getMessage());
            return back()->with('error','Unable to delete. Try again later');
        }
    }
}
