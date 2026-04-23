@extends('front.layouts.app')

@section('title', 'Connexion Adhérent - COOPROM')

@section('extra_css')
<style>
    .login-section {
        padding: 100px 0;
        background: #f9f9f9;
    }
    .login-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        max-width: 500px;
        margin: 0 auto;
    }
    .login-header {
        background: #2c3e50;
        color: #fff;
        padding: 40px;
        text-align: center;
        position: relative;
    }
    .login-header::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: url('{{ asset("assets/front/images/background/pattern-1.png") }}');
        opacity: 0.1;
    }
    .login-header h3 {
        color: #fff;
        font-weight: 700;
        margin: 0;
    }
    .login-form-side {
        padding: 50px 40px;
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
    .form-group input {
        border: 2px solid #eee !important;
        border-radius: 10px !important;
        height: 55px !important;
        padding: 0 20px !important;
        transition: all 0.3s ease;
    }
    .form-group input:focus {
        border-color: #2c3e50 !important;
        box-shadow: none !important;
    }
    .btn-submit {
        width: 100%;
        height: 55px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: 10px;
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
    .register-link {
        margin-top: 25px;
        text-align: center;
        color: #777;
    }
    .register-link a {
        color: #2c3e50;
        font-weight: 700;
    }
</style>
@endsection

@section('content')
<!-- Page Title -->
<section class="page-title" style="background-image: url({{ asset('assets/front/images/background/11.jpg') }});">
    <div class="auto-container">
        <h1>Espace Adhérent</h1>
        <ul class="page-breadcrumb">
            <li><a href="/">Accueil</a></li>
            <li>Connexion</li>
        </ul>
    </div>
</section>

<!-- Login Section -->
<section class="login-section">
    <div class="auto-container">
        <div class="login-card">
            <div class="login-header">
                <h3>Bon retour !</h3>
                <p class="text-white mb-0">Accédez à votre espace membre</p>
            </div>

            <div class="login-form-side">
                @if(session('success'))
                    <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 10px;">
                        <i class="fa fa-check-circle mr-2"></i> {{ session('success') }}
                    </div>
                @endif

                <form method="post" action="{{ route('login') }}" class="default-form">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="votre@email.com" value="{{ old('email') }}" required>
                        @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Mot de passe</label>
                        <input type="password" name="password" placeholder="********" required>
                        @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="text-right mb-4">
                        <a href="#" class="small text-muted">Mot de passe oublié ?</a>
                    </div>

                    <button class="btn-submit" type="submit">
                        Se connecter
                    </button>

                    <div class="register-link">
                        Pas encore de compte ? <a href="{{ route('register') }}">Devenir adhérent</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
