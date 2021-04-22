<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img class="d-inline-block me-2" src="/img/car-logo.png" alt="logo">
            CaRent
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav w-100 mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" aria-current="page"
                        href="{{ route('home') }}">
                        Početna
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['cars.index', 'cars.create', 'cars.edit', 'cars.show']) ? 'active' : '' }}"
                        href="{{ route('cars.index') }}">
                        Vozila
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('clients*') ? 'active' : '' }}"
                        href="{{ route('clients.index') }}">
                        Klijenti
                    </a>
                </li>
                <li class="nav-item me-auto">
                    <a class="nav-link {{ request()->routeIs(['reservations.create', 'cars.select']) ? 'active' : '' }}"
                        href="{{ route('reservations.create') }}">
                        Napravi rezervaciju
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a class="dropdown-item" href="route('logout')" onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log out') }}
                                </a>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>