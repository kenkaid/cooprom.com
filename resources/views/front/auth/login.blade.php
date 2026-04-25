@extends('front.layouts.app')

@section('title', 'Connexion Adhérent - COOPROM')

@section('content')
    <section class="auth-section-creative d-flex align-items-center justify-content-center overflow-hidden" style="min-height: 95vh; background: #fcfcfc; padding: 100px 0;">
        <!-- Animated Background Decor -->
        <div class="auth-bg-shapes position-absolute w-100 h-100 overflow-hidden" style="z-index: 1; top:0; left:0;">
            <div class="shape-1 position-absolute bg-danger opacity-05 rounded-circle" style="width: 500px; height: 500px; top: -200px; left: -200px; filter: blur(80px);"></div>
            <div class="shape-2 position-absolute bg-dark opacity-05 rounded-circle" style="width: 400px; height: 400px; bottom: -100px; right: -100px; filter: blur(60px);"></div>
        </div>

        <div class="auto-container position-relative z-index-2">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-10">
                    <div class="auth-card-modern bg-white rounded-3xl shadow-2xl overflow-hidden animate-up">
                        <div class="row no-gutters m-0">
                            <!-- Image/Brand Side -->
                            <div class="col-lg-6 d-none d-lg-block bg-dark position-relative overflow-hidden">
                                <div class="side-img-wrapper h-100">
                                    <div class="bg-img h-100 w-100 position-absolute" style="background: url({{ asset('assets/front/images/background/7.jpg') }}) center/cover; opacity: 0.6; filter: grayscale(20%) contrast(1.2);"></div>
                                    <div class="overlay position-absolute w-100 h-100" style="background: linear-gradient(135deg, rgba(255,60,54,0.4) 0%, rgba(0,0,0,0.8) 100%);"></div>

                                    <div class="side-content position-relative z-index-2 p-5 h-100 d-flex flex-column justify-content-center text-white">
                                        <h2 class="display-4 font-weight-bold mb-4 text-white">Bienvenue <br><span class="text-transparent-stroke-white">Adhérent</span></h2>
                                        <p class="lead text-white mb-5" style="opacity: 0.95;">Accédez à votre espace exclusif et pilotez votre carrière artistique avec l'élite.</p>

                                        <div class="feature-brief">
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="fas fa-check-circle text-danger mr-3"></i>
                                                <span class="small font-weight-bold text-white">Gestion des Productions</span>
                                            </div>
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="fas fa-check-circle text-danger mr-3"></i>
                                                <span class="small font-weight-bold text-white">Suivi des Voyages & Visas</span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-check-circle text-danger mr-3"></i>
                                                <span class="small font-weight-bold text-white">Conseil Juridique Live</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Side -->
                            <div class="col-lg-6 p-4 p-md-5">
                                <div class="form-wrapper">
                                    <div class="text-center mb-5">
                                        <img src="{{ asset('assets/front/images/logo.jpg') }}" height="50" class="mb-4 rounded" style="border: 1px solid #eee;">
                                        <h3 class="font-weight-bold">Connexion</h3>
                                        <p class="text-muted small">Heureux de vous revoir parmi nous</p>
                                    </div>

                                    @if(session('success'))
                                        <div class="alert alert-success border-0 rounded-xl small shadow-sm mb-4">
                                            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                                        </div>
                                    @endif

                                    @if ($errors->any())
                                        <div class="alert alert-danger border-0 rounded-xl small mb-4">
                                            <ul class="mb-0 list-unstyled">
                                                @foreach ($errors->all() as $error)
                                                    <li><i class="fas fa-exclamation-triangle mr-2"></i> {{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form action="{{ route('login') }}" method="POST" id="creative-login-form">
                                        @csrf
                                        <div class="mb-4">
                                            <div class="form-floating-creative group">
                                                <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block">Email Adhérent</label>
                                                <div class="input-group-modern d-flex align-items-center border-bottom pb-2 transition-all">
                                                    <i class="fas fa-envelope text-muted mr-3"></i>
                                                    <input type="email" name="email" class="form-control-minimal" placeholder="votre@email.com" value="{{ old('email') }}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="form-floating-creative group">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <label class="small text-uppercase font-weight-bold text-muted mb-0">Mot de passe</label>
                                                    <a href="{{ route('password.request') }}" class="very-small text-danger font-weight-bold text-decoration-none">Oublié ?</a>
                                                </div>
                                                <div class="input-group-modern d-flex align-items-center border-bottom pb-2 transition-all">
                                                    <i class="fas fa-lock text-muted mr-3"></i>
                                                    <input type="password" name="password" class="form-control-minimal" placeholder="••••••••" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mb-5">
                                            <label class="custom-check-box d-flex align-items-center cursor-pointer mb-0">
                                                <input type="checkbox" name="remember" id="remember" class="mr-2" style="width:16px; height:16px; accent-color: #ff3c36;" {{ old('remember') ? 'checked' : '' }}>
                                                <span class="small text-muted">Rester connecté</span>
                                            </label>
                                        </div>

                                        <button type="submit" class="theme-btn btn-style-one w-100 py-3 shadow-xl border-0">
                                            <span class="btn-title font-weight-bold">SE CONNECTER <i class="fas fa-sign-in-alt ml-2"></i></span>
                                        </button>

                                        <div class="text-center mt-5">
                                            <p class="text-muted small mb-1">Vous n'avez pas de compte ?</p>
                                            <a href="{{ route('register') }}" class="text-danger font-weight-bold text-decoration-none small">Rejoindre la COOPROM maintenant</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra_css')
<style>
    .auth-section-creative { position: relative; z-index: 1; }
    .z-index-2 { z-index: 2; }
    .rounded-3xl { border-radius: 40px !important; }
    .rounded-xl { border-radius: 15px !important; }
    .shadow-2xl { box-shadow: 0 40px 80px -20px rgba(0, 0, 0, 0.15); }
    .opacity-05 { opacity: 0.05; }

    .text-transparent-stroke-white { -webkit-text-stroke: 1px white; color: transparent; }

    .animate-up { opacity: 0; animation: fadeInUp 1s forwards; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }

    .form-control-minimal {
        border: none !important;
        background: transparent !important;
        padding: 5px 0 !important;
        font-weight: 600;
        color: #222 !important;
        width: 100%;
        font-size: 15px;
    }
    .form-control-minimal:focus { outline: none !important; box-shadow: none !important; }
    .input-group-modern { transition: 0.3s; border-bottom: 2px solid #f0f0f0 !important; }
    .group:focus-within .input-group-modern { border-bottom-color: #ff3c36 !important; }
    .group:focus-within i { color: #ff3c36 !important; }

    .very-small { font-size: 11px; }
    .no-gutters { margin-right: 0; margin-left: 0; }
    .no-gutters > .col, .no-gutters > [class*="col-"] { padding-right: 0; padding-left: 0; }

    .btn-style-one { background-color: #ff3c36; color: white; border-radius: 50px; transition: 0.4s; }
    .btn-style-one:hover { background-color: #222; transform: translateY(-3px); }
</style>
@endsection
