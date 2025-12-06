<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #9adaed;">
    <div class="container-fluid d-flex align-items-center">

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center me-1" href="{{ route('properties.index') }}">
            <img src="{{ asset('/images/logo_nekretnine.png') }}" alt="Logo" width="60" height="60">
        </a>


        <!-- Collapse (meni) - odmah posle logotipa -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0 d-flex flex-row align-items-center">
                <li class="nav-item dropdown me-2">
                    <a class="nav-link dropdown-toggle fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        Prodaja
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('properties.index') }}">Svi oglasi</a></li>
                        <li><a class="dropdown-item" href="{{ route('properties.filter', ['property_type' => 'apartment', 'city' => 'Beograd']) }}">Stanovi u Beogradu</a></li>
                        <li><a class="dropdown-item" href="{{ route('properties.filter', ['property_type' => 'house', 'city' => 'Beograd']) }}">Kuće u Beogradu</a></li>
                        <li><a class="dropdown-item" href="{{ route('properties.filter', ['property_type' => 'construction land', 'city' => 'Beograd']) }}">Građevinsko zemljište u Beogradu</a></li>
                        <li><a class="dropdown-item" href="{{ route('properties.filter', ['property_type' => 'agricultural land', 'city' => 'Beograd']) }}">Poljoprivredno zemljište u Beogradu</a></li>
                        <li><a class="dropdown-item" href="{{ route('properties.filter', ['property_type' => 'commercial space']) }}">Poslovni prostori</a></li>
                        <li><a class="dropdown-item" href="{{ route('properties.filter', ['property_type' => 'warehouse']) }}">Magacini</a></li>
                        <li><a class="dropdown-item" href="{{ route('properties.filter', ['property_type' => 'holiday cottage']) }}">Vikendice</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown me-2">
                    <a class="nav-link dropdown-toggle fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        Izdavanje
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Akcija</a></li>
                        <li><a class="dropdown-item" href="#">Još jedna akcija</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Nešto drugo</a></li>
                    </ul>
                </li>
                <li class="nav-item me-2">
                    <a href="{{ route('properties.create') }}" class="nav-link fw-bold" tabindex="-1" aria-disabled="true">Novi oglas</a>
                </li>

                <li class="nav-item me-2">
                    <a href="{{ route('properties.create') }}" class="nav-link fw-bold" tabindex="-1" aria-disabled="true">Kontakt</a>
                </li>
            </ul>
        </div>

        <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0 d-flex align-items-center">
                <li class="nav-item me-2 p-2 bd-highlight">
                    <a href="" class="nav-link fw-bold" tabindex="-1" aria-disabled="true"><i class="fa-solid fa-bookmark"></i></a>
                </li>
                <li>
                <li class="nav-item me-2 p-2 bd-highlight">
                    <a href="{{ route('profile.edit') }}" class="nav-link fw-bold" tabindex="-1" aria-disabled="true"><i class="fa-solid fa-user"></i></a>
                </li>
                </li>
            </ul>
        </div>



        <!-- Hamburger (stavljen na kraj i pomeren desno) -->
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    </div>
</nav>
