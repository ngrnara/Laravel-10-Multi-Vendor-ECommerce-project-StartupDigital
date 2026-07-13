@extends('front.layout.pages-layout')
@section('pageTitle', $pageTitle)
@section('content')

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@800;900&display=swap" rel="stylesheet">

<style>
    .auth-container-fluid {
        height: 600px;
        display: flex;
        background-image: linear-gradient(to bottom, rgb(0, 0, 0), rgb(36, 69, 76));
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        overflow: hidden;
        position: relative;
        margin: 0;
    }

    .auth-side-left {
        position: absolute;
        height: 1000px;
        width: 50%;
        background-image: linear-gradient(to top left, #0c6b3d, #0f9d58);
        color: #ffffff;
        text-align: center;
        position: relative;
        z-index: 2;
        border-radius: 0% 0 150% 0%
    }

    .auth-side-right {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 40px 40px 10%;
        z-index: 2;
        background-image: linear-gradient(to bottom, rgb(0, 0, 0), rgb(36, 69, 76));
    }

    .auth-content-wrapper {
        position: relative;
        max-width: 460px;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 3;
    }

    .auth-content-wrapper-left {
        position: absolute;
        max-width: 460px;
        width: 100%;
        height: 1000px;
        display: flex;
        top: 100px;
        left: 10%;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 3;
    }
    .brand-logo-container {
        display: flex;
        align-items: center;
        gap: 2px;
        margin-bottom: 20px;
    }
    .logo-box-lapak {
        background-color: #ffffff;
        color: #006837;
        font-weight: 900;
        font-size: 1.4rem;
        padding: 4px 12px;
        letter-spacing: 0.5px;
    }
    .logo-box-ikan {
        background-color: #39b54a;
        color: #ffffff;
        font-weight: 900;
        font-size: 1.4rem;
        padding: 4px 12px;
        letter-spacing: 0.5px;
    }

    .left-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 15px;
    }
    .left-desc {
        font-size: 1.2rem;
        max-width: 380px;
        line-height: 1.4;
        font-weight: 400;
        margin-bottom: 25px;
    }

    .btn-outline-register {
        background-color: transparent;
        color: #ffffff;
        border: 2px solid #ffffff;
        border-radius: 50px;
        padding: 8px 45px;
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        text-transform: uppercase;
        transition: all 0.2s;
    }
    .btn-outline-register:hover {
        background-color: #ffffff;
        color: #006837;
    }

    .illustration-container {
        margin-top: 40px;
        width: 100%;
        display: flex;
        justify-content: center;
    }
    .illustration-container img {
        width: 100%;
        max-width: 320px;
        height: auto;
    }

    .form-title-rounded {
        color: #ffffff;
        font-family: 'Nunito', sans-serif;
        font-weight: 900;
        font-size: 2.4rem;
        margin-bottom: 35px;
        letter-spacing: 0.5px;
    }

    .pill-group {
        position: relative;
        width: 100%;
        max-width: 360px;
        margin-bottom: 15px;
    }
    .pill-group i {
        position: absolute;
        left: 24px;
        top: 50%;
        transform: translateY(-50%);
        color: #a0a0a0;
        font-size: 1.2rem;
    }
    .pill-field {
        width: 100%;
        background-color: #e6e6e6;
        border: none;
        border-radius: 50px;
        padding: 15px 25px 15px 58px;
        color: #222222;
        font-size: 1.05rem;
        font-weight: 600;
    }
    .pill-field::placeholder {
        color: #a0a0a0;
        font-weight: 500;
    }
    .pill-field:focus {
        outline: none;
        background-color: #ffffff;
    }

    .btn-tosca-short {
        background-color: #005953;
        color: #ffffff;
        border: none;
        border-radius: 50px;
        padding: 10px 45px;
        font-weight: 700;
        font-size: 0.95rem;
        letter-spacing: 1px;
        cursor: pointer;
        text-transform: uppercase;
        margin-top: 15px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .btn-tosca-short:hover {
        background-color: #00433e;
    }

    .right-bottom-navigation {
        margin-top: 25px;
        text-align: center;
    }
    .right-bottom-navigation a.back-link {
        color: #ffffff;
        text-decoration: none;
        font-size: 0.9rem;
        opacity: 0.8;
    }
    .right-bottom-navigation a:hover {
        text-decoration: underline;
        opacity: 1;
    }

    /* TAMBAHAN UNTUK FIX RESPONSIVE MOBILE TANPA UBAH APAPUN DI ATAS */
    @media (max-width: 1024px) {
        .auth-container-fluid {
            flex-direction: column; height: auto; overflow-y: auto;
        }
        .auth-side-left {
                width: 100%;
                height: auto;
                padding: 40px 20px;
                border-radius: 0;
                display: flex;
                justify-content: center;
                align-items: center;
        }
        .auth-content-wrapper-left {
            position: relative; top: 0; left: 0; height: auto;
        }
        .auth-side-right{
            padding: 40px 20px;
        }
        .illustration-container {
            display: none;
        }
    }
</style>

<div class="auth-container-fluid">
    <div class="auth-side-left">
        <div class="auth-content-wrapper-left">
            <div class="brand-logo-container">
                <div class="logo-box-lapak">LAPAK</div>
                <div class="logo-box-ikan">IKAN</div>
            </div>
            <h3 class="left-title">Belum Punya Akun?</h3>
            <p class="left-desc">Daftarkan dirimu sekarang juga <strong>Gratis!!</strong></p>

            <a href="{{ route('client.register') }}" class="btn-outline-register">Daftar</a>

            <div class="illustration-container">
                <img src="{{ asset('images/auth/login-illustration.png') }}" alt="Illustration">
            </div>
        </div>
    </div>

    <div class="auth-side-right">
        <div class="auth-content-wrapper">
            <h2 class="form-title-rounded">Masuk Akun</h2>

            @if (session('success'))
                <div class="alert alert-success w-100 rounded-3 p-2 mb-3 text-start" style="max-width: 360px; font-size: 0.9rem;">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger w-100 rounded-3 p-3 mb-3 text-start" style="max-width: 360px; font-size: 0.9rem;">
                    @foreach ($errors->all() as $error)
                        <div><i class="fa fa-exclamation-circle me-2"></i>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('client.login-handler') }}" style="width: 100%; display: flex; flex-direction: column; align-items: center;">
                @csrf
                <div class="pill-group">
                    <i class="fa fa-user"></i>
                    <input type="email" name="email" class="pill-field" placeholder="Username / Email" value="{{ old('email') }}" required>
                </div>
                <div class="pill-group">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="password" class="pill-field" placeholder="Password" required>
                </div>
                <button type="submit" class="btn-tosca-short">Masuk</button>
            </form>

            <div class="right-bottom-navigation">
                <a href="javascript:void(0)" class="back-link d-block mb-2" style="opacity:0.6; text-decoration:none;">Lupa Password?</a>
                <a href="{{ route('home-page') }}" class="back-link">
                    <i class="fa fa-dot-circle-o me-1"></i> Kembali Ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
