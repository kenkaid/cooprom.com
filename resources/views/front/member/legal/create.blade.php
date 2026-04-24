@extends('front.layouts.app')

@section('title', 'Poser une question juridique - COOPROM')

@section('content')
<section class="page-title" style="background-image: url({{ asset('assets/front/images/background/11.jpg') }});">
    <div class="auto-container">
        <h1>Conseil Juridique</h1>
        <ul class="page-breadcrumb">
            <li><a href="/">Accueil</a></li>
            <li><a href="{{ route('member.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('member.legal.index') }}">Conseil Juridique</a></li>
            <li>Poser une question</li>
        </ul>
    </div>
</section>

<section class="dashboard-section pt-5 pb-5">
    <div class="auto-container">
        <div class="row">
            @include('front.member.partials.sidebar')

            <div class="col-lg-9 col-md-12 col-12">
                <div class="card border-0 shadow-sm rounded-lg overflow-hidden">
                    <div class="card-header bg-white p-4 border-0">
                        <h4 class="mb-0 font-weight-bold">Nouvelle Consultation</h4>
                        <p class="text-muted small">Posez votre question à nos experts juridiques.</p>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('member.legal.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-4">
                                <label class="font-weight-bold">Sujet de votre demande</label>
                                <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}" placeholder="Ex: Litige sur un contrat de production" required>
                                @error('subject') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label class="font-weight-bold">Catégorie</label>
                                <select name="category" class="form-control @error('category') is-invalid @enderror" required>
                                    <option value="">Sélectionnez une catégorie</option>
                                    <option value="copyright" {{ old('category') == 'copyright' ? 'selected' : '' }}>Droit d'auteur</option>
                                    <option value="contract" {{ old('category') == 'contract' ? 'selected' : '' }}>Contrats</option>
                                    <option value="social" {{ old('category') == 'social' ? 'selected' : '' }}>Social / Statut d'artiste</option>
                                    <option value="tax" {{ old('category') == 'tax' ? 'selected' : '' }}>Fiscalité</option>
                                    <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>Autre</option>
                                </select>
                                @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label class="font-weight-bold">Votre message / Question détaillée</label>
                                <textarea name="message" class="form-control @error('message') is-invalid @enderror" rows="8" placeholder="Expliquez ici votre situation de manière détaillée..." required>{{ old('message') }}</textarea>
                                @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="text-right">
                                <a href="{{ route('member.legal.index') }}" class="btn btn-light rounded-pill px-4 mr-2">Annuler</a>
                                <button type="submit" class="btn btn_orange text-white rounded-pill px-5 py-2 font-weight-bold">Envoyer ma demande</button>
                            </div>
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
    .rounded-lg { border-radius: 15px !important; }
    .btn_orange { background-color: #fa584d; border: none; }
    .btn_orange:hover { background-color: #e64b42; color: #fff; }
    .font-weight-bold { font-weight: 700 !important; }
    .form-control:focus {
        border-color: #fa584d;
        box-shadow: 0 0 0 0.2rem rgba(250, 88, 77, 0.25);
    }
</style>
@endsection
