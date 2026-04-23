@extends('front.layouts.app')

@section('title', 'Inscription Adhérent - COOPROM')

@section('extra_css')
<style>
    .register-section {
        padding: 100px 0;
        background: #f9f9f9;
    }
    .register-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        animation: fadeInUp 0.8s ease;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .register-info-side {
        background: #2c3e50;
        color: #fff;
        padding: 60px 40px;
        height: 100%;
        position: relative;
    }
    .register-info-side::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: url('{{ asset("assets/front/images/background/pattern-1.png") }}');
        opacity: 0.1;
    }
    .register-info-side h2 {
        color: #fff;
        font-weight: 700;
        margin-bottom: 30px;
    }
    .benefit-item {
        margin-bottom: 25px;
        display: flex;
        align-items: flex-start;
    }
    .benefit-item i {
        font-size: 24px;
        margin-right: 15px;
        background: rgba(255,255,255,0.2);
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        flex-shrink: 0;
    }
    .benefit-item h4 {
        margin-bottom: 5px;
        font-size: 18px;
        color: #fff;
    }
    .benefit-item p {
        font-size: 14px;
        line-height: 1.4;
        opacity: 0.9;
        color: #fff;
    }
    .register-form-side {
        padding: 60px 50px;
    }
    .form-header {
        margin-bottom: 40px;
    }
    .form-header h3 {
        font-weight: 700;
        color: #222;
        margin-bottom: 10px;
    }
    .form-group {
        margin-bottom: 30px;
    }
    .form-group label {
        font-weight: 600;
        color: #444;
        margin-bottom: 12px;
        display: block;
    }
    .form-group input, .form-group select {
        border: 2px solid #eee !important;
        border-radius: 10px !important;
        height: 55px !important;
        padding: 0 20px !important;
        transition: all 0.3s ease;
    }
    .form-group input:focus, .form-group select:focus {
        border-color: #2c3e50 !important;
        box-shadow: none !important;
    }
    .btn-submit {
        width: 100%;
        height: 55px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: 20px;
        border-radius: 10px;
        background: #2c3e50;
        color: #fff;
        transition: all 0.3s ease;
        border: none;
    }
    .btn-submit:hover {
        background: #1a252f;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .login-link {
        margin-top: 25px;
        text-align: center;
        color: #777;
    }
    .login-link a {
        color: #2c3e50;
        font-weight: 700;
    }
    @media (max-width: 991px) {
        .register-info-side { padding: 40px 30px; }
        .register-form-side { padding: 40px 30px; }
    }
</style>
@endsection

@section('content')
<!-- Page Title -->
<section class="page-title" style="background-image: url({{ asset('assets/front/images/background/banner.jpeg') }});">
    <div class="auto-container">
        <h1 style="color: white; font-weight: bold">Espace Artiste</h1>
        <ul class="page-breadcrumb">
            <li><a href="/">Accueil</a></li>
            <li>Rejoindre la Coopérative</li>
        </ul>
    </div>
</section>

<!-- Register Section -->
<section class="register-section">
    <div class="auto-container">
        <div class="register-card">
            <div class="row no-gutters">
                <!-- Left Side: Info -->
                <div class="col-lg-5 col-md-12">
                    <div class="register-info-side">
                        <h2>Pourquoi nous rejoindre ?</h2>
                        <div class="benefits-list">
                            <div class="benefit-item">
                                <i class="fa fa-music"></i>
                                <div>
                                    <h4>Production de Qualité</h4>
                                    <p>Accédez à nos studios et équipements de pointe pour vos clips et albums.</p>
                                </div>
                            </div>
                            <div class="benefit-item">
                                <i class="fa fa-globe"></i>
                                <div>
                                    <h4>Mobilité Internationale</h4>
                                    <p>Assistance complète pour vos visas et tournées à l'étranger.</p>
                                </div>
                            </div>
                            <div class="benefit-item">
                                <i class="fa fa-gavel"></i>
                                <div>
                                    <h4>Protection Juridique</h4>
                                    <p>Gestion de vos contrats et protection de vos droits d'auteur.</p>
                                </div>
                            </div>
                            <div class="benefit-item">
                                <i class="fa fa-users"></i>
                                <div>
                                    <h4>Réseau Professionnel</h4>
                                    <p>Connectez-vous avec d'autres artistes et investisseurs culturels.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Form -->
                <div class="col-lg-7 col-md-12">
                    <div class="register-form-side">
                        <div class="form-header">
                            <h3>Créez votre compte</h3>
                            <p>Remplissez le formulaire ci-dessous pour débuter votre aventure avec COOPROM.</p>
                        </div>

                        <form method="post" action="{{ route('register') }}" class="default-form">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 form-group">
                                    <label>Prénom</label>
                                    <input type="text" name="name" placeholder="Ex: Jean" value="{{ old('name') }}" required>
                                    @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-lg-6 col-md-6 form-group">
                                    <label>Nom</label>
                                    <input type="text" name="last_name" placeholder="Ex: Kouassi" value="{{ old('last_name') }}" required>
                                    @error('last_name') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-lg-12 form-group">
                                    <label>Email Professionnel</label>
                                    <input type="email" name="email" placeholder="votre@email.com" value="{{ old('email') }}" required>
                                    @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-lg-12 form-group">
                                    <label>Numéro de Téléphone</label>
                                    <input type="text" name="phone_number" placeholder="+225 00 00 00 00 00" value="{{ old('phone_number') }}">
                                    @error('phone_number') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-lg-12 form-group">
                                    <label>Secteur d'Activité</label>
                                    <select name="cultural_sector_id" required>
                                        <option value="">Choisissez votre domaine artistique</option>
                                        @foreach($sectors as $sector)
                                            <option value="{{ $sector->id }}" {{ old('cultural_sector_id') == $sector->id ? 'selected' : '' }}>
                                                {{ $sector->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('cultural_sector_id') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-lg-12 form-group">
                                    <label>Mot de passe</label>
                                    <input type="password" name="password" placeholder="********" required>
                                    @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-lg-12 form-group">
                                    <label>Confirmation</label>
                                    <input type="password" name="password_confirmation" placeholder="********" required>
                                </div>

                                <div class="col-lg-12">
                                    <button class="btn-submit" type="submit">
                                        Rejoindre la Coopérative
                                    </button>
                                </div>

                                <div class="col-lg-12 login-link">
                                    Déjà inscrit ? <a href="{{ route('login') }}">Connectez-vous ici</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
