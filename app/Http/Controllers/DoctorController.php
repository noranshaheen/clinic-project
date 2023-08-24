<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($major_id = null)
    {
        if($major_id){
            $doctors = Doctor::where('major_id','=',$major_id)->with('major')->get();
            return view('Front.pages.doctors.index',compact('doctors'));
        }else{
            $doctors = Doctor::with('major')->get();
            return view('Front.pages.doctors.index',compact('doctors'));
        }
    }

    public function index2()
    {
        $doctors = Doctor::with('major')->get();
        // dd($majors);
        return view('Admin.pages.Doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $majors = Major::all();
        return view('Admin.pages.Doctors.create',compact('majors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'major_id' =>['required'],
            'image' => ['required', 'image', 'mimes:jpg,png,jpej'],
        ]);

        $ext = $request->file('image')->extension();
        $name = "doctor" . time() . rand(1, 100000) . "." . $ext;
        $request->file('image')->move(public_path("Admin\Doctor\\"), $name);

        Doctor::create([
            'name' => $request->name,
            'image' => 'Admin\\Doctor\\' . $name,
            'major_id' => $request->major_id
        ]);

        return redirect()->route('doctor.index2')->with('success', "the doctor stored successfuly");
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $Doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        // dd($major);
        $majors = Major::all();
        return view('Admin.pages.Doctors.edit',compact(['majors','doctor']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        // dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpej'],
            'major_id' =>['required']
        ]);

        if ($request->file('image')) {

            if (File::exists(public_path($doctor->image))) {
                File::delete(public_path($doctor->image));
            }

            $ext = $request->file('image')->extension();
            $name = "doctor" . time() . rand(1, 100000) . "." . $ext;
            $request->file('image')->move(public_path("Admin\Doctors\\"), $name);

            $doctor->update([
                'name' => $request->name,
                'image' => "Admin\Doctors\\".$name,
                'major_id'=> $request->major_id
            ]);

            return redirect()->route('doctor.index2')->with('success', "the doctor updated successfuly");

        } else {

            $doctor->update([
                'name'=> $request->name,
                'major_id'=> $request->major_id
            ]);

            return redirect()->route('doctor.index2')->with('success', "the doctor updated successfuly");

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return redirect()->route('doctor.index2')->with('success', "the doctor " . $doctor->name . " deleted successfuly");
    }
}
