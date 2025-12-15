@extends('layout')

@section('head')
    <style>
        .intro {
            height: 300px;
            background-image: url('/images/logo_nekretnine.png');
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
        }

        @media (max-width: 576px) {
            .intro {
                height: 200px;
            }
        }
    </style>
@endsection

@section('content')

    <header class="intro text-center mt-4">
        <h2>KONTAKT CENTAR</h2>
    </header>

    <article class="container">

        {{-- KONTAKT INFO --}}
        <div class="row text-center gy-4 mt-4">
            <div class="col-12 col-md-4">
                <p><i class="fa-solid fa-envelope fa-2xl"></i></p>
                <p>Email</p>
                <p>office@nekretnine.com</p>
            </div>

            <div class="col-12 col-md-4">
                <p><i class="fa-solid fa-location-crosshairs fa-2xl"></i></p>
                <p>Sedište</p>
                <p>
                    Bulevar Zorana Đinđića 163<br>
                    11070 Beograd, Srbija
                </p>
            </div>

            <div class="col-12 col-md-4">
                <p><i class="fa-solid fa-phone fa-2xl"></i></p>
                <p>Telefon</p>
                <p>
                    +381 61 211 1088<br>
                    011 269 9364
                </p>
            </div>
        </div>

        {{-- KONTAKT FORMA --}}
        <div class="row justify-content-center mt-5">

            @if(\Illuminate\Support\Facades\Session::has('success'))
                <div class="">
                    <h3 class="text-success fw-bold">{{ \Illuminate\Support\Facades\Session::get('success') }}</h3>
                </div>
            @endif

            <div class="col-12 col-md-8 col-lg-6">
                <h3 class="text-center mb-4">
                    Za sva pitanja možete nam se obratiti i putem kontakt formulara.
                </h3>

                <form method="POST" action="{{ route('contact.sent') }}">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-12 col-md-6 mb-3 mb-md-0">
                            <label for="name" class="form-label">Ime</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Ime" required>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="surname" class="form-label">Prezime</label>
                            <input type="text" class="form-control" id="surname" name="surname" placeholder="Prezime" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email adresa</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="ime@nekretnine.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Poruka</label>
                        <textarea class="form-control" id="message" rows="4" name="message" placeholder="Vaša poruka" required></textarea>
                    </div>

                    <button class="btn btn-info w-100" type="submit">
                        POŠALJI
                    </button>
                </form>
            </div>
        </div>

        {{-- MAPA --}}
        <div class="ratio ratio-16x9 mt-5">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5660.259221159161!2d20.41126682647086!3d44.8189241071806!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a6588d24d522f%3A0xfb3b2128cef49e8e!2zQXBhcnRtZW50MTY1LCDQkdGD0LvQtdCy0LDRgCDQl9C-0YDQsNC90LAg0ILQuNC90ZLQuNGb0LAgMTYzLCDQkdC10L7Qs9GA0LDQtCAxMTA3MA!5e0!3m2!1ssr!2srs!4v1765792235132!5m2!1ssr!2srs"
                style="border:0;"
                allowfullscreen
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

    </article>

@endsection
