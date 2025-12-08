<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewPropertyRequest;
use App\Http\Requests\PropertySearchRequest;
use App\Http\Requests\PropertyUpdateRequest;
use App\Models\PropertyImageModel;
use App\Models\PropertyModel;
use App\Models\UserFavouriteModel;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\String\b;


class PropertyController extends Controller
{

    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = PropertyModel::with('images', 'favourites')->get();

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

        $pricePerSquareMeter = $request->price / $request->area;

        $property = PropertyModel::create([
            ...$request->validated(),
            'price_per_square_meter' => $pricePerSquareMeter,
        ]);


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

    public function filter(PropertySearchRequest $request)
    {
        $isNull = true;

        foreach($request->validated() as $key => $value) {
            if($value == null)
            {
                continue;
            } else {
                $isNull = false;
                break;
            }
        }

        if($isNull) {
            return $this->index();
        }
        else {

            $purpose = $request->purpose;
            $propertyType = $request->property_type;
            $city = $request->city;
            $fromPrice = $request->price_from;
            $toPrice = $request->price_to;
            $fromPricePerArea = $request->price_per_m2_from;
            $toPricePerArea = $request->price_per_m2_to;


            $query = PropertyModel::with('images')
                ->where("purpose", "LIKE", "%$purpose%")
                ->where("property_type", "LIKE", "%$propertyType%")
                ->where("city", "LIKE", "%$city%");


            if($fromPrice !== null) {
                $query->where("price", ">=", $fromPrice);
            }

            if($toPrice !== null) {
                $query->where("price", "<=", $toPrice);
            }

            if($fromPricePerArea !== null) {
                $query->where("price_per_square_meter", ">=", $fromPricePerArea);
            }

            if($toPricePerArea !== null) {
                $query->where("price_per_square_meter", "<=", $toPricePerArea);
            }


            $properties = $query->get();

            return view('welcome', compact('properties'));
        }
    }

    public function like(Request $request)
    {
        $icon = $request->icon;
        $propertyId = $request->propertyId;
        $userId = Auth::id();

        if($icon == "regular")
        {
            UserFavouriteModel::create([
                'user_id' => $userId,
                'property_id' => $propertyId
            ]);

            return redirect()->back()->with('like', 'Uspešno ste sačuvali oglas!');
        }
        else {
            UserFavouriteModel::where('user_id', $userId)->where('property_id', $propertyId)->delete();

            return redirect()->back()->with('unlike','Uspešno ste uklonili oglas iz sačuvanih.');
        }
    }

    public function posted()
    {
        $postedProperties = PropertyModel::where('user_id', Auth::id())->get();

        return view('posted', compact('postedProperties'));
    }

    /**
     * Display the specified resource.
     */
    public function show(PropertyModel $properties)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PropertyModel $property)
    {
        $propertyWithImages = PropertyModel::with('images')->whereId($property->id)->first();

        return view('edit', ['property' => $propertyWithImages]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyUpdateRequest $request, PropertyModel $property)
    {
        $property->fill($request->all());

        $changedFields = $property->getDirty();

        dd($changedFields);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PropertyModel $property)
    {
        $property->delete();

        return redirect()->back();
    }
}
