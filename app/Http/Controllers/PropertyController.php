<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewPropertyRequest;
use App\Models\PropertyModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class PropertyController extends Controller
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
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewPropertyRequest $request)
    {
//        PropertyModel::create($request->validated());

        $gd = new Driver();
        $manager = new ImageManager($gd);

        foreach($request->file('images') as $file)

        $name = uniqid().".webp";


        $image = $manager->read($file)->toWebp(90);

        Storage::disk('public')->put("images/property_images/$name", (string) $image);


    }

    /**
     * Display the specified resource.
     */
    public function show(PropertyModel $propertyModel)
    {
        //
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
