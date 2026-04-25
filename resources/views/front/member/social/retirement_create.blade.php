@extends('front.layouts.app')

@section('title', 'Accompagnement Retraite - COOPROM')

@section('content')

    @php
        $image_link = 'assets/front/images/resource/members/social.jpeg';
        $title = 'Accompagnement Retraite';
        $breadcumb_table = ['member.social.index' => 'Aide Sociale', 'Simulation Retraite'];
    @endphp
    @include('front.member.partials.slide_header')

    <section class="dashboard-section pt-5 pb-5">
        <div class="auto-container">
            <div class="row">
                @include('front.member.partials.sidebar')

                <div class="col-lg-9 col-md-12 col-12">
                    <div class="card border-0 shadow-sm rounded-lg overflow-hidden">
                        <div class="card-header bg-white p-4 border-0">
                            <h4 class="mb-0 font-weight-bold text-info">Préparer ma retraite</h4>
                            <p class="text-muted small mb-0">Remplissez ces informations pour obtenir un accompagnement
                                personnalisé sur votre dossier de retraite.</p>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('member.social.retirement.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 form-group mb-4">
                                        <label class="font-weight-bold small">Votre âge actuel</label>
                                        <input type="number" name="current_age"
                                               class="form-control rounded-pill px-4 @error('current_age') is-invalid @enderror"
                                               placeholder="Ex: 35" value="{{ old('current_age') }}">
                                        @error('current_age')
                                        <div class="invalid-feedback ml-3">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 form-group mb-4">
                                        <label class="font-weight-bold small">Âge de départ souhaité</label>
                                        <input type="number" name="target_retirement_age"
                                               class="form-control rounded-pill px-4 @error('target_retirement_age') is-invalid @enderror"
                                               placeholder="Ex: 60" value="{{ old('target_retirement_age') }}">
                                        @error('target_retirement_age')
                                        <div class="invalid-feedback ml-3">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-12 form-group mb-4">
                                        <label class="font-weight-bold small">Notes ou questions spécifiques</label>
                                        <textarea name="notes"
                                                  class="form-control rounded-lg p-4 @error('notes') is-invalid @enderror"
                                                  rows="4"
                                                  placeholder="Précisez ici vos attentes ou votre situation actuelle (années de cotisation déjà effectuées, etc.)">{{ old('notes') }}</textarea>
                                        @error('notes')
                                        <div class="invalid-feedback ml-3">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="alert alert-light border-0 rounded-lg p-3 small text-muted mb-4">
                                    <i class="fa fa-info-circle mr-2 text-info"></i> <strong>Note :</strong> Cette
                                    simulation est à titre indicatif. Un conseiller COOPROM prendra contact avec vous
                                    pour analyser vos droits réels.
                                </div>

                                <div class="text-right mt-3">
                                    <a href="{{ route('member.social.index') }}"
                                       class="btn btn-light rounded-pill px-5 mr-2">Annuler</a>
                                    <button type="submit"
                                            class="btn btn-info text-white rounded-pill px-5 font-weight-bold shadow-sm">
                                        Envoyer le dossier
                                    </button>
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
        .rounded-lg {
            border-radius: 15px !important;
        }

        .font-weight-bold {
            font-weight: 700 !important;
        }

        .form-control:focus {
            border-color: #17a2b8;
            box-shadow: none;
        }
    </style>
@endsection
