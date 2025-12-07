@php use App\Http\WelcomeHelper; @endphp
@extends('layout')

@section('content')

    <div class="container mt-4">
        @if(count($postedProperties) < 1)
            <p class="text-warning fw-bold text-center" style="font-size: 1.5rem">Trenutno nemate nijedan oglas objavljen</p>
        @endif
    </div>

    @foreach($postedProperties as $property)
        <div class="row mb-4 align-items-center">
            {{-- LEFT: Image / Carousel --}}
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div id="carousel{{ $property->id }}" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @if($property->images->isNotEmpty())
                                {{-- First image --}}
                                <div class="carousel-item active">
                                    <img src="{{ asset('storage/property_images/' . $property->images->first()->path) }}"
                                         class="d-block w-100" style="height:250px; object-fit:cover;" alt="Property image">
                                </div>
                                {{-- Remaining images --}}
                                @foreach($property->images->skip(1) as $image)
                                    <div class="carousel-item">
                                        <img src="{{ asset('storage/property_images/' . $image->path) }}"
                                             class="d-block w-100" style="height:250px; object-fit:cover;" alt="Property image">
                                    </div>
                                @endforeach
                            @else
                                {{-- Placeholder --}}
                                <div class="carousel-item active">
                                    <img src="https://via.placeholder.com/400x250?text=No+Image"
                                         class="d-block w-100" style="height:250px; object-fit:cover;" alt="No image">
                                </div>
                            @endif
                        </div>

                        {{-- controls only if more than 1 --}}
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
                </div>
            </div>

            {{-- RIGHT: Details --}}
            <div class="col-md-8">
                <div class="card shadow-sm h-100">
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



                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <div class="bg-success text-white text-center py-2 rounded">
                                    <h5 class="mb-0">{{ number_format($property->price, 0, ',', '.') }} &euro;</h5>
                                </div>
                            </div>

                            <div>
                                <a href="{{ route('properties.show', ['property' => $property->id]) }}" class="btn btn-outline-success">
                                    Izmenite oglas
                                </a>
                            </div>

                            <div>

                                <a data-bs-toggle="modal" data-bs-target="#deleteModal{{ $property->id }}" class="btn btn-outline-danger">
                                    Obrišite oglas
                                </a>


                                <div id="deleteModal{{ $property->id }}" class="modal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Brisanje oglasa</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Da li sigurno želite da obrišete oglas?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Otkaži</button>
                                                <form method="POST" action="{{ route('properties.destroy', ['property' => $property->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-primary">Obriši oglas</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>

                            <div>
                                <a href="{{ route('properties.show', ['property' => $property->id]) }}" class="btn btn-primary">
                                    Pogledajte vaš oglas
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> {{-- end row --}}
    @endforeach


@endsection




