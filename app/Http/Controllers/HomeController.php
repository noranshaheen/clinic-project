<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Major;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $majors = Major::all();
        $doctors = Doctor::with('major')->get();
        // dd($doctors);
        return view('Front.layout.app',compact(['majors','doctors']));
    }
}
