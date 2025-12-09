@php use App\Http\WelcomeHelper;use Illuminate\Support\Facades\Auth; @endphp
@extends('layout')

@section('content')

    <article class="container mt-5">
        <form method="GET" action="{{ route('properties.filter') }}">

            <div class="row g-3">

                <div class="col-md-4">
                    <label for="purpose" class="form-label">Tip oglasa <i class="fa-solid fa-rectangle-ad"></i></label>
                    <select class="form-select" id="purpose" name="purpose">
                        <option value="" selected disabled >Izaberite tip oglasa</option>
                        <option value="sale">Prodaja</option>
                        <option value="rent">Izdavanje</option>
                    </select>
                </div>
                <!-- Prvi red: Tip objekta + Grad -->

                <div class="col-md-4">
                    <label for="property_type" class="form-label">Tip objekta <i class="fa-solid fa-house"></i></label>
                    <select class="form-select" id="property_type" name="property_type">
                        <option disabled {{ old('property_type') ? '' : 'selected' }} value="">Izaberi tip objekta</option>

                        <option value="apartment" @selected(old('property_type') == 'apartment')>Stan</option>
                        <option value="house" @selected(old('property_type') == 'house')>Kuća</option>

                        <option value="commercial space" @selected(old('property_type') == 'commercial space')>
                            Poslovni prostor
                        </option>

                        <option value="construction land" @selected(old('property_type') == 'construction land')>
                            Građevinsko zemljište
                        </option>
                        <option value="agricultural land" @selected(old('property_type') == 'agricultural land')}>
                            Poljoprivredno zemljište
                        </option>
                        <option value="holiday cottage" @selected(old('property_type') == 'holiday cottage')}>
                            Vikendica
                        </option>
                        <option value="warehouse" @selected(old('property_type') == 'warehouse')>
                            Magacin
                        </option>
                    </select>

                @if($errors->has('property_type'))
                        <div class="text-danger mt-1">{{ $errors->first('property_type') }}</div>
                    @endif
                </div>

                <div class="col-md-4">
                    <label for="city" class="form-label">Grad <i class="fa-solid fa-location-dot"></i></label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Grad" maxlength="32"
                           value="{{ old('city') }}">
                    @if($errors->has('city'))
                        <div class="text-danger mt-1">{{ $errors->first('city') }}</div>
                    @endif
                </div>

                <!-- Drugi red: Cena od, Cena do, Cena po m² od, Cena po m² do -->
                <div class="col-md-3">
                    <label for="price_from" class="form-label">Cena od (€)</label>
                    <input type="number" class="form-control" id="price_from" name="price_from" placeholder="0" value="{{ old('price_from') }}"
                           value="{{ old('price_from') }}">
                </div>

                <div class="col-md-3">
                    <label for="price_to" class="form-label">Cena do (€)</label>
                    <input type="number" class="form-control" id="price_to" name="price_to" placeholder="0" value="{{ old('price_to') }}"
                           value="{{ old('price_to') }}">
                </div>

                <div class="col-md-3">
                    <label for="price_per_m2_from" class="form-label">Cena po m² od (€)</label>
                    <input type="number" class="form-control" id="price_per_m2_from" name="price_per_m2_from" value="{{ old('price_per_m2_from') }}"
                           placeholder="0" value="{{ old('price_per_m2_from') }}">
                </div>

                <div class="col-md-3">
                    <label for="price_per_m2_to" class="form-label">Cena po m² do (€)</label>
                    <input type="number" class="form-control" id="price_per_m2_to" name="price_per_m2_to" value="{{ old('price_per_m2_to') }}"
                           placeholder="0" value="{{ old('price_per_m2_to') }}">
                </div>

                <!-- Dugme za slanje -->
                <div class="col-12 mt-3">
                    <button type="submit" class="btn btn-primary">Traži <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
        </form>
    </article>

    <div class="container mt-4">
        @if(count($properties) == 0)
            <p class="text-warning fw-bold text-center" style="font-size: 1.5rem">Trenutno nema oglasa za odabrane parametre</p>
        @endif
    </div>

    <div class="container mt-4">
        @if(\Illuminate\Support\Facades\Session::has('like'))
            <p class="text-success fw-bold" style="font-size: 1.5rem">{{ \Illuminate\Support\Facades\Session::get('like') }}</p>
        @elseif(\Illuminate\Support\Facades\Session::has('unlike'))
            <p class="text-success fw-bold" style="font-size: 1.5rem">{{ \Illuminate\Support\Facades\Session::get('unlike') }}</p>
        @endif
    </div>


    <article class="mt-5">
        <div class="container">
            <div class="row g-4">
                @foreach($properties as $property)
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            {{-- Carousel --}}
                            <div id="carousel{{ $property->id }}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @if($property->images->isNotEmpty())
                                        {{-- First image --}}
                                        <div class="carousel-item active">
                                            <img
                                                src="{{ asset('storage/property_images/' . $property->images->first()->path) }}"
                                                class="d-block w-100" style="height:200px; object-fit:cover;"
                                                alt="Property image">
                                        </div>
                                        {{-- Remaining images --}}
                                        @foreach($property->images->skip(1) as $image)
                                            <div class="carousel-item">
                                                <img src="{{ asset('storage/property_images/' . $image->path) }}"
                                                     class="d-block w-100" style="height:200px; object-fit:cover;"
                                                     alt="Property image">
                                            </div>
                                        @endforeach
                                    @else
                                        {{-- Placeholder --}}
                                        <div class="carousel-item active">
                                            <img src="https://via.placeholder.com/400x200?text=No+Image"
                                                 class="d-block w-100" style="height:200px; object-fit:cover;"
                                                 alt="No image">
                                        </div>
                                    @endif
                                </div>
                                {{-- Carousel controls --}}
                                @if($property->images->count() > 1)
                                    <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carousel{{ $property->id }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                            data-bs-target="#carousel{{ $property->id }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                @endif
                            </div>

                            {{-- Card body --}}
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title">{{ $property->title }}</h5>
                                    <p class="card-text text-secondary mb-1">
                                        {{ $property->city }}, {{ $property->municipality }}, {{ $property->address }}
                                    </p>
                                    <p class="card-text mb-1">
                                        {{ WelcomeHelper::propertyType($property->property_type) }} |
                                        {{ number_format($property->area, 0, ',', '.') }}m&sup2; |
                                        {{ $property->price_per_square_meter }}&euro;/m&sup2; |
                                        {{ $property->floor }}/{{ $property->total_floors }} sprat
                                    </p>
                                    <p class="card-text">
                                        {{ WelcomeHelper::amenities($property->parking, $property->furnished) }}
                                    </p>
                                </div>

                                {{-- Price --}}
                                <div class="mt-3 mb-2">
                                    <div class="bg-success text-white text-center py-2 rounded">
                                        <h5 class="mb-0">{{ number_format($property->price, 0, ',', '.') }} &euro;</h5>
                                    </div>
                                </div>

                                {{-- View Details Button --}}
                                <div class="d-grid">
                                    <a href="{{ route('properties.show',['property' => $property->id]) }}" class="btn btn-primary">
                                        Pogledaj oglas
                                    </a>
                                </div>

                                <div class="d-flex justify-content-evenly mt-3">
                                    <a href="tel:{{ $property->contact_number }}" class="btn btn-outline-primary"><i class="fa-solid fa-phone-volume fa-xl"></i></a>

                                    <a href="{{ $property->map_url }}" class="btn btn-outline-primary"><i
                                            class="fa-solid fa-map-location fa-xl"></i> </a>

                                    @auth
                                        <form method="POST" action="{{ route('properties.bookmark') }}">
                                            @csrf
                                            <input name="propertyId" type="hidden" value="{{ $property->id }}">
                                            <input name="icon" type="hidden" value="{{ $bookmarkType = WelcomeHelper::bookmark($property->favourites) }}">
                                            <button class="btn btn-outline-primary"><i class="fa-{{ $bookmarkType = WelcomeHelper::bookmark($property->favourites) }} fa-bookmark"></i></button>
                                        </form>
                                    @endauth




{{--                                    @foreach($property->favourites as $userLike)--}}
{{--                                        @if($userLike->user_id == Auth::id())--}}
{{--                                            <a href="{{ route('properties.favourite', ['propertyId' => $property->id]) }}"><i--}}
{{--                                                    class="fa-solid fa-bookmark fa-xl"></i></a>--}}
{{--                                        @endif--}}
{{--                                    @endforeach--}}


                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </article>

    {{-- Optional CSS for spacing --}}
    <style>
        .card-body p {
            margin-bottom: 0.4rem;
            font-size: 0.9rem;
        }
    </style>

@endsection

