@extends('front.layouts.app')

@section('title', 'Réinitialisation de mot de passe - COOPROM')

@section('content')
    <section class="auth-section-creative d-flex align-items-center justify-content-center overflow-hidden" style="min-height: 95vh; background: #fcfcfc; padding: 100px 0;">
        <!-- Animated Background Decor -->
        <div class="auth-bg-shapes position-absolute w-100 h-100 overflow-hidden" style="z-index: 1; top:0; left:0;">
            <div class="shape-1 position-absolute bg-danger opacity-05 rounded-circle" style="width: 500px; height: 500px; top: -200px; left: -200px; filter: blur(80px);"></div>
            <div class="shape-2 position-absolute bg-dark opacity-05 rounded-circle" style="width: 400px; height: 400px; bottom: -100px; right: -100px; filter: blur(60px);"></div>
        </div>

        <div class="auto-container position-relative z-index-2">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6">
                    <div class="auth-card-modern bg-white rounded-3xl shadow-2xl overflow-hidden animate-up p-4 p-md-5">
                        <div class="form-wrapper">
                            <div class="text-center mb-5">
                                <img src="{{ asset('assets/front/images/logo.jpg') }}" height="50" class="mb-4 rounded" style="border: 1px solid #eee;">
                                <h3 class="font-weight-bold">Nouveau mot de passe</h3>
                                <p class="text-muted small">Créez votre nouveau mot de passe sécurisé.</p>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger border-0 rounded-xl small mb-4">
                                    <ul class="mb-0 list-unstyled">
                                        @foreach ($errors->all() as $error)
                                            <li><i class="fas fa-exclamation-triangle mr-2"></i> {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('password.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="mb-4">
                                    <div class="form-floating-creative group">
                                        <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block">Email Adhérent</label>
                                        <div class="input-group-modern d-flex align-items-center border-bottom pb-2 transition-all">
                                            <i class="fas fa-envelope text-muted mr-3"></i>
                                            <input type="email" name="email" class="form-control-minimal" placeholder="votre@email.com" value="{{ $email ?? old('email') }}" required autofocus>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="form-floating-creative group">
                                        <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block">Nouveau mot de passe</label>
                                        <div class="input-group-modern d-flex align-items-center border-bottom pb-2 transition-all">
                                            <i class="fas fa-lock text-muted mr-3"></i>
                                            <input type="password" name="password" class="form-control-minimal" placeholder="••••••••" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="form-floating-creative group">
                                        <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block">Confirmer le mot de passe</label>
                                        <div class="input-group-modern d-flex align-items-center border-bottom pb-2 transition-all">
                                            <i class="fas fa-lock text-muted mr-3"></i>
                                            <input type="password" name="password_confirmation" class="form-control-minimal" placeholder="••••••••" required>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="theme-btn btn-style-one w-100 py-3 shadow-xl border-0">
                                    <span class="btn-title font-weight-bold">RÉINITIALISER LE MOT DE PASSE <i class="fas fa-key ml-2"></i></span>
                                </button>
                            </form>
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

    .btn-style-one { background-color: #ff3c36; color: white; border-radius: 50px; transition: 0.4s; }
    .btn-style-one:hover { background-color: #222; transform: translateY(-3px); }
</style>
@endsection
