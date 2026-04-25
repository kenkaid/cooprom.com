@extends('front.layouts.app')

@section('title', 'Inscription Adhérent - COOPROM')

@section('content')
    <section class="auth-section-creative py-5 d-flex align-items-center justify-content-center overflow-hidden" style="min-height: 100vh; background: #fcfcfc; padding-top: 120px !important;">
        <!-- Animated Background Decor -->
        <div class="auth-bg-shapes position-absolute w-100 h-100 overflow-hidden" style="z-index: 1; top:0; left:0;">
            <div class="shape-1 position-absolute bg-danger opacity-05 rounded-circle" style="width: 600px; height: 600px; top: -300px; right: -200px; filter: blur(100px);"></div>
            <div class="shape-2 position-absolute bg-dark opacity-05 rounded-circle" style="width: 500px; height: 500px; bottom: -200px; left: -200px; filter: blur(80px);"></div>
        </div>

        <div class="auto-container position-relative z-index-2">
            <div class="row justify-content-center">
                <div class="col-lg-11 col-xl-10">
                    <div class="auth-card-modern bg-white rounded-3xl shadow-2xl overflow-hidden animate-up">
                        <div class="row no-gutters m-0">
                            <!-- Info Side (Storytelling) -->
                            <div class="col-lg-5 d-none d-lg-block bg-dark position-relative overflow-hidden">
                                <div class="side-img-wrapper h-100">
                                    <div class="bg-img h-100 w-100 position-absolute" style="background: url({{ asset('assets/front/images/background/12.jpg') }}) center/cover; opacity: 0.5;"></div>
                                    <div class="overlay position-absolute w-100 h-100" style="background: linear-gradient(135deg, rgba(255,60,54,0.6) 0%, rgba(0,0,0,0.9) 100%);"></div>

                                    <div class="side-content position-relative z-index-2 p-5 h-100 d-flex flex-column justify-content-center text-white">
                                        <h2 class="display-4 font-weight-bold mb-4 text-white">Rejoignez <br><span class="text-transparent-stroke-white">l'Élite</span></h2>
                                        <p class="lead text-white mb-5" style="opacity: 0.95;">Devenez membre de la plus grande coopérative artistique de Côte d'Ivoire.</p>

                                        <div class="benefits-creative">
                                            <div class="benefit-item-modern d-flex align-items-center mb-4">
                                                <div class="icon-sm bg-danger text-white rounded-circle mr-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                    <i class="fas fa-check fa-xs"></i>
                                                </div>
                                                <span class="small font-weight-bold text-white">Visibilité Internationale</span>
                                            </div>
                                            <div class="benefit-item-modern d-flex align-items-center mb-4">
                                                <div class="icon-sm bg-danger text-white rounded-circle mr-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                    <i class="fas fa-check fa-xs"></i>
                                                </div>
                                                <span class="small font-weight-bold text-white">Protection de vos Droits</span>
                                            </div>
                                            <div class="benefit-item-modern d-flex align-items-center">
                                                <div class="icon-sm bg-danger text-white rounded-circle mr-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                    <i class="fas fa-check fa-xs"></i>
                                                </div>
                                                <span class="small font-weight-bold text-white">Réseau d'Affaires</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Side -->
                            <div class="col-lg-7 p-4 p-md-5">
                                <div class="form-wrapper">
                                    <div class="mb-5">
                                        <h3 class="font-weight-bold mb-2">Inscription Adhérent</h3>
                                        <p class="text-muted small">Commencez votre ascension artistique dès aujourd'hui.</p>
                                    </div>

                                    <form method="post" action="{{ route('register') }}" id="creative-register-form">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-floating-creative group">
                                                    <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block">Prénom</label>
                                                    <div class="input-group-modern d-flex align-items-center border-bottom pb-2">
                                                        <i class="fas fa-user text-muted mr-3"></i>
                                                        <input type="text" name="name" class="form-control-minimal" placeholder="Jean" value="{{ old('name') }}" required>
                                                    </div>
                                                    @error('name') <span class="text-danger very-small mt-1 d-block">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="form-floating-creative group">
                                                    <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block">Nom</label>
                                                    <div class="input-group-modern d-flex align-items-center border-bottom pb-2">
                                                        <i class="fas fa-id-card text-muted mr-3"></i>
                                                        <input type="text" name="last_name" class="form-control-minimal" placeholder="Kouassi" value="{{ old('last_name') }}" required>
                                                    </div>
                                                    @error('last_name') <span class="text-danger very-small mt-1 d-block">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-4">
                                                <div class="form-floating-creative group">
                                                    <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block">Email Professionnel</label>
                                                    <div class="input-group-modern d-flex align-items-center border-bottom pb-2">
                                                        <i class="fas fa-envelope text-muted mr-3"></i>
                                                        <input type="email" name="email" class="form-control-minimal" placeholder="votre@email.com" value="{{ old('email') }}" required>
                                                    </div>
                                                    @error('email') <span class="text-danger very-small mt-1 d-block">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-4">
                                                <div class="form-floating-creative group">
                                                    <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block">Secteur Artistique</label>
                                                    <div class="input-group-modern d-flex align-items-center border-bottom pb-2">
                                                        <i class="fas fa-palette text-muted mr-3"></i>
                                                        <select name="cultural_sector_id" class="form-control-minimal cursor-pointer" required>
                                                            <option value="" disabled selected>Choisir votre domaine</option>
                                                            @foreach($sectors as $sector)
                                                                <option value="{{ $sector->id }}" {{ old('cultural_sector_id') == $sector->id ? 'selected' : '' }}>{{ $sector->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('cultural_sector_id') <span class="text-danger very-small mt-1 d-block">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="form-floating-creative group">
                                                    <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block">Mot de passe</label>
                                                    <div class="input-group-modern d-flex align-items-center border-bottom pb-2">
                                                        <i class="fas fa-lock text-muted mr-3"></i>
                                                        <input type="password" name="password" class="form-control-minimal" placeholder="••••••••" required>
                                                    </div>
                                                    @error('password') <span class="text-danger very-small mt-1 d-block">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="form-floating-creative group">
                                                    <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block">Confirmation</label>
                                                    <div class="input-group-modern d-flex align-items-center border-bottom pb-2">
                                                        <i class="fas fa-shield-alt text-muted mr-3"></i>
                                                        <input type="password" name="password_confirmation" class="form-control-minimal" placeholder="••••••••" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 mt-4">
                                                <button type="submit" class="theme-btn btn-style-one w-100 py-3 shadow-xl border-0">
                                                    <span class="btn-title font-weight-bold">CRÉER MON COMPTE <i class="fas fa-arrow-right ml-2"></i></span>
                                                </button>
                                                <p class="text-center mt-4 small text-muted">
                                                    Déjà membre ? <a href="{{ route('login') }}" class="text-danger font-weight-bold text-decoration-none">Connectez-vous ici</a>
                                                </p>
                                            </div>
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
        font-size: 14px;
    }
    .form-control-minimal:focus { outline: none !important; box-shadow: none !important; }
    .input-group-modern { transition: 0.3s; border-bottom: 2px solid #f0f0f0 !important; }
    .group:focus-within .input-group-modern { border-bottom-color: #ff3c36 !important; }
    .group:focus-within i { color: #ff3c36 !important; }

    .very-small { font-size: 10px; }
    .no-gutters { margin-right: 0; margin-left: 0; }
    .no-gutters > .col, .no-gutters > [class*="col-"] { padding-right: 0; padding-left: 0; }

    .btn-style-one { background-color: #ff3c36; color: white; border-radius: 50px; transition: 0.4s; }
    .btn-style-one:hover { background-color: #222; transform: translateY(-3px); }
</style>
@endsection
