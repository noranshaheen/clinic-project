<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $majors = Major::all();
        return view('Front.pages.Majors.index', compact('majors'));
    }

    public function index2()
    {
        $majors = Major::with('doctors')->get();
        // dd($majors);
        return view('Admin.pages.Majors.index', compact('majors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.pages.Majors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpg,png,jpej'],
        ]);

        $ext = $request->file('image')->extension();
        $name = "major" . time() . rand(1, 100000) . "." . $ext;
        $request->file('image')->move(public_path("Admin\Majors\\"), $name);

        Major::create([
            'name' => $request->name,
            'image' => 'Admin\\Majors\\' . $name
        ]);

        return redirect()->route('major.index2')->with('success', "the major stored successfuly");
    }

    /**
     * Display the specified resource.
     */
    public function show(Major $major)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Major $major)
    {
        // dd($major);
        return view('Admin.pages.Majors.edit', compact('major'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Major $major)
    {
        // dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpej'],
        ]);

        if ($request->file('image')) {

            if (File::exists(public_path($major->image))) {
                File::delete(public_path($major->image));
            }

            $ext = $request->file('image')->extension();
            $name = "major" . time() . rand(1, 100000) . "." . $ext;
            $request->file('image')->move(public_path("Admin\Majors\\"), $name);

            $major->update([
                'name' => $request->name,
                'image' => "Admin\Majors\\".$name
            ]);

            return redirect()->route('major.index2')->with('success', "the major updated successfuly");

        } else {

            $major->update([
                'name'=> $request->name
            ]);

            return redirect()->route('major.index2')->with('success', "the major updated successfuly");

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Major $major)
    {
        $major->delete();
        return redirect()->route('major.index2')->with('success', "the major " . $major->name . " deleted successfuly");
    }
}
