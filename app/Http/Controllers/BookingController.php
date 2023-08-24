<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $doctor = Doctor::findOrFail($id);
        // dd($doctor);
        return view('Front.pages.Booking.create',compact('doctor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$id)
    {
        $today = Carbon::today();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date', 'after_or_equal:'.$today],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        Booking::create([
            'name'=>$request->name,
            'phone' =>$request->phone,
            'date' => $request->date,
            'email' => $request->email,
            'doctor_id' => $id
        ]);

        $doctor = Doctor::findOrFail($id);
        return view('Front.pages.Booking.create',compact('doctor'))->with('success','booking stored successfuly');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
