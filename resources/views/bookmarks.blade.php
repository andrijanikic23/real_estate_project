@php use App\Http\WelcomeHelper; @endphp
@extends('layout')

@section('content')

    <style>
        body {
            background-color: #f5f6f8;
        }

        .saved-card {
            border: none;
            border-radius: 14px;
            overflow: hidden;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .saved-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
        }

        .saved-img {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }

        .price {
            font-size: 1.1rem;
            font-weight: 600;
            color: #198754;
        }

        .location {
            font-size: .9rem;
            color: #6c757d;
        }

        .badge-custom {
            background-color: #eef1f5;
            color: #495057;
            font-weight: 500;
        }

        .warningText {
            font-size: 1.5rem;
        }
    </style>



    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Sačuvani oglasi</h4>
            <span class="text-muted">Ukupno: {{ count($savedAds) }}</span>
        </div>

        @if(count($savedAds) == 0)
            <p class="text-warning text-center fw-bold warningText">Nemate nijedan oglas sačuvan!</p>
        @endif
        <div class="row g-4">

            @foreach($savedAds as $ad)

                @php
                    $purpose = WelcomeHelper::adType($ad->purpose);
                @endphp

                <div class="col-xl-4 col-md-6">
                    <div class="card saved-card">

                        {{-- Slika --}}
                        @foreach($ad->images as $image)
                            <img
                                src="{{ asset('storage/property_images/'.$image->path) }}"
                                class="saved-img"
                                alt="Oglas">
                            @break
                        @endforeach

                        {{-- Sadržaj --}}
                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="price">
                                {{ number_format($ad->price, 0, ',', '.') }} €
                                @if($purpose === 'Izdavanje')
                                    <small class="text-muted">/ mesečno</small>
                                @endif
                            </span>
                                <span class="badge bg-primary-subtle text-primary">
                                {{ $purpose }}
                            </span>
                            </div>

                            <h6 class="mb-1">{{ $ad->title }}</h6>
                            <p class="location mb-3">{{ $ad->municipality }}</p>

                            <div class="d-flex gap-2 flex-wrap bd-highlight align-items-center">
                                <span class="badge badge-custom ">
                                    {{ number_format($ad->area, 0, ',', '.') }} m²
                                </span>

                                <form class="ms-auto bd-highlights" method="GET"
                                      action="{{ route('properties.show', ['property' => $ad->id]) }}">
                                    <button class="btn btn-outline-primary">
                                        Pogledaj oglas
                                    </button>
                                </form>
                                @foreach($ad->favourites as $fav)
                                    <form class="ms-auto bd-highlight text-danger" method="POST"
                                          action="{{ route('user.favourite.delete', ['favourite' => $fav->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i> Ukloni</button>
                                    </form>
                                @endforeach

                            </div>


                        </div>
                    </div>
                </div>

            @endforeach

        </div>
    </div>

@endsection
