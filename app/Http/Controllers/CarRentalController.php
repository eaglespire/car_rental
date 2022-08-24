<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\TransactionSuccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CarRentalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.bookings', [
            'bookings'=>Booking::paginate(10)
        ]);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        try {
            $booking = Booking::findOrFail($id);
            $booking->update([
                'status'=>1
            ]);
            return back()->with('success','Success!');
        } catch (\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error','Record does not exist in our database');
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
            $booking = Booking::findOrFail($id);
            //Before marking the transaction as completed,
           // push into  the transaction completed table
            TransactionSuccess::create([
               'name'=>$booking->name,
                'phone'=>$booking->phone,
                'transaction_started'=>$booking->pick_up_date,
                'transaction_completed'=>$booking->drop_off_date,
                'car_id'=>$booking->car_id
            ]);
            $booking->delete();
            return back()->with('success','Transaction completed!');
        } catch (\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error','Something went wrong');
        }
    }

}
