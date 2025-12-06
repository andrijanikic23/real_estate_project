@php use Illuminate\Support\Facades\Session; @endphp

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

        @if(Session::has('success'))
            <h5 class="text-success">{{ Session::get('success') }}</h5>
        @endif

        <h2>Dodajte oglas</h2>
        <form action="{{ route('properties.store') }}" enctype="multipart/form-data" method="POST">

            @csrf

            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="title" placeholder="Naslov" maxlength="128" required>
                    @if($errors->has('title'))
                        <div>{{ $errors->first('title') }}</div>
                    @endif
                </div>

                <div class="col-md-6">
                    <select class="form-select" name="property_type" required>
                        <option disabled selected>Tip objekta</option>
                        <option value="apartment">Stan</option>
                        <option value="house">Kuća</option>
                        <option value="commercial space">Poslovni prostor</option>
                        <option value="construction land">Građevinsko zemljište</option>
                        <option value="agricultural land">Poljoprivredno zemljište</option>
                        <option value="holiday cottage">Vikendica</option>
                        <option value="warehouse">Magacin</option>
                    </select>
                    @if($errors->has('property_type'))
                        <div>{{ $errors->first('property_type') }}</div>
                    @endif
                </div>
            </div>

            <div class="mb-3">
                <textarea class="form-control" name="description" placeholder="Opis oglasa" rows="3"
                          required></textarea>
                @if($errors->has('description'))
                    <div>{{ $errors->first('description') }}</div>
                @endif
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="city" placeholder="Grad" maxlength="32" required>
                    @if($errors->has('city'))
                        <div>{{ $errors->first('city') }}</div>
                    @endif
                </div>

                <div class="col-md-4">
                    <input type="text" class="form-control" name="municipality" placeholder="Opština" maxlength="32"
                           required>
                    @if($errors->has('municipality'))
                        <div>{{ $errors->first('municipality') }}</div>
                    @endif
                </div>

                <div class="col-md-4">
                    <input type="text" class="form-control" name="address" placeholder="Adresa" maxlength="64" required>
                    @if($errors->has('address'))
                        <div>{{ $errors->first('address') }}</div>
                    @endif
                </div>
            </div>


            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="map_url" placeholder="Link do nekretnine/nepokretnosti">
                    @if($errors->has('map_url'))
                        <div>{{ $errors->first('map_url') }}</div>
                    @endif
                </div>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="contact_number" placeholder="Kontakt telefon" maxlength="32">
                    @if($errors->has('contact_number'))
                        <div>{{ $errors->first('contact_number') }}</div>
                    @endif
                </div>
            </div>


            <div class="row mb-3">
                <div class="col-md-3">
                    <input type="number" class="form-control" name="price" placeholder="Cena &euro;" step="0.01" min="0"
                           required>
                    @if($errors->has('price'))
                        <div>{{ $errors->first('price') }}</div>
                    @endif
                </div>

                <div class="col-md-3">
                    <input type="number" class="form-control" name="area" placeholder="Površina (m²)" step="0.1" min="0"
                           required>
                    @if($errors->has('area'))
                        <div>{{ $errors->first('area') }}</div>
                    @endif
                </div>

                <div class="col-md-3">
                    <input type="number" class="form-control" name="floor" placeholder="Sprat" min="0">
                    @if($errors->has('floor'))
                        <div>{{ $errors->first('floor') }}</div>
                    @endif
                </div>

                <div class="col-md-3">
                    <input type="number" class="form-control" name="total_floors" placeholder="Spratnost objekta"
                           min="0">
                    @if($errors->has('total_floors'))
                        <div>{{ $errors->first('total_floors') }}</div>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <select class="form-select" name="heating_type">
                        <option disabled selected>Tip grejanja</option>
                        <option value="central">Centralno grejanje</option>
                        <option value="ta">TA</option>
                        <option value="gas">Gas</option>
                        <option value="floor">Podno</option>
                        <option value="none">Nema</option>
                    </select>
                    @if($errors->has('heating_type'))
                        <div>{{ $errors->first('heating_type') }}</div>
                    @endif
                </div>

                <div class="col-md-4">
                    <input type="number" class="form-control" name="construction_year" placeholder="Godina izgradnje"
                           min="1800" max="2100">
                    @if($errors->has('construction_year'))
                        <div>{{ $errors->first('construction_year') }}</div>
                    @endif
                </div>

                <div class="col-md-2 form-check mt-3">
                    <input type="checkbox" class="form-check-input" name="parking" id="parking" value="1">
                    <label class="form-check-label" for="parking">Parking</label>
                    @if($errors->has('parking'))
                        <div>{{ $errors->first('parking') }}</div>
                    @endif
                </div>

                <div class="col-md-2 form-check mt-3">
                    <input type="checkbox" class="form-check-input" name="furnished" id="furnished" value="1">
                    <label class="form-check-label" for="furnished">Namešten</label>
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
            <input type="hidden" name="user_id" value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">

            @if($errors->has('user_id'))
                <div>{{ $errors->first('user_id') }}</div>
            @endif

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">Dodajte oglas</button>
            </div>

        </form>
    </div>
</div>


@endsection
