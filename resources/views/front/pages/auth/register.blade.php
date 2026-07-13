@extends('front.layout.pages-layout')
@section('pageTitle', $pageTitle)
@section('content')
<section class="log-in-section section-b-space">
    <div class="container-fluid-lg w-100">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8">
                <div class="log-in-box mt-4 p-4 border rounded">
                    <h3 class="mb-3">Buat Akun</h3>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('client.register-handler') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-animation w-100">Daftar</button>
                    </form>

                    <p class="mt-3 mb-0">Sudah punya akun?
                        <a href="{{ route('client.login') }}">Sign In di sini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
