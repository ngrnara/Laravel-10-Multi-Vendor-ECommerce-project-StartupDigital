@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page title')
@section('content')

<!-- Home Section Start -->
<section class="home-section pt-2">
    <div class="container-fluid-lg">
        <div class="row g-4">
        {{-- ================= HERO UTAMA ================= --}}
            <div class="col-xl-8 ratio_65">
                <div class="home-contain h-100">
                    {{-- Slider 3 gambar - MINIMAL, cuma buat geser otomatis --}}
                    <div class="hero-slider" id="heroSlider">
                        <div class="hero-slide active">
                            <img src="/images/Home/bibit_ikan_gurame.jpg" class="bg-img blur-up lazyload" alt="Ikan segar dan bibit unggul SIPARI">
                        </div>
                        <div class="hero-slide">
                            <img src="/images/Home/bibit_ikan_nila.jpg" class="bg-img blur-up lazyload" alt="Ikan segar dan bibit unggul SIPARI">
                        </div>
                        <div class="hero-slide">
                            <img src="/images/Home/ikan_segar.jpg" class="bg-img blur-up lazyload" alt="Ikan segar dan bibit unggul SIPARI">
                        </div>
                    </div>

<script>
    (function () {
        const slides = document.querySelectorAll('#heroSlider .hero-slide');
        let current = 0;

        setInterval(function () {
            slides[current].classList.remove('active');
            current = (current + 1) % slides.length;
            slides[current].classList.add('active');
        }, 3000);
    })();
</script>

        {{-- ================= TEKS OVERLAY (tetap di atas slider) ================= --}}
        <div class="home-detail p-center-left w-75 ">
            <div style="background-color: rgba(0, 0, 0, 0.2);">
                <h1 class="text-uppercase text-light">Beli Ikan Segar & <span class="daily">Bibit Unggul</span></h1>
                <p class="w-75 d-none d-sm-block text-light">
                    SIPARI (Sistem Informasi Pasar Iwak) menghubungkan Anda langsung dengan petani ikan air tawar, tanpa perantara tengkulak. Jual beli ikan, bibit, dan pakan jadi lebih mudah dan harga lebih menguntungkan kedua belah pihak.
                </p>
                <button onclick="location.href = '{{ route('lapak-ikan') }}';"
                    class="btn btn-animation mt-xxl-4 mt-2 home-button mend-auto">Belanja Sekarang <i class="fa fa-arrow-right icon"></i></button>
            </div>
        </div>
    </div>
</div>

            {{-- ================= 2 BANNER KANAN ================= --}}
            <div class="col-xl-4 ratio_65">
                <div class="row g-4">

                    {{-- Banner Bibit & Pakan Ikan --}}
<div class="col-xl-12 col-md-6">

    <div class="home-contain">

        <img src="/images/Home/bibit_ikan_nila.jpg" class="bg-img blur-up lazyload" alt="Bibit dan pakan ikan">

        <div class="home-detail p-center-left home-p-sm w-75">

            <div>

                <h2 class="mt-0 banner-label-color">Bibit

                    <span class="discount text-title">&</span>

                </h2>

                <h3 class="theme-color">Pakan Ikan</h3>

                <p class="w-75">Bibit unggul dan pakan berkualitas langsung dari petani ikan air tawar terpercaya.</p>

                <a href="#new-arrivals" class="shop-button">Lihat Produk <i class="fa fa-arrow-right"></i></a>

            </div>

        </div>

    </div>

</div>

                    {{-- Banner Katalog & Hasil Panen --}}
