@extends('layout')

@section('content')
    <article class="container mt-5 d-flex justify-content-center">
        <div class="w-100" style="max-width: 1000px;">
            <!-- Naslov i osnovne informacije -->
            <div class="text-center mb-4">
                <h1 class="h4 mb-2">
                    {{ $property->title }} —
                    <span class="text-muted">{{ number_format($property->price, 0, ',', '.') }}&nbsp;&euro;</span>
                </h1>

                <h5 class="mb-0 text-secondary">
                    {{ $property->city }}, {{ $property->municipality }}, {{ $property->address }}
                    <br>
                    <a href="#map" class="ms-2"><i class="fa-solid fa-earth-africa"></i> Prikaži mapu </a>
                </h5>

                <p class="mt-1 text-muted">
                    <strong>{{ number_format($property->area, 0, ',', '.') }}m&sup2; - {{ number_format($property->price_per_square_meter, 0, ',', '.') }}&euro;/&sup2;m</strong></sup>
                </p>
            </div>

            <!-- Carousel -->
            <div id="propertyCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                {{-- Opcionalno: indicatori ako ima više slika --}}
                @if($property->images->count() > 1)
                    <div class="carousel-indicators">
                        @foreach($property->images as $i => $image)
                            <button type="button" data-bs-target="#propertyCarousel" data-bs-slide-to="{{ $i }}"
                                    class="{{ $loop->first ? 'active' : '' }}" aria-current="{{ $loop->first ? 'true' : 'false' }}"
                                    aria-label="Slide {{ $i+1 }}"></button>
                        @endforeach
                    </div>
                @endif

                <div class="carousel-inner" style="min-height:260px;">
                    @forelse($property->images as $image)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <div class="d-flex justify-content-center align-items-center" style="height: 400px;">
                                <img src="{{ asset('storage/property_images/' . $image->path) }}"
                                     class="img-fluid w-100"
                                     style="max-height: 100%; object-fit: cover;"
                                     alt="Property image {{ $loop->index + 1 }}">
                            </div>
                        </div>
                    @empty
                        <div class="carousel-item active">
                            <div class="d-flex justify-content-center align-items-center" style="height: 400px;">
                                <div class="bg-light d-flex justify-content-center align-items-center w-100" style="height:100%;">
                                    <span class="text-muted">Nema slika za prikaz</span>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>

                @if($property->images->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#propertyCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#propertyCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                @endif
            </div>

            <!-- Dodatni sadržaj (opcionalno) -->
            <div class="card p-3">
                <div class="row">
                    <div class="col-md-8">
                        <h5>Opis</h5>
                        <p class="mb-0">{{ $property->description ?? 'Nema opisa' }}</p>
                    </div>
                    <div class="col-md-4">
                        <h6>Detalji</h6>
                        <ul class="list-unstyled mb-0">
                            <li><strong><i class="fa-regular fa-square"></i> Kvadratura:</strong> {{ number_format($property->area,0,1) }} m<sup>2</sup></li>
                            <li><strong><i class="fa-solid fa-location-dot"></i> Grad:</strong> {{ $property->city }}</li>
                            <li><strong><i class="fa-solid fa-tree-city"></i> Opština:</strong> {{ $property->municipality }}</li>
                            @if($property->heating_type !== 'none')
                                <li><strong><i class="fa-solid fa-temperature-arrow-up"></i> {{ \App\Http\ShowHelper::getHeatingType($property->heating_type) }}</strong></li>
                            @endif
                            @if($property->parking == 1)
                                <li><strong><i class="fa-solid fa-square-parking"></i> Parking</strong></li>
                            @endif
                            @if($property->furnished == 1)
                                <li><strong><i class="fa-solid fa-check"></i> Namešten</strong></li>
                            @endif
                            @if(isset($property->floor) && isset($property->total_floors))
                                <li><strong><i class="fa-solid fa-city"></i> {{ $property->floor }}/{{ $property->total_floors }}</strong></li>
                            @endif
                            @if(isset($property->construction_year))
                                <li><strong><i class="fa-solid fa-person-digging"></i> Godina izgradnje: </strong>{{ $property->construction_year }}</li>
                            @endif
                            @if(isset($property->contact_number))
                                <li><strong><i class="fa-solid fa-square-phone"></i> Broj telefona: </strong><a href="tel:{{ $property->contact_number }}">{{ $property->contact_number }}</a></li>
                            @endif

                        </ul>
                    </div>


                    <iframe class="mt-4" id="map" src="{{ $property->map_url }}" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>


                </div>
            </div>
        </div>
    </article>
@endsection
