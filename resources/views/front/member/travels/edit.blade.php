@extends('front.layouts.app')

@section('title', 'Modifier ma Demande - COOPROM')

@section('content')
<section class="page-title" style="background-image: url({{ asset('assets/front/images/background/11.jpg') }});">
    <div class="auto-container">
        <h1>Modifier Demande Visa</h1>
        <ul class="page-breadcrumb">
            <li><a href="/">Accueil</a></li>
            <li><a href="{{ route('member.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('member.travels.index') }}">Mes Demandes</a></li>
            <li>Modifier</li>
        </ul>
    </div>
</section>

<section class="dashboard-section pt-5 pb-5">
    <div class="auto-container">
        <div class="row">
            @include('front.member.partials.sidebar')

            <div class="col-lg-9 col-md-12">
                <div class="inner-column bg-white p-4 rounded shadow-sm">
                    <h3>Modifier ma demande d'assistance visa</h3>
                    <p>Vous pouvez mettre à jour les informations de votre demande.</p>
                    <hr>

                    <div class="contact-form default-form">
                        <form method="post" action="{{ route('member.travels.update_visa', $visaApplication->uuid) }}">
                            @csrf
                            @method('PUT')
                            @include('front.member.travels._form')

                            <div class="col-lg-12 col-md-12 col-sm-12 form-group text-right">
                                <a href="{{ route('member.travels.index') }}" class="theme-btn btn-style-two mr-2"><span class="btn-title">Annuler</span></a>
                                <button class="theme-btn btn-style-one bg_orange text-white" type="submit"><span class="btn-title">Enregistrer les modifications</span></button>
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
    .bg_orange { background-color: #fa584d !important; }
</style>
@endsection