<div class="col-xl-12 col-md-6">
    <div class="home-contain">
        <img src="/images/Home/ikan_segar.jpg" class="bg-img blur-up lazyload" alt="Katalog dan hasil panen ikan">
        <div class="home-detail p-center-left home-p-sm w-75">
            <div>
                <h3 class="mt-0 theme-color fw-bold">Katalog & Hasil Panen</h3>
                <h4 class="banner-label-color">Langsung dari Petani</h4>
                <p class="organic">Pantau harga jual dan hasil panen ikan air tawar terbaru, langsung dari petani ke pembeli.</p>
                <a href="#kategori-ikan" class="shop-button">Lihat Produk <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Home Section End -->

 <!-- Product Section Start -->
 <section class="product-section">
    <div class="container-fluid-lg">
        <div class="row g-sm-4 g-3">
            <div class="col-xxl-3 col-xl-4 d-none d-xl-block">
                <div class="p-sticky">
                    <div class="category-menu">
                        <h3>Category</h3>
                        @if ( count(get_categories()) > 0 )


                        <ul>
                            @foreach (get_categories() as $category)


                            <li>
                                <div class="category-list">
                                    <img src="/images/categories/{{ $category->category_image }}" class="blur-up lazyload" alt>
                                    <h5>
                                        <a href="javascript:void(0)">{{ $category->category_name }}</a>
                                    </h5>
                                </div>
                            </li>
                            @endforeach
                        </ul>

                        @endif

                    </div>

                    <div class="section-t-space">
                        <div class="category-menu">
                            <h3>Produk Terpopuler</h3>

                            <ul class="product-list border-0 p-0 d-block">
                                @if(count($products) > 0)
                                    @foreach($products->take(4) as $product)
                                    <li>
                                        <div class="offer-product">
                                            <a href="javascript:void(0)" class="offer-image">
                                                <img src="/images/products/{{ $product->product_image }}"
                                                    class="blur-up lazyload" alt="{{ $product->name }}" style="object-fit: cover; width: 70px; height: 70px;">
                                            </a>

                                            <div class="offer-detail">
                                                <div>
                                                    <a href="javascript:void(0)" class="text-title">
                                                        <h6 class="name" style="font-weight: 600; line-height: 1.3;">{{ $product->name }}</h6>
                                                    </a>
                                                    <span>{{ $product->subcategory_relation->subcategory_name ?? 'Ikan' }}</span>
                                                    <h6 class="price theme-color">Rp {{ number_format($product->price, 0, ',', '.') }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                @else
                                    <li class="text-muted small p-3">Belum ada produk terpopuler.</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-9 col-xl-8" id="new-arrivals">
                <div class="title title-flex">
                    <div>
                        <h2>New Arrivals</h2>
                        <p>Ignissimos reprehenderit repellendus nobis
                            error quibusdam? Atque animi sint unde quis
                            reprehenderi</p>
                    </div>
                </div>

                <div class="section-b-space">
                    <div class="product-border border-row overflow-hidden">
                        <div class="product-box-slider no-arrow">
                            @if(count($products) > 0)
                                @foreach($products as $product)
                                <div>
                                    <div class="row m-0">
                                        <div class="col-12 px-0">
                                            <div class="product-box">
                                                <div class="product-image">
                                                    <a href="javascript:void(0)">
                                                        <img src="/images/products/{{ $product->product_image }}"
                                                            class="img-fluid blur-up lazyload" alt="{{ $product->name }}" style="object-fit: cover; width: 100%; height: 200px;">
                                                    </a>
                                                </div>
                                                <div class="product-detail">
                                                    <a href="javascript:void(0)">
                                                        <h6 class="name" style="height: 40px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; line-height: 1.3; font-weight: 600;">
                                                            {{ $product->name }}
                                                        </h6>
                                                    </a>

                                                    <h5 class="sold text-content">
                                                        <span class="theme-color price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                                        @if($product->compare_price)
                                                            <del>Rp {{ number_format($product->compare_price, 0, ',', '.') }}</del>
                                                        @endif
                                                    </h5>

                                                    <div class="product-rating mt-2">
                                                        <ul class="rating">
                                                            @for($i = 0; $i < 5; $i++)
                                                                <li><i class="fa fa-star rating-color"></i></li>
                                                            @endfor
                                                        </ul>
                                                        <h6 class="theme-color instock">Stok Tersedia</h6>
                                                    </div>

                                                    <div class="add-to-cart-box mt-2 d-flex gap-2">
                                                        <form method="POST" action="{{ route('cart.add', $product->id) }}" class="flex-shrink-0">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-outline-success btn-cart-add" style="border: 2px solid var(--theme-color); color:var(--theme-color);" title="Tambah ke Keranjang">
                                                                <i class="fa fa-cart-plus"></i>
                                                            </button>
                                                        </form>
                                                        <a href="{{ route('client.checkout.index', $product->id) }}"
                                                            class="btn text-white flex-grow-1 btn-beli">
                                                            <i class="fa fa-bolt me-1"></i> Beli
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <p class="text-muted text-center py-4">Belum ada produk baru.</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- ================= KATEGORI IKAN (otomatis dari folder public/images/products) ================= --}}
@php
    $productFolder = public_path('images/products');
    $categoryImages = [];

    if (is_dir($productFolder)) {
        $allFiles = scandir($productFolder);
        $allowedExt = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

        foreach ($allFiles as $file) {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (in_array($ext, $allowedExt)) {
                $categoryImages[] = $file;
            }
        }

        sort($categoryImages); // urut abjad
    }
