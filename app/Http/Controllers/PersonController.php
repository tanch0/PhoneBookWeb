<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonRequest;
use App\Models\Business;
use App\Models\Person;
use Illuminate\Support\Facades\Storage;


class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //eager loading - reduces the number of queries
        return view('person.index')->with('people', Person::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('person.create')->with('businesses', Business::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PersonRequest $request)
    {
        $validatedData = $request->validated();
    
        $imagePath = null;
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
    
            // Check if the file was successfully stored
            if (!$imagePath) {
                return redirect()->back()->withInput()->withErrors(['image' => 'Failed to upload the image']);
            }
    
            // Set the image path for database storage (relative to public directory)
            $imagePath = 'images/' . basename($imagePath);
        }
    
        // Include the business_id in the validated data
        $personData = array_merge($validatedData, ['image' => $imagePath, 'business_id' => $request->input('business_id')]);
    
        // Create a new Person instance with the merged data
        $person = Person::create($personData);
    
        return redirect(route('person.index'));
    }    
    
    /**
     * Display the specified resource.
     */
    public function show(Person $person)
    {
        return view('person.detail')->with('person', $person);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Person $person)
    {
        return view('person.edit')->with(['person' => $person, 'businesses' => Business::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PersonRequest $request, Person $person)
    {
        // Store the existing image path for potential deletion
        $oldImagePath = $person->image;
    
        if ($request->hasFile('image')) {
            // Generate a unique filename
            $fileName = time() . '.' . $request->image->getClientOriginalExtension();
    
            // Store the image using Laravel's storage functionality
            $request->image->storeAs('public/images', $fileName);
    
            // Set the image path for database storage (relative to public directory)
            $imagePath = 'images/' . $fileName;
    
            // Delete the old image file if it exists (using Laravel's Storage)
            if ($oldImagePath) {
                Storage::delete('public/' . $oldImagePath);
            }
        } else {
            // Keep the existing image path if no new image uploaded
            $imagePath = $oldImagePath;
        }
    
        // Include the business_id in the validated data
        $personData = array_merge($request->validated(), ['image' => $imagePath, 'business_id' => $request->input('business_id')]);
    
        // Update the Person instance with the merged data
        $person->update($personData);
    
        return redirect(route('person.index'));
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person)
    {
        $person->delete();

        return redirect(route('person.index'));
    }
}
