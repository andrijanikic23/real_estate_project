@php use App\Http\EditHelper;use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\Session; @endphp

@extends('layout')

@section('content')


    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Form</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <div class="card">

        @if(Session::has('statusSuccess'))
            <h5 class="text-success">{{ Session::get('statusSuccess') }}</h5>
        @else
            <h5 class="text-danger">{{ Session::get('statusFail') }}</h5>
        @endif




        <h2>Izmenite stavke u oglasu</h2>
        <form action="{{ route('properties.update', $property->id) }}" enctype="multipart/form-data" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <input type="text" class="form-control" name="title" placeholder="Naslov" maxlength="128"
                       value="{{ $property->title }}" required>
                @if($errors->has('title'))
                    <div>{{ $errors->first('title') }}</div>
                @endif
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <select class="form-select" name="purpose" required>
                        <option disabled selected>Izaberite tip oglasa</option>
                        @if(EditHelper::getPurposeType($property->purpose) == 'prodaja')
                            <option value="sale" selected>Prodaja</option>
                            <option value="rent">Izdavanje</option>
                        @else
                            <option value="sale">Prodaja</option>
                            <option value="rent" selected>Izdavanje</option>
                        @endif
                    </select>
                </div>

                <div class="col-md-6">
                    <select class="form-select" name="property_type" required>
                        <option disabled selected>Tip objekta</option>
                        <option
                            value="apartment" {{ EditHelper::getPropertyType('apartment', $property->property_type) }}>
                            Stan
                        </option>
                        <option
                            value="house" {{ EditHelper::getPropertyType('house', $property->property_type) }}>
                            Kuća
                        </option>
                        <option
                            value="commercial space" {{ EditHelper::getPropertyType('commercial space', $property->property_type) }}>
                            Poslovni prostor
                        </option>
                        <option
                            value="construction land" {{ EditHelper::getPropertyType('construction land', $property->property_type) }}>
                            Građevinsko zemljište
                        </option>
                        <option
                            value="agricultural land" {{ EditHelper::getPropertyType('agricultural land', $property->property_type) }}>
                            Poljoprivredno zemljište
                        </option>
                        <option
                            value="holiday cottage" {{ EditHelper::getPropertyType('holiday cottage', $property->property_type) }}>
                            Vikendica
                        </option>
                        <option
                            value="warehouse" {{ EditHelper::getPropertyType('warehouse', $property->property_type) }}>
                            Magacin
                        </option>
                    </select>
                    @if($errors->has('property_type'))
                        <div>{{ $errors->first('property_type') }}</div>
                    @endif
                </div>
            </div>


            <div class="mb-3">
                <textarea class="form-control" name="description" placeholder="Opis oglasa" rows="3"
                          required>{{ $property->description }}</textarea>
                @if($errors->has('description'))
                    <div>{{ $errors->first('description') }}</div>
                @endif
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="city" placeholder="Grad" maxlength="32"
                           value="{{ $property->city }}" required>
                    @if($errors->has('city'))
                        <div>{{ $errors->first('city') }}</div>
                    @endif
                </div>

                <div class="col-md-4">
                    <input type="text" class="form-control" name="municipality" value="{{ $property->municipality }}"
                           placeholder="Opština" maxlength="32"
                           required>
                    @if($errors->has('municipality'))
                        <div>{{ $errors->first('municipality') }}</div>
                    @endif
                </div>

                <div class="col-md-4">
                    <input type="text" class="form-control" name="address" value="{{ $property->address }}"
                           placeholder="Adresa" maxlength="64" required>
                    @if($errors->has('address'))
                        <div>{{ $errors->first('address') }}</div>
                    @endif
                </div>
            </div>


            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="map_url" value="{{ $property->map_url }}"
                           placeholder="Link do nekretnine/nepokretnosti">
                    @if($errors->has('map_url'))
                        <div>{{ $errors->first('map_url') }}</div>
                    @endif
                </div>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="contact_number"
                           value="{{ $property->contact_number }}" placeholder="Kontakt telefon" maxlength="32">
                    @if($errors->has('contact_number'))
                        <div>{{ $errors->first('contact_number') }}</div>
                    @endif
                </div>
            </div>


            <div class="row mb-3">
                <div class="col-md-3">
                    <input type="number" class="form-control" name="price" value="{{ $property->price }}"
                           placeholder="Cena &euro;" step="0.01" min="0"
                           required>
                    @if($errors->has('price'))
                        <div>{{ $errors->first('price') }}</div>
                    @endif
                </div>

                <div class="col-md-3">
                    <input type="number" class="form-control" name="area" value="{{ $property->area }}"
                           placeholder="Površina (m²)" step="0.1" min="0"
                           required>
                    @if($errors->has('area'))
                        <div>{{ $errors->first('area') }}</div>
                    @endif
                </div>

                <div class="col-md-3">
                    <input type="number" class="form-control" name="floor" value="{{ $property->floor }}"
                           placeholder="Sprat" min="0">
                    @if($errors->has('floor'))
                        <div>{{ $errors->first('floor') }}</div>
                    @endif
                </div>

                <div class="col-md-3">
                    <input type="number" class="form-control" name="total_floors" value="{{ $property->total_floors }}"
                           placeholder="Spratnost objekta"
                           min="0">
                    @if($errors->has('total_floors'))
                        <div>{{ $errors->first('total_floors') }}</div>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <select class="form-select" name="heating_type">
                        <option disabled>Tip grejanja</option>
                        <option
                            value="central" {{ EditHelper::getHeatingType('central', $property->heating_type) }}>
                            Centralno grejanje
                        </option>
                        <option value="ta" {{ EditHelper::getHeatingType('ta', $property->heating_type) }}>
                            TA
                        </option>
                        <option value="gas" {{ EditHelper::getHeatingType('gas', $property->heating_type) }}>
                            Gas
                        </option>
                        <option
                            value="floor" {{ EditHelper::getHeatingType('floor', $property->heating_type) }}>
                            Podno
                        </option>
                        <option
                            value="none" {{ EditHelper::getHeatingType('none', $property->heating_type) }}>
                            Nema
                        </option>
                    </select>
                    @if($errors->has('heating_type'))
                        <div>{{ $errors->first('heating_type') }}</div>
                    @endif
                </div>

                <div class="col-md-4">
                    <input type="number" class="form-control" name="construction_year"
                           value="{{ $property->construction_year }}" placeholder="Godina izgradnje"
                           min="1800" max="2100">
                    @if($errors->has('construction_year'))
                        <div>{{ $errors->first('construction_year') }}</div>
                    @endif
                </div>

                <div class="col-md-2 form-check mb-3">
                    <select class="form-select" name="parking">
                        <option disabled>Da li postoji parking</option>
                        <option
                            value="1" {{ EditHelper::getParkingFurnishedInfo(1, $property->parking) }}>
                            Parking
                        </option>
                        <option value="0" {{ EditHelper::getParkingFurnishedInfo(0, $property->parking) }}>
                            Nema parkinga
                        </option>
                    </select>
                    @if($errors->has('parking'))
                        <div>{{ $errors->first('parking') }}</div>
                    @endif
                </div>

                <div class="col-md-2 form-check mb-3">
                    <select class="form-select" name="furnished">
                        <option disabled>Da li je nekretnina/prostor namešten</option>
                        <option
                            value="1" {{ EditHelper::getParkingFurnishedInfo(1, $property->furnished) }}>
                            Namešten
                        </option>
                        <option value="0" {{ EditHelper::getParkingFurnishedInfo(0, $property->furnished) }}>
                            Nije namešten
                        </option>
                    </select>
                    @if($errors->has('furnished'))
                        <div>{{ $errors->first('furnished') }}</div>
                    @endif
                </div>
            </div>



            <div class="row mb-3">
                <label for="images">Dodajte slike ispod</label>
                <input type="file" name="images[]" multiple accept="images/*">
                @if($errors->has('images'))
                    <div>{{ $errors->first('images') }}</div>
                @endif
                @if($errors->has('images.*'))
                    <div>{{ $errors->first('images.*') }}</div>
                @endif
            </div>

            @if($errors->has('user_id'))
                <div>{{ $errors->first('user_id') }}</div>
            @endif

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary">Sačuvaj promene</button>
            </div>

        </form>


            <div class="d-flex flex-wrap align-items-center justify-content-center gap-2 mt-4">
                @foreach($property->images as $image)
                    <form class="d-flex flex-column" action="{{ route('image.delete', $image->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <img class="d-block w-100" style="height:250px; object-fit:cover;" alt="Property image" src="/storage/property_images/{{ $image->path }}">
                        <button type="submit" class="btn btn-outline-secondary"><i class="fa-solid fa-trash-can"></i></button>
                    </form>
                @endforeach
            </div>



    </div>





</div>


@endsection