@endphp

<section class="category-section pt-1 pb-4" id="kategori-ikan">
    <div class="container-fluid-lg category-container">

        <div class="title">
            <h2>Kategori Ikan</h2>
        </div>

        <div class="row g-3 mt-1">
            @forelse ($categoryImages as $image)
                @php
                    $filename = pathinfo($image, PATHINFO_FILENAME); // contoh: ikan_bawal
                    $categoryName = ucwords(str_replace(['_', '-'], ' ', $filename)); // contoh: Ikan Bawal
                @endphp

                <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                    <a href="#" class="category-card">
                        <div class="category-img">
                            <img src="{{ asset('images/products/' . $image) }}" alt="{{ $categoryName }}">
                        </div>
                        <span class="category-name">{{ $categoryName }}</span>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted">Belum ada gambar di folder public/images/products.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

                <div class="title d-block">
                    <h2>Our Best Seller</h2>
                    <p>Fusce natoque scelerisque luctus arcu lobortis
                        ultricies ullamcorper ante dictumst, cum eros
                        vitae curabitur hendrerit habitant rhoncus id
                        tellus in</p>
                </div>

                <div class="product-border overflow-hidden wow fadeInUp">
                    <div class="product-box-slider no-arrow">
                        <div>
                            <div class="row m-0">
                                <div class="col-12 px-0">
                                    <div class="product-box">
                                        <div class="product-image">
                                            <a href="product-detail.html">
                                                <img src="/front/images/product img place holder 1.png"
                                                    class="img-fluid blur-up lazyload" alt>
                                            </a>
                                            <ul class="product-option">
                                                <li title="View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#view">
                                                        <i class="ijaboIcon sx-1 dw dw-eye"></i>
                                                    </a>
                                                </li>

                                                <li title="Compare">
                                                    <a href="compare.html">
                                                        <i class="icon-copy dw dw-exchange"></i>
                                                    </a>
                                                </li>

                                                <li title="Wishlist">
                                                    <a href="wishlist.html" class="notifi-wishlist">
                                                        <i class="ijaboIcon sx-1 dw dw-heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="product-detail">
                                            <a href="product-detail.html">
                                                <h6 class="name h-100">Condimentum
                                                    magna sociis lacinia
                                                    quisque
                                                    porta eros
                                                    nulla</h6>
                                            </a>

                                            <h5 class="sold text-content">
                                                <span class="theme-color price">$33.19</span>
                                                <del>46.66</del>
                                            </h5>

                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    <li>
                                                        <i class="fa fa-star rating-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-star rating-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-star rating-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-star rating-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-star no-rating-color"></i>
                                                    </li>
                                                </ul>

                                                <h6 class="theme-color">In
                                                    Stock</h6>
                                            </div>

                                            <div class="add-to-cart-box mt-2">
                                                <a href="cart.html"
                                                    class=" btn-add-cart btn btn-md bg-dark cart-button text-white w-100 btn-bg-color"><i
                                                        class="icon-copy bi bi-cart-plus-fill"></i>
                                                    Add ToCart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="row m-0">
                                <div class="col-12 px-0">
                                    <div class="product-box">
                                        <div class="product-image">
                                            <a href="product-detail.html">
                                                <img src="/front/images/product img place holder 1.png"
                                                    class="img-fluid blur-up lazyload" alt>
                                            </a>
                                            <ul class="product-option">
                                                <li title="View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#view">
                                                        <i class="ijaboIcon sx-1 dw dw-eye"></i>
                                                    </a>
                                                </li>

                                                <li title="Compare">
                                                    <a href="compare.html">
                                                        <i class="icon-copy dw dw-exchange"></i>
                                                    </a>
                                                </li>

                                                <li title="Wishlist">
                                                    <a href="wishlist.html" class="notifi-wishlist">
                                                        <i class="ijaboIcon sx-1 dw dw-heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="product-detail">
                                            <a href="product-detail.html">
                                                <h6 class="name h-100">Fusce
                                                    natoque scelerisque
                                                    luctus arcu
                                                    lobortis ultricies
                                                    ullamcorper</h6>
                                            </a>

                                            <h5 class="sold text-content">
                                                <span class="theme-color price">$26.69</span>
                                                <del>28.56</del>
                                            </h5>

                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    <li>
                                                        <i class="fa fa-star rating-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-star rating-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-star rating-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-star rating-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-star no-rating-color"></i>
                                                    </li>
                                                </ul>

                                                <h6 class="theme-color">In
                                                    Stock</h6>
                                            </div>

                                            <div class="add-to-cart-box mt-2">
                                                <a href="cart.html"
                                                    class="btn btn-md bg-dark cart-button text-white w-100 btn-bg-color"><i
                                                        class="icon-copy bi bi-cart-plus-fill"></i>
                                                    Add To
                                                    Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="row m-0">
                                <div class="col-12 px-0">
                                    <div class="product-box">
                                        <div class="product-image">
                                            <a href="product-detail.html">
                                                <img src="/front/images/product img place holder 1.png"
                                                    class="img-fluid blur-up lazyload" alt>
                                            </a>
                                            <ul class="product-option">
                                                <li title="View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#view">
                                                        <i class="ijaboIcon sx-1 dw dw-eye"></i>
                                                    </a>
                                                </li>

                                                <li title="Compare">
                                                    <a href="compare.html">
                                                        <i class="icon-copy dw dw-exchange"></i>
                                                    </a>
                                                </li>

                                                <li title="Wishlist">
                                                    <a href="wishlist.html" class="notifi-wishlist">
                                                        <i class="ijaboIcon sx-1 dw dw-heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="product-detail">
                                            <a href="product-detail.html">
                                                <h6 class="name h-100">Inceptos
                                                    urna maecenas tempus
                                                    praesent tempor
                                                    porta tellus dui
                                                    fermentum</h6>
                                            </a>

                                            <h5 class="sold text-content">
                                                <span class="theme-color price">$116.69</span>
                                                <del>228.56</del>
                                            </h5>

                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    <li>
                                                        <i class="fa fa-star rating-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-star rating-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-star rating-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-star rating-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-star no-rating-color"></i>
                                                    </li>
                                                </ul>

                                                <h6 class="theme-color">In
                                                    Stock</h6>
                                            </div>

                                            <div class="add-to-cart-box mt-2">
                                                <a href="cart.html"
                                                    class="btn btn-md bg-dark cart-button text-white w-100 btn-bg-color"><i
                                                        class="icon-copy bi bi-cart-plus-fill"></i>
                                                    Add To
                                                    Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="row m-0">
                                <div class="col-12 px-0">
                                    <div class="product-box">
                                        <div class="product-image">
                                            <a href="product-detail.html">
                                                <img src="/front/images/product img place holder 1.png"
                                                    class="img-fluid blur-up lazyload" alt>
                                            </a>
                                            <ul class="product-option">
                                                <li title="View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#view">
                                                        <i class="ijaboIcon sx-1 dw dw-eye"></i>
                                                    </a>
                                                </li>

                                                <li title="Compare">
                                                    <a href="compare.html">
                                                        <i class="icon-copy dw dw-exchange"></i>
                                                    </a>
                                                </li>

                                                <li title="Wishlist">
                                                    <a href="wishlist.html" class="notifi-wishlist">
                                                        <i class="ijaboIcon sx-1 dw dw-heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="product-detail">
                                            <a href="product-detail.html">
                                                <h6 class="name h-100">Nullam
                                                    tincidunt vitae per
                                                    malesuada dapibus
                                                    hendrerit odio.</h6>
                                            </a>

                                            <h5 class="sold text-content">
                                                <span class="theme-color price">$76.79</span>
                                                <del>87.56</del>
                                            </h5>

                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    <li>
                                                        <i class="fa fa-star rating-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-star rating-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-star rating-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-star rating-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-star no-rating-color"></i>
                                                    </li>
                                                </ul>

                                                <h6 class="theme-color">In
                                                    Stock</h6>
                                            </div>

                                            <div class="add-to-cart-box mt-2">
                                                <a href="cart.html"
                                                    class="btn btn-md bg-dark cart-button text-white w-100 btn-bg-color"><i
                                                        class="icon-copy bi bi-cart-plus-fill"></i>
                                                    Add To
                                                    Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="row m-0">
                                <div class="col-12 px-0">
                                    <div class="product-box">
                                        <div class="product-image">
                                            <a href="product-detail.html">
                                                <img src="/front/images/product img place holder 1.png"
                                                    class="img-fluid blur-up lazyload" alt>
                                            </a>
                                            <ul class="product-option">
                                                <li title="View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#view">
                                                        <i class="ijaboIcon sx-1 dw dw-eye"></i>
                                                    </a>
                                                </li>

                                                <li title="Compare">
                                                    <a href="compare.html">
                                                        <i class="icon-copy dw dw-exchange"></i>
                                                    </a>
                                                </li>

                                                <li title="Wishlist">
                                                    <a href="wishlist.html" class="notifi-wishlist">
                                                        <i class="ijaboIcon sx-1 dw dw-heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="product-detail">
                                            <a href="product-detail.html">
                                                <h6 class="name h-100">Nibh
                                                    pretium fringilla
                                                    vulputate gravida
                                                    dictumst mi</h6>
                                            </a>

                                            <h5 class="sold text-content">
                                                <span class="theme-color price">$36.69</span>
                                                <del>68.56</del>
                                            </h5>

                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    <li>
                                                        <i class="fa fa-star rating-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-star rating-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-star rating-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-star rating-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-star no-rating-color"></i>
                                                    </li>
                                                </ul>

                                                <h6 class="theme-color">In
                                                    Stock</h6>
                                            </div>

                                            <div class="add-to-cart-box mt-2">
                                                <a href="cart.html"
                                                    class="btn btn-md bg-dark cart-button text-white w-100 btn-bg-color"><i
                                                        class="icon-copy bi bi-cart-plus-fill"></i>
                                                    Add To
                                                    Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="row m-0">
                                <div class="col-12 px-0">
                                    <div class="product-box">
                                        <div class="product-image">
                                            <a href="product-detail.html">
                                                <img src="/front/images/product img place holder 1.png"
                                                    class="img-fluid blur-up lazyload" alt>
                                            </a>
                                            <ul class="product-option">
                                                <li title="View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#view">
                                                        <i class="ijaboIcon sx-1 dw dw-eye"></i>
                                                    </a>
                                                </li>

                                                <li title="Compare">
                                                    <a href="compare.html">
                                                        <i class="icon-copy dw dw-exchange"></i>
                                                    </a>
                                                </li>

                                                <li title="Wishlist">
                                                    <a href="wishlist.html" class="notifi-wishlist">
                                                        <i class="ijaboIcon sx-1 dw dw-heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="product-detail">
                                            <a href="product-detail.html">
                                                <h6 class="name h-100">Quam
                                                    mus habitant congue
                                                    rhoncus tristique
                                                </h6>
                                            </a>

                                            <h5 class="sold text-content">
                                                <span class="theme-color price">$26.69</span>
                                                <del>28.56</del>
                                            </h5>

                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    <li>
                                                        <i class="fa fa-star rating-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-star rating-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-star rating-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-star rating-color"></i>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-star no-rating-color"></i>
                                                    </li>
                                                </ul>

                                                <h6 class="theme-color">In
                                                    Stock</h6>
                                            </div>

                                            <div class="add-to-cart-box mt-2">
                                                <a href="cart.html"
                                                    class="btn btn-md bg-dark cart-button text-white w-100 btn-bg-color"><i
                                                        class="icon-copy bi bi-cart-plus-fill"></i>
                                                    Add To
                                                    Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section-t-space">
                    <div class="banner-contain hover-effect">
                        <img src="/front/images/b.png" class="bg-img blur-up lazyload" alt>
                        <div class="banner-details p-center banner-b-space w-100 text-center">
                            <div>
                                <h6 class="ls-expanded theme-color mb-sm-3 mb-1">OUR
                                    BEST</h6>
                                <h2 class="banner-title">ELECTRONICS</h2>
                                <h5 class="lh-sm mx-auto mt-1 text-content">SALE
                                    8% OFF</h5>
                                <button onclick="location.href = 'javascript:void(0)';"
                                    class="btn btn-animation btn-sm mx-auto mt-sm-3 mt-2">Shop
                                    Now <i class="fa fa-arrow-right icon"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="title section-t-space">
                    <h2>Latest on Blog</h2>
                    <p>Quam mus habitant congue rhoncus tristique, neque
                        cum magnis eros pretium per, inceptos eget
                        integer netus. Ante vehicula euismod etiam at
                        congue proin aenean mattis sed sociis fames
                        mauris arcu enim</p>
                </div>

                <div class="slider-3-blog ratio_65 no-arrow product-wrapper mb-4">
                    <div>
                        <div class="blog-box">
                            <div class="blog-box-image">
                                <a href="blog-detail.html" class="blog-image">
                                    <img src="/front/images/blog-image-1.png" class="bg-img blur-up lazyload" alt>
                                </a>
                            </div>

                            <a href="blog-detail.html" class="blog-detail">
                                <h6>13 Jun, 2024</h6>
                                <h5>Proin primis et phasellus nisi
                                    ultrices maecenas enim potenti
                                    vestibulum
                                    praesent vulputate</h5>
                            </a>
                        </div>
                    </div>

                    <div>
                        <div class="blog-box">
                            <div class="blog-box-image">
                                <a href="blog-detail.html" class="blog-image">
                                    <img src="/front/images/blog-image-1.png" class="bg-img blur-up lazyload" alt>
                                </a>
                            </div>

                            <a href="blog-detail.html" class="blog-detail">
                                <h6>10 March, 2024</h6>
                                <h5>Blandit consequat condimentum aenean
                                    mattis himenaeos purus venenatis
                                    auctor
                                    tellus</h5>
                            </a>
                        </div>
                    </div>

                    <div>
                        <div class="blog-box">
                            <div class="blog-box-image">
                                <a href="blog-detail.html" class="blog-image">
                                    <img src="/front/images/blog-image-1.png" class="bg-img blur-up lazyload" alt>
                                </a>
                            </div>

                            <a href="blog-detail.html" class="blog-detail">
                                <h6>10 April, 2024</h6>
                                <h5>Montes tellus turpis integer semper
                                    leo per lacinia quam euismod
                                    senectus</h5>
                            </a>
                        </div>
                    </div>

                    <div>
                        <div class="blog-box">
                            <div class="blog-box-image">
                                <a href="blog-detail.html" class="blog-image">
                                    <img src="/front/images/blog-image-1.png" class="bg-img blur-up lazyload" alt>
                                </a>
                            </div>

                            <a href="blog-detail.html" class="blog-detail">
                                <h6>20 March, 2024</h6>
                                <h5>ullamcorper ligula erat platea fusce
                                    pharetra proin volutpat a massa
                                    ac</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->

@endsection
