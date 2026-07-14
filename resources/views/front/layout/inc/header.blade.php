<header class="shadow-lg bg-white">
    <!-- Top thin bar -->
    <div class="container-fluid-lg py-3 border-bottom">
        <div class="d-flex gap-3">
            <a href="javascript:void(0)" class="text-decoration-none text-secondary small">Tentang</a>
            <a href="javascript:void(0)" class="text-decoration-none text-secondary small">Bantuan</a>
            <a href="javascript:void(0)" class="text-decoration-none text-secondary small">FAQs</a>
        </div>
    </div>

    <!-- Main header -->
    <div class="container-fluid-lg py-3">
        <div class="row align-items-center justify-content-around g-3">
            <!-- Logo -->
            <div class="col-lg-2 col-12 d-flex align-items-center justify-content-lg-start justify-content-center">
                <a href="{{ route('home-page') }}" class="d-inline-flex align-items-center text-decoration-none">
                    <span class="fw-bold fs-4" style="color:var(--theme-color);">LAPAK</span>
                    <span class="fw-bold fs-4 text-white px-2 ms-1 rounded" style="background-color:var(--theme-color);">IKAN</span>
                </a>
            </div>

            <!-- Nav -->
            <div class="col-lg-3 col-12 d-flex justify-content-lg-start justify-content-center">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item me-3">
                        <a href="{{ route('home-page') }}" class="text-decoration-none fw-bold fs-5" style="color:var(--theme-color);">Home</a>
                    </li>
                    <li class="list-inline-item me-3">
                        <a href="javascript:void(0)" class="text-decoration-none text-dark fw-semibold fs-5">Produk</a>
                    </li>
                    <li class="list-inline-item">
                    <a href="{{ route('client.orders') }}" class="text-decoration-none text-dark fw-semibold fs-5">Transaksi</a>
                    </li>
                </ul>
            </div>

            <!-- Search -->
            <div class="col-lg-3 col-6 d-none d-lg-block">
                <form class="d-flex">
                    <div class="input-group">
                        <input type="search" class="form-control" placeholder="Search..">
                        <button class="btn text-white" style="background-color:var(--theme-color);" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>

        <!-- Mobile search -->
        <div class="row d-lg-none mt-3">
            <div class="col-12">
                <form class="d-flex">
                    <div class="input-group">
                        <input type="search" class="form-control" placeholder="Search..">
                        <button class="btn text-white" style="background-color:var(--theme-color);" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

<!-- Cart + Account -->
<div class="col-lg-3 col-6 text-end d-flex align-items-center justify-content-end">
    @auth('client')
                <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary position-relative me-2">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="badge rounded-pill" style="background-color:var(--theme-color);">
                        {{ \App\Models\CartItem::where('client_id', Auth::guard('client')->id())->count() }}
                    </span>
                </a>
                <div class="dropdown d-inline-block">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fa fa-user me-1"></i>
                        {{ Auth::guard('client')->user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form method="POST" action="{{ route('client.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('client.login') }}" class="btn rounded-pill w-50 px-3 btn-masuk" style="border:1px solid var(--theme-color); color:var(--theme-color);">Masuk</a>
                <a href="{{ route('client.register') }}" class="btn rounded-pill w-50 px-3 text-white ms-2 btn-daftar" style="background-color:var(--theme-color);">Daftar</a>
            @endauth
        </div>


    </div>
</header>
