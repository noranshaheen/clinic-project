<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Doctor;
use App\Models\Major;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{

    public function dashboard()
    {
        $users = User::all()->count();
        $doctors = Doctor::all()->count();
        $majors = Major::all()->count();
        $bookings = Booking::all()->count();
        return view('Admin.layout.app',compact(['users','doctors','majors','bookings']));
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
