@extends('front.layouts.app')

@section('title', 'Demander Assistance Visa - COOPROM')

@section('content')

    @php
        $image_link = 'assets/front/images/resource/members/visa.jpeg';
        $title = 'Assistance Visa';
        $breadcumb_table = ['Nouvelle demande']
    @endphp
    @include('front.member.partials.slide_header')

    <section class="dashboard-section pt-5 pb-5">
        <div class="auto-container">
            <div class="row">
                @include('front.member.partials.sidebar')

                <div class="col-lg-9 col-md-12 col-12">
                    <div class="inner-column bg-white p-4 rounded shadow-sm">
                        <h3>Nouvelle Demande d'Assistance Visa</h3>
                        <p>Veuillez remplir les informations pour que nous puissions vous assister dans vos
                            démarches.</p>
                        <hr>

                        <div class="contact-form default-form">
                            <form method="post" action="{{ route('member.travels.store_visa') }}">
                                @csrf
                                @include('front.member.travels._form')

                                <div class="col-lg-12 col-md-12 col-sm-12 form-group text-right">
                                    <button class="theme-btn btn-style-one bg_orange text-white" type="submit"><span
                                            class="btn-title">Envoyer la demande</span></button>
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
        .bg_orange {
            background-color: #fa584d !important;
        }
    </style>
@endsection
