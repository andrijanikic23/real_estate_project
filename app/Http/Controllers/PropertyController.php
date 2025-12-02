<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewPropertyRequest;
use App\Models\PropertyImageModel;
use App\Models\PropertyModel;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;


class PropertyController extends Controller
{

    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(PropertyModel $properties)
    {
        $properties = PropertyModel::with('images')->get();

        return view('welcome', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewPropertyRequest $request)
    {
        $property = PropertyModel::create($request->validated());


        foreach($request->file('images') as $file)
        {
            $name = $this->uploadImage($file, "property_images/$property->id");

            $name = $property->id."/".$name;

            PropertyImageModel::create([
                'property_id' => $property->id,
                'path' => $name
            ]);

        }

        return redirect()->back()->with('success', 'Novi oglas uspešno napravljen!');


    }

    /**
     * Display the specified resource.
     */
    public function show(PropertyModel $properties)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PropertyModel $propertyModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PropertyModel $propertyModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PropertyModel $propertyModel)
    {
        //
    }
}
