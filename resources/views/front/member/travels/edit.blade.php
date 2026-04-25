@extends('front.layouts.app')

@section('title', 'Modifier ma Demande - COOPROM')

@section('content')

    @php
        $image_link = 'assets/front/images/resource/members/visa.jpeg';
        $title = 'Modifier Demande Visa';
        $breadcumb_table = [
            'member.travels.index' => 'Mes Demandes',
            'Modifier'];
    @endphp
    @include('front.member.partials.slide_header')

    <section class="dashboard-section pt-5 pb-5">
        <div class="auto-container">
            <div class="row">
                @include('front.member.partials.sidebar')

                <div class="col-lg-9 col-md-12 col-12">
                    <div class="inner-column bg-white p-4 rounded shadow-sm">
                        <h3>Modifier ma demande d'assistance visa</h3>
                        <p>Vous pouvez mettre à jour les informations de votre demande.</p>
                        <hr>

                        <div class="contact-form default-form">
                            <form method="post"
                                  action="{{ route('member.travels.update_visa', $visaApplication->uuid) }}">
                                @csrf
                                @method('PUT')
                                @include('front.member.travels._form')

                                <div class="col-lg-12 col-md-12 col-sm-12 form-group text-right">
                                    <a href="{{ route('member.travels.index') }}"
                                       class="theme-btn btn-style-two mr-2"><span class="btn-title">Annuler</span></a>
                                    <button class="theme-btn btn-style-one bg_orange text-white" type="submit"><span
                                            class="btn-title">Enregistrer les modifications</span></button>
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
