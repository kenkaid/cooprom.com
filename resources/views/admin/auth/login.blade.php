@extends('admin.layouts.auth')

@section('title', 'Connexion - COOPROM Admin')

@section('content')
<div class="container-fluid">
    <div class="authentication-card">
        <div class="card shadow rounded-0 overflow-hidden">
            <div class="row g-0">
                <div class="col-lg-6 bg-login d-flex align-items-center justify-content-center">
                    <img src="{{asset('assets/admin/images/error/login-img.jpg')}}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6">
                    <div class="card-body p-4 p-sm-5">
                        <h5 class="card-title">Connexion</h5>
                        <p class="card-text mb-5">Accédez à votre espace d'administration COOPROM</p>
                        <form class="form-body" action="{{ route('admin.login') }}" method="POST">
                            @csrf
                            {{--
                            <div class="d-grid">
                                <a class="btn btn-white radius-30" href="javascript:;"><span
                                        class="d-flex justify-content-center align-items-center">
                    <img class="me-2" src="{{asset('assets/admin/images/icons/search.svg')}}" width="16" alt="">
                    <span>Se connecter avec Google</span>
                  </span>
                                </a>
                            </div>
                            <div class="login-separater text-center mb-4"><span>OU CONNECTEZ-VOUS AVEC VOTRE EMAIL</span>
                                <hr>
                            </div>
                            --}}
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="inputEmailAddress" class="form-label">Adresse Email</label>
                                    <div class="ms-auto position-relative">
                                        <div
                                            class="position-absolute top-50 translate-middle-y search-icon px-3">
                                            <i class="bi bi-envelope-fill"></i></div>
                                        <input type="email" name="email" class="form-control radius-30 ps-5 @error('email') is-invalid @enderror"
                                               id="inputEmailAddress" placeholder="Adresse Email" value="{{ old('email') }}" required autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="inputChoosePassword" class="form-label">Mot de passe</label>
                                    <div class="ms-auto position-relative">
                                        <div
                                            class="position-absolute top-50 translate-middle-y search-icon px-3">
                                            <i class="bi bi-lock-fill"></i></div>
                                        <input type="password" name="password" class="form-control radius-30 ps-5 @error('password') is-invalid @enderror"
                                               id="inputChoosePassword" placeholder="Mot de passe" required>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                               id="flexSwitchCheckChecked" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Se souvenir de moi</label>
                                    </div>
                                </div>
                                <div class="col-6 text-end"><a href="#">Mot de passe oublié ?</a>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary radius-30">Se connecter</button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <p class="mb-0">Cette espace est reservé aux administrateurs du site.</p>
                                </div>
                                <div class="col-12 text-center mt-3">
                                    <a href="{{ route('home') }}" class="text-secondary"><i class="bi bi-arrow-left me-1"></i>Retour à l'accueil</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
