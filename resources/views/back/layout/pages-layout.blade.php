<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>@yield('pageTitle')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link
            rel="icon"
            type="image/png"
            sizes="16x16"
            href="/images/site/{{ get_settings()->site_favicon }}"
        />

        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, maximum-scale=1"
        />

        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
            rel="stylesheet"
        />
        <link rel="stylesheet" type="text/css" href="/back/vendors/styles/core.css" />
        <link
            rel="stylesheet"
            type="text/css"
            href="/back/vendors/styles/icon-font.min.css"
        />
        <link rel="stylesheet" type="text/css" href="/back/vendors/styles/style.css" />

        <script>
            (function (w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({ "gtm.start": new Date().getTime(), event: "gtm.js" });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != "dataLayer" ? "&l=" + l : "";
                j.async = true;
                j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, "script", "dataLayer", "GTM-NXZMQSS");
        </script>
        <link rel="stylesheet" href="/extra-assets/ijabo/ijabo.min.css">
        <link rel="stylesheet" href="/extra-assets/ijaboCropTool/ijaboCropTool.min.css">
        <link rel="stylesheet" href="/extra-assets/jquery-ui-1.13.2/jquery-ui.min.css">
        <link rel="stylesheet" href="/extra-assets/jquery-ui-1.13.2/jquery-ui.structure.min.css">
        <link rel="stylesheet" href="/extra-assets/jquery-ui-1.13.2/jquery-ui.theme.min.css">
        <link rel="stylesheet" href="/extra-assets/summernote/summernote-bs4.min.css">
        
        <style>
            .swal2-popup {
                font-size: 0.78em;
            }

            /* ==========================================
               KUSTOMISASI TEMA WARNA HIJAU 
               ========================================== */
            :root {
                --primary-green: #0fa862; /* Warna hijau utama */
                --light-green: #e6f7ee;   /* Background hijau muda untuk menu aktif */
                --dark-green: #0b7a48;    /* Warna hijau saat tombol di-hover */
            }

            /* Mengubah warna teks biru bawaan DeskApp */
            .text-blue, .text-primary {
                color: var(--primary-green) !important;
            }

            /* Mengubah tombol utama (Button Primary) */
            .btn-primary {
                background-color: var(--primary-green) !important;
                border-color: var(--primary-green) !important;
            }
            .btn-primary:hover, .btn-primary:focus, .btn-primary:active {
                background-color: var(--dark-green) !important;
                border-color: var(--dark-green) !important;
            }

            /* Mengubah tombol outline */
            .btn-outline-primary {
                color: var(--primary-green) !important;
                border-color: var(--primary-green) !important;
            }
            .btn-outline-primary:hover, .btn-outline-primary.active, .btn-outline-primary:active {
                background-color: var(--primary-green) !important;
                color: #fff !important;
                border-color: var(--primary-green) !important;
            }

            /* Mengubah menu sidebar yang aktif */
            .sidebar-menu > ul > li > .dropdown-toggle.active {
                background-color: var(--light-green) !important;
                color: var(--primary-green) !important;
                border-left: 4px solid var(--primary-green) !important;
            }
            .sidebar-menu .submenu li a.active {
                color: var(--primary-green) !important;
            }

            /* Mengubah indikator / badge aktif */
            .notification-active {
                background: var(--primary-green) !important;
            }

            /* Mengubah progress bar pre-loader */
            .pre-loader .bar {
                background: var(--primary-green) !important;
            }

            /* ==========================================
               MENU SIDEBAR: HIJAU HANYA SAAT DIKLIK/AKTIF
               (background sidebar TETAP default, tidak diubah)
               ========================================== */
            .left-side-bar .sidebar-menu ul li a.active,
            .left-side-bar .sidebar-menu ul li .dropdown-toggle.active {
                background-color: var(--primary-green) !important;
                color: #ffffff !important;
                border-left: 4px solid var(--dark-green) !important;
            }
            /* Menghapus background hitam bawaan tema saat menu di-hover */
            .left-side-bar .sidebar-menu ul li a:hover,
            .left-side-bar .sidebar-menu ul li .dropdown-toggle:hover,
            .left-side-bar .sidebar-menu ul li:hover > a,
            .left-side-bar .sidebar-menu ul li:hover > .dropdown-toggle {
                background-color: transparent !important;
                color: inherit !important;
            }
            /* Tapi tetap hijau kalau memang menu itu sedang aktif, walau di-hover */
            .left-side-bar .sidebar-menu ul li a.active:hover,
            .left-side-bar .sidebar-menu ul li .dropdown-toggle.active:hover {
                background-color: var(--primary-green) !important;
                color: #ffffff !important;
            }

            /* ==========================================
               HAPUS SEMUA BACKGROUND HITAM DI SIDEBAR
               (default, hover, focus - untuk semua item menu & submenu)
               + Transisi halus agar animasi terasa smooth
               ========================================== */
            .left-side-bar .sidebar-menu ul li a,
            .left-side-bar .sidebar-menu ul li .dropdown-toggle,
            .left-side-bar .sidebar-menu ul li,
            .left-side-bar .sidebar-menu ul.submenu li a,
            .left-side-bar .sidebar-menu ul.submenu li {
                background-color: transparent !important;
                background: transparent !important;
                transition: background-color 0.25s ease, color 0.25s ease, border-color 0.25s ease !important;
            }
            .left-side-bar .sidebar-menu ul li a:hover,
            .left-side-bar .sidebar-menu ul li a:focus,
            .left-side-bar .sidebar-menu ul li .dropdown-toggle:hover,
            .left-side-bar .sidebar-menu ul li .dropdown-toggle:focus,
            .left-side-bar .sidebar-menu ul li:hover,
            .left-side-bar .sidebar-menu ul.submenu li a:hover {
                background-color: var(--light-green) !important;
                background: var(--light-green) !important;
                color: var(--dark-green) !important;
            }

            /* Menu yang benar-benar aktif tetap hijau (prioritas paling akhir/tinggi) */
            .left-side-bar .sidebar-menu ul li a.active,
            .left-side-bar .sidebar-menu ul li .dropdown-toggle.active,
            .left-side-bar .sidebar-menu ul li a.active:hover,
            .left-side-bar .sidebar-menu ul li .dropdown-toggle.active:hover {
                background-color: var(--primary-green) !important;
                color: #ffffff !important;
                border-left: 4px solid var(--dark-green) !important;
            }
            .left-side-bar .sidebar-menu ul.submenu li a.active {
                background-color: var(--primary-green) !important;
                color: #ffffff !important;
            }

            /* ==========================================
               PAKSA SIDEBAR SELALU PUTIH
               (mengabaikan toggle Dark/Light bawaan tema)
               ========================================== */
            body.sidebar-dark .left-side-bar,
            body .left-side-bar,
            .left-side-bar {
                background-color: #ffffff !important;
            }
            body.sidebar-dark .left-side-bar .sidebar-menu ul li a,
            body.sidebar-dark .left-side-bar .sidebar-menu ul li .dropdown-toggle,
            .left-side-bar .sidebar-menu ul li a,
            .left-side-bar .sidebar-menu ul li .dropdown-toggle {
                color: #1f2937 !important;
            }
            body.sidebar-dark .left-side-bar .sidebar-menu ul li a .mtext,
            .left-side-bar .sidebar-menu ul li a .mtext {
                color: inherit !important;
            }
            body.sidebar-dark .left-side-bar .sidebar-small-cap,
            .left-side-bar .sidebar-small-cap {
                color: var(--primary-green) !important;
            }
            body.sidebar-dark .left-side-bar .dropdown-divider,
            .left-side-bar .dropdown-divider {
                border-color: #e5e7eb !important;
            }
            /* Menu aktif tetap hijau dengan teks putih (supaya tetap kontras) */
            body.sidebar-dark .left-side-bar .sidebar-menu ul li a.active,
            body.sidebar-dark .left-side-bar .sidebar-menu ul li .dropdown-toggle.active,
            .left-side-bar .sidebar-menu ul li a.active,
            .left-side-bar .sidebar-menu ul li .dropdown-toggle.active {
                color: #ffffff !important;
            }

            .left-side-bar .sidebar-menu ul li .submenu li a.active {
                background-color: var(--primary-green) !important;
                color: #ffffff !important;
            }

            /* ==========================================
               TOOLTIP DETAIL SAAT HOVER MENU SIDEBAR
               ========================================== */
            .left-side-bar .sidebar-menu ul li {
                position: relative;
            }
            .left-side-bar .sidebar-menu ul li a[data-tooltip]::after {
                content: attr(data-tooltip);
                position: absolute;
                left: calc(100% + 14px);
                top: 50%;
                transform: translateY(-50%) translateX(-8px);
                background-color: #1f2937;
                color: #ffffff;
                padding: 7px 12px;
                border-radius: 6px;
                font-size: 12.5px;
                font-weight: 500;
                white-space: nowrap;
                box-shadow: 0 4px 12px rgba(0,0,0,0.18);
                opacity: 0;
                visibility: hidden;
                pointer-events: none;
                transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s ease;
                z-index: 1050;
            }
            /* Anak panah kecil di sisi kiri tooltip */
            .left-side-bar .sidebar-menu ul li a[data-tooltip]::before {
                content: "";
                position: absolute;
                left: calc(100% + 6px);
                top: 50%;
                transform: translateY(-50%) translateX(-8px);
                border-width: 6px 8px 6px 0;
                border-style: solid;
                border-color: transparent #1f2937 transparent transparent;
                opacity: 0;
                visibility: hidden;
                pointer-events: none;
                transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s ease;
                z-index: 1050;
            }
            .left-side-bar .sidebar-menu ul li a[data-tooltip]:hover::after,
            .left-side-bar .sidebar-menu ul li a[data-tooltip]:hover::before {
                opacity: 1;
                visibility: visible;
                transform: translateY(-50%) translateX(0);
            }
        </style>
        @kropifyStyles
        @livewireStyles
        @stack('stylesheets')
    </head>
    <body>
        {{-- <div class="pre-loader">
            <div class="pre-loader-box">
                <div class="loader-logo">
                    <img src="/back/vendors/images/deskapp-logo.svg" alt="" />
                </div>
                <div class="loader-progress" id="progress_div">
                    <div class="bar" id="bar1"></div>
                </div>
                <div class="percent" id="percent1">0%</div>
                <div class="loading-text">Loading...</div>
            </div>
        </div> --}}

        <div class="header">
            <div class="header-left">
                <div class="menu-icon bi bi-list"></div>
                <div
                    class="search-toggle-icon bi bi-search"
                    data-toggle="header_search"
                ></div>
                <div class="header-search">
                    <form>
                        <div class="form-group mb-0">
                            <i class="dw dw-search2 search-icon"></i>
                            <input
                                type="text"
                                class="form-control search-input"
                                placeholder="Search Here"
                            />
                            <div class="dropdown">
                                <a
                                    class="dropdown-toggle no-arrow"
                                    href="#"
                                    role="button"
                                    data-toggle="dropdown"
                                >
                                    <i class="ion-arrow-down-c"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">From</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input
                                                class="form-control form-control-sm form-control-line"
                                                type="text"
                                            />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">To</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input
                                                class="form-control form-control-sm form-control-line"
                                                type="text"
                                            />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Subject</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input
                                                class="form-control form-control-sm form-control-line"
                                                type="text"
                                            />
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="header-right">
                <div class="dashboard-setting user-notification">
                    <div class="dropdown">
                        <a
                            class="dropdown-toggle no-arrow"
                            href="javascript:;"
                            data-toggle="right-sidebar"
                        >
                            <i class="dw dw-settings2"></i>
                        </a>
                    </div>
                </div>
                <div class="user-notification">
                    <div class="dropdown">
                        <a
                            class="dropdown-toggle no-arrow"
                            href="#"
                            role="button"
                            data-toggle="dropdown"
                        >
                            <i class="icon-copy dw dw-notification"></i>
                            <span class="badge notification-active"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="notification-list mx-h-350 customscroll">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <img src="/back/vendors/images/img.jpg" alt="" />
                                            <h3>John Doe</h3>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing
                                                elit, sed...
                                            </p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="/back/vendors/images/photo1.jpg" alt="" />
                                            <h3>Lea R. Frith</h3>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing
                                                elit, sed...
                                            </p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="/back/vendors/images/photo2.jpg" alt="" />
                                            <h3>Erik L. Richards</h3>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing
                                                elit, sed...
                                            </p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="/back/vendors/images/photo3.jpg" alt="" />
                                            <h3>John Doe</h3>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing
                                                elit, sed...
                                            </p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="/back/vendors/images/photo4.jpg" alt="" />
                                            <h3>Renee I. Hansen</h3>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing
                                                elit, sed...
                                            </p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="/back/vendors/images/img.jpg" alt="" />
                                            <h3>Vicki M. Coleman</h3>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing
                                                elit, sed...
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                @livewire('admin-seller-header-profile-info')
            </div>
        </div>

        <div class="right-sidebar">
            <div class="sidebar-title">
                <h3 class="weight-600 font-16 text-blue">
                    Layout Settings
                    <span class="btn-block font-weight-400 font-12">User Interface Settings</span>
                </h3>
                <div class="close-sidebar" data-toggle="right-sidebar-close">
                    <i class="icon-copy ion-close-round"></i>
                </div>
            </div>
            <div class="right-sidebar-body customscroll">
                <div class="right-sidebar-body-content">
                    <h4 class="weight-600 font-18 pb-10">Header Background</h4>
                    <div class="sidebar-btn-group pb-30 mb-10">
                        <a
                            href="javascript:void(0);"
                            class="btn btn-outline-primary header-white active"
                            >White</a
                        >
                        <a
                            href="javascript:void(0);"
                            class="btn btn-outline-primary header-dark"
                            >Dark</a
                        >
                    </div>

                    <h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
                    <div class="sidebar-btn-group pb-30 mb-10">
                        <a
                            href="javascript:void(0);"
                            class="btn btn-outline-primary sidebar-light"
                            >White</a
                        >
                        <a
                            href="javascript:void(0);"
                            class="btn btn-outline-primary sidebar-dark active"
                            >Dark</a
                        >
                    </div>

                    <h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
                    <div class="sidebar-radio-group pb-10 mb-10">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input
                                type="radio"
                                id="sidebaricon-1"
                                name="menu-dropdown-icon"
                                class="custom-control-input"
                                value="icon-style-1"
                                checked=""
                            />
                            <label class="custom-control-label" for="sidebaricon-1"
                                ><i class="fa fa-angle-down"></i
                            ></label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input
                                type="radio"
                                id="sidebaricon-2"
                                name="menu-dropdown-icon"
                                class="custom-control-input"
                                value="icon-style-2"
                            />
                            <label class="custom-control-label" for="sidebaricon-2"
                                ><i class="ion-plus-round"></i
                            ></label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input
                                type="radio"
                                id="sidebaricon-3"
                                name="menu-dropdown-icon"
                                class="custom-control-input"
                                value="icon-style-3"
                            />
                            <label class="custom-control-label" for="sidebaricon-3"
                                ><i class="fa fa-angle-double-right"></i
                            ></label>
                        </div>
                    </div>

                    <h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
                    <div class="sidebar-radio-group pb-30 mb-10">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input
                                type="radio"
                                id="sidebariconlist-1"
                                name="menu-list-icon"
                                class="custom-control-input"
                                value="icon-style-1"
                                checked=""
                            />
                            <label class="custom-control-label" for="sidebariconlist-1"
                                ><i class="ion-minus-round"></i
                            ></label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input
                                type="radio"
                                id="sidebariconlist-2"
                                name="menu-list-icon"
                                class="custom-control-input"
                                value="icon-list-style-2"
                            />
                            <label class="custom-control-label" for="sidebariconlist-2"
                                ><i class="fa fa-circle-o" aria-hidden="true"></i
                            ></label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input
                                type="radio"
                                id="sidebariconlist-3"
                                name="menu-list-icon"
                                class="custom-control-input"
                                value="icon-list-style-3"
                            />
                            <label class="custom-control-label" for="sidebariconlist-3"
                                ><i class="dw dw-check"></i
                            ></label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input
                                type="radio"
                                id="sidebariconlist-4"
                                name="menu-list-icon"
                                class="custom-control-input"
                                value="icon-list-style-4"
                                checked=""
                            />
                            <label class="custom-control-label" for="sidebariconlist-4"
                                ><i class="icon-copy dw dw-next-2"></i
                            ></label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input
                                type="radio"
                                id="sidebariconlist-5"
                                name="menu-list-icon"
                                class="custom-control-input"
                                value="icon-list-style-5"
                            />
                            <label class="custom-control-label" for="sidebariconlist-5"
                                ><i class="dw dw-fast-forward-1"></i
                            ></label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input
                                type="radio"
                                id="sidebariconlist-6"
                                name="menu-list-icon"
                                class="custom-control-input"
                                value="icon-list-style-6"
                            />
                            <label class="custom-control-label" for="sidebariconlist-6"
                                ><i class="dw dw-next"></i
                            ></label>
                        </div>
                    </div>

                    <div class="reset-options pt-30 text-center">
                        <button class="btn btn-danger" id="reset-settings">
                            Reset Settings
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="left-side-bar">
            <div class="brand-logo">
                <a href="/" class="lapak-ikan-logo">
                    <svg viewBox="0 0 235 50" xmlns="http://www.w3.org/2000/svg" style="height:34px;width:auto;">
                        <text x="4" y="34" font-family="'Inter', Arial, sans-serif" font-weight="800" font-size="28" fill="var(--primary-green)">LAPAK</text>
                        <rect x="112" y="5" width="112" height="40" rx="10" fill="var(--primary-green)"></rect>
                        <text x="168" y="33" text-anchor="middle" font-family="'Inter', Arial, sans-serif" font-weight="800" font-size="28" fill="#ffffff">IKAN</text>
                    </svg>
                </a>
                <div class="close-sidebar" data-toggle="left-sidebar-close">
                    <i class="ion-close-round"></i>
                </div>
            </div>
            <div class="menu-block customscroll">
                <div class="sidebar-menu">
                    <ul id="accordion-menu">

                        @if ( Route::is('admin.*') )
                        <li>
                            <a href="{{ route('admin.home') }}" class="dropdown-toggle no-arrow {{ Route::is('admin.home') ? 'active' : '' }}">
                                <span class="micon fa fa-home"></span>
                                <span class="mtext">Home</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.manage-categories.cats-subcats-list') }}" class="dropdown-toggle no-arrow {{ Route::is('admin.manage-categories.*') ? 'active' : '' }}">
                                <span class="micon dw dw-align-left3"></span>
                                <span class="mtext">Manage Categories</span>
                            </a>
                        </li>

                        <li>
                            <a href="invoice.html" class="dropdown-toggle no-arrow">
                                <span class="micon bi bi-receipt-cutoff"></span>
                                <span class="mtext">Invoice</span>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <div class="sidebar-small-cap">Settings</div>
                        </li>
                    
                        <li>
                            <a
                                href="{{ route('admin.profile') }}"
                                class="dropdown-toggle no-arrow {{ Route::is('admin.profile') ? 'active' : '' }}"
                            >
                                <span class="micon fa fa-user"></span>
                                <span class="mtext">Profile</span>
                            </a>
                        </li>
                        <li>
                            <a
                                href="{{ route('admin.settings') }}"
                                class="dropdown-toggle no-arrow {{ Route::is('admin.settings') ? 'active' : '' }}"
                            >
                                <span class="micon icon-copy fi-widget"></span>
                                <span class="mtext">Settings</span>
                            </a>
                        </li>
                        @else
                        <li>
                            <a href="{{ route('seller.home') }}" class="dropdown-toggle no-arrow {{ Route::is('seller.home') ? 'active' : '' }}" data-tooltip="Ringkasan aktivitas toko Anda">
                                <span class="micon fa fa-home"></span>
                                <span class="mtext">Home</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('seller.orders') }}" class="dropdown-toggle no-arrow" data-tooltip="Lihat daftar pesanan & invoice">
                                <span class="micon bi bi-receipt-cutoff"></span>
                                <span class="mtext">Invoice</span>
                            </a>
                        </li>

                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle {{ Route::is('seller.product.*') ? 'active' : '' }}" data-tooltip="Kelola produk yang Anda jual">
                                <span class="micon bi bi-bag"></span><span class="mtext">Manage Products</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('seller.product.all-products') }}" class="{{ Route::is('seller.product.all-products') ? 'active' : '' }}" data-tooltip="Lihat semua produk">All Products</a></li>
                                <li><a href="{{ route('seller.product.add-product') }}" class="{{ Route::is('seller.product.add-product') ? 'active' : '' }}" data-tooltip="Tambahkan produk baru">Add Product</a></li>
                            </ul>
                        </li>

                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <div class="sidebar-small-cap">Settings</div>
                        </li>
                    
                        <li>
                            <a
                                href="{{ route('seller.profile') }}"
                                class="dropdown-toggle no-arrow {{ Route::is('seller.profile') ? 'active' : '' }}"
                                data-tooltip="Ubah data & foto profil Anda"
                            >
                                <span class="micon fa fa-user"></span>
                                <span class="mtext">Profile</span>
                            </a>
                        </li>
                        <li>
                            <a
                                href="{{ route('seller.shop-settings') }}"
                                class="dropdown-toggle no-arrow {{ Route::is('seller.shop-settings') ? 'active' : '' }}"
                                data-tooltip="Atur nama, logo & info toko"
                            >
                                <span class="micon bi bi-shop"></span>
                                <span class="mtext">Shop Settings</span>
                            </a>
                        </li>

                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="mobile-menu-overlay"></div>

        <div class="main-container">
            <div class="pd-ltr-20 xs-pd-20-10">
                <div class="min-height-200px">
                    <div>
                        @yield('content')
                    </div>
                </div>
                <div class="footer-wrap pd-20 mb-20 card-box">
                    DeskApp - Bootstrap 4 Admin Template By
                    <a href="https://github.com/dropways" target="_blank" style="color: var(--primary-green); font-weight: 600;"
                        >Ankit Hingarajiya</a
                    >
                </div>
            </div>
        </div>
    
        <script src="/back/vendors/scripts/core.js"></script>
        <script src="/back/vendors/scripts/script.min.js"></script>
        <script src="/back/vendors/scripts/process.js"></script>
        <script src="/back/vendors/scripts/layout-settings.js"></script>
        <script>
            if( navigator.userAgent.indexOf("Firefox") != -1 ){
                history.pushState(null, null, document.URL);
                window.addEventListener('popstate', function(){
                    history.pushState(null, null, document.URL);
                });
            }
        </script>
        <script src="/extra-assets/ijabo/ijabo.min.js"></script>
        <script src="/extra-assets/ijabo/jquery.ijaboViewer.min.js"></script>
        <script src="/extra-assets/ijaboCropTool/ijaboCropTool.min.js"></script>
        <script src="/extra-assets/jquery-ui-1.13.2/jquery-ui.min.js"></script>
        <script src="/extra-assets/summernote/summernote-bs4.min.js"></script>
        <script>
            $(document).ready(function(){
                $('.summernote').summernote({
                    height:200
                });
            });
        </script>
        <script>
            window.addEventListener('showToastr', function(event){
                 toastr.remove();
                 if( event.detail[0].type === 'info' ){ toastr.info(event.detail[0].message); }
                 else if( event.detail[0].type === 'success' ){ toastr.success(event.detail[0].message); }
                 else if( event.detail[0].type === 'error' ){ toastr.error(event.detail[0].message); }
                 else if( event.detail[0].type === 'warning' ){ toastr.warning(event.detail[0].message); }
                 else{ return false; }
            });
        </script>
        @kropifyScripts
        @livewireScripts
        @stack('scripts')

        <script>
            $(document).ready(function() {
                $(document).on('submit', '#addProductForm', function(e) {
                    e.preventDefault(); // Menghentikan layar hitam JSON mentah

                    var form = this;
                    var summary = $('textarea.summernote').length ? $('textarea.summernote').summernote('code') : $('#summary').val();
                    var formdata = new FormData(form);
                    formdata.append('summary', summary);

                    $.ajax({
                        url: $(form).attr('action'),
                        method: $(form).attr('method'),
                        data: formdata,
                        processData: false,
                        dataType: 'json',
                        contentType: false,
                        beforeSend: function() {
                            $(form).find('span.error-text').text('');
                        },
                        success: function(response) {
                            if (response.status == 1) {
                                alert(response.msg); // Pop-up notifikasi sukses
                                window.location.href = "{{ route('seller.product.all-products') }}"; // Redirect otomatis ke daftar produk
                            } else {
                                alert(response.msg);
                            }
                        },
                        error: function(response) {
                            if (response.responseJSON && response.responseJSON.errors) {
                                $.each(response.responseJSON.errors, function(prefix, val) {
                                    $(form).find('span.' + prefix + '_error').text(val[0]);
                                });
                            } else {
                                alert('Terjadi kesalahan pada validasi produk.');
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>