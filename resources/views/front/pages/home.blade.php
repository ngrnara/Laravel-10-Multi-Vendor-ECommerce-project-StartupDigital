@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page title')
@section('content')

<!-- Home Section Start -->
<section class="home-section pt-2">
    <div class="container-fluid-lg">
        <div class="row g-4">
            <div class="col-xl-8 ratio_65">
                <div class="home-contain h-100 ">
                    <div class="h-100">
                        <img src="/front/images/home-banner-1.png" class="bg-img blur-up lazyload" alt>
                    </div>
                    <div class="home-detail p-center-left w-75">
                        <div>
                            <h1 class="text-uppercase">Beli Ikan Segar & <span class="daily">Bibit Unggul</span></h1>
                            <p class="w-75 d-none d-sm-block">SIPARI (Sistem Informasi Pasar Iwak) menghubungkan Anda langsung dengan pembudidaya ikan tawar terbaik di Kota Demak. Dapatkan produk segar, pakan berkualitas, dan bibit unggul langsung dari sumbernya.</p>
                            <button onclick="location.href = 'javascript:void(0)';"
                                class="btn btn-animation mt-xxl-4 mt-2 home-button mend-auto">Belanja Sekarang <i class="fa fa-arrow-right icon"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 ratio_65">
                <div class="row g-4">
                    <div class="col-xl-12 col-md-6">
                        <div class="home-contain">
                            <img src="/front/images/home-banner-2.png" class="bg-img blur-up lazyload" alt>
                            <div class="home-detail p-center-left home-p-sm w-75">
                                <div>
                                    <h2 class="mt-0 banner-label-color">Pakan
                                        <span class="discount text-title">&</span>
                                    </h2>
                                    <h3 class="theme-color">Alat Budidaya</h3>
                                    <p class="w-75">Sedia pelet berkualitas tinggi, kolam terpal, aerator, dan vitamin ikan.</p>
                                    <a href="javascript:void(0)" class="shop-button">Lihat Produk <i
                                            class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-md-6">
                        <div class="home-contain">
                            <img src="/front/images/home-banner-3.png" class="bg-img blur-up lazyload" alt>
                            <div class="home-detail p-center-left home-p-sm w-75">
                                <div>
                                    <h3 class="mt-0 theme-color fw-bold">Ikan Konsumsi
                                        & Olahan</h3>
                                    <h4 class="banner-label-color">Segar & Gurih</h4>
                                    <p class="organic">Lele segar, nila, gurame, patin, abon ikan premium, dan kripik kulit.</p>
                                    <a href="javascript:void(0)" class="shop-button">Lihat Produk <i
                                            class="fa fa-arrow-right"></i></a>
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

            <div class="col-xxl-9 col-xl-8">
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
                                                    <ul class="product-option">
                                                        <li title="View">
                                                            <a href="javascript:void(0)">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li title="Wishlist">
                                                            <a href="javascript:void(0)">
                                                                <i class="fa fa-heart"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
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

                                                    <div class="add-to-cart-box mt-2">
                                                        <a href="javascript:void(0)"
                                                            class="btn btn-md bg-dark cart-button text-white w-100 btn-bg-color">
                                                            <i class="fa fa-shopping-cart me-1"></i> Beli
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

                <div class="title">
                    <h2>Shop by Categories</h2>
                    <p>Condimentum magna sociis lacinia quisque porta
                        eros nulla suspendisse sollicitudin eu,
                        aliquet vehicula accumsan justo rhoncus erat
                        venenatis varius</p>
                </div>

                @if ( count(get_categories()) > 0 )
                    
               
                <div class="category-slider-2 product-wrapper no-arrow">
                    @foreach (get_categories() as $category)
                        
                    
                    <div>
                        <a href="javascript:void(0)" class="category-box">
                            <div>
                                <img src="/images/categories/{{ $category->category_image }}" class="blur-up lazyload" alt>
                                <h5>{{ $category->category_name }}</h5>
                            </div>
                        </a>
                    </div>

                    @endforeach
                </div>

                @endif

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