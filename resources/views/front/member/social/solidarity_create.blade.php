@extends('front.layouts.app')

@section('title', 'Demander une aide - COOPROM')

@section('content')
<section class="page-title" style="background-image: url({{ asset('assets/front/images/background/11.jpg') }});">
    <div class="auto-container">
        <h1>Demander une aide</h1>
        <ul class="page-breadcrumb">
            <li><a href="/">Accueil</a></li>
            <li><a href="{{ route('member.social.index') }}">Aide Sociale</a></li>
            <li>Demande</li>
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
                        <h4 class="mb-0 font-weight-bold text_orange">Nouveau formulaire de demande d'aide</h4>
                        <p class="text-muted small mb-0">Décrivez votre situation pour que notre commission puisse l'étudier.</p>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('member.social.solidarity.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 form-group mb-4">
                                    <label class="font-weight-bold small">Sujet de la demande <span class="text-danger">*</span></label>
                                    <input type="text" name="subject" class="form-control rounded-pill px-4 @error('subject') is-invalid @enderror" placeholder="Ex: Aide pour soins médicaux" required value="{{ old('subject') }}">
                                    @error('subject') <div class="invalid-feedback ml-3">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-12 form-group mb-4">
                                    <label class="font-weight-bold small">Montant estimé (FCFA)</label>
                                    <input type="number" name="amount_requested" class="form-control rounded-pill px-4 @error('amount_requested') is-invalid @enderror" placeholder="Ex: 50000" value="{{ old('amount_requested') }}">
                                    @error('amount_requested') <div class="invalid-feedback ml-3">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-12 form-group mb-4">
                                    <label class="font-weight-bold small">Description détaillée de votre situation <span class="text-danger">*</span></label>
                                    <textarea name="reason" class="form-control rounded-lg p-4 @error('reason') is-invalid @enderror" rows="5" placeholder="Expliquez nous pourquoi vous sollicitez le fonds de solidarité..." required>{{ old('reason') }}</textarea>
                                    @error('reason') <div class="invalid-feedback ml-3">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="text-right mt-3">
                                <a href="{{ route('member.social.index') }}" class="btn btn-light rounded-pill px-5 mr-2">Annuler</a>
                                <button type="submit" class="btn btn_orange text-white rounded-pill px-5 font-weight-bold shadow-sm">Envoyer la demande</button>
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
    .text_orange { color: #fa584d !important; }
    .font-weight-bold { font-weight: 700 !important; }
    .form-control:focus { border-color: #fa584d; box-shadow: none; }
</style>
@endsection
