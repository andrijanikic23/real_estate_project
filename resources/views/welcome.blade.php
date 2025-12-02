@php use App\Http\WelcomeHelper; @endphp
@extends('layout')

@section('content')

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
                                            <img src="{{ asset('storage/property_images/' . $property->images->first()->path) }}"
                                                 class="d-block w-100" style="height:200px; object-fit:cover;" alt="Property image">
                                        </div>
                                        {{-- Remaining images --}}
                                        @foreach($property->images->skip(1) as $image)
                                            <div class="carousel-item">
                                                <img src="{{ asset('storage/property_images/' . $image->path) }}"
                                                     class="d-block w-100" style="height:200px; object-fit:cover;" alt="Property image">
                                            </div>
                                        @endforeach
                                    @else
                                        {{-- Placeholder --}}
                                        <div class="carousel-item active">
                                            <img src="https://via.placeholder.com/400x200?text=No+Image"
                                                 class="d-block w-100" style="height:200px; object-fit:cover;" alt="No image">
                                        </div>
                                    @endif
                                </div>
                                {{-- Carousel controls --}}
                                @if($property->images->count() > 1)
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $property->id }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $property->id }}" data-bs-slide="next">
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
                                        {{ $property->area }} m&sup2; |
                                        {{ $property->floor }}/{{ $property->total_floors }} sprat
                                    </p>
                                    <p class="card-text">
                                        {{ WelcomeHelper::amenities($property->parking, $property->furnished) }}
                                    </p>
                                </div>

                                {{-- Price --}}
                                <div class="mt-3 mb-2">
                                    <div class="bg-success text-white text-center py-2 rounded">
                                        <h5 class="mb-0">{{ $property->price }} &euro;</h5>
                                    </div>
                                </div>

                                {{-- View Details Button --}}
                                <div class="d-grid">
                                    <a href="{{ route('properties.show', $property->id) }}" class="btn btn-primary">
                                        Pogledaj oglas
                                    </a>
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

