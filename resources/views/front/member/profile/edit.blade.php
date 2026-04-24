@extends('front.layouts.app')

@section('title', 'Mon Profil - COOPROM')

@section('content')
<!-- Page Title -->
<section class="page-title" style="background-image: url({{ asset('assets/front/images/resource/members/my_profil.jpeg') }});">
    <div class="auto-container">
        <h1 class="text-white">Mon Profil</h1>
        <ul class="page-breadcrumb">
            <li><a href="/">Accueil</a></li>
            <li><a href="{{ route('member.dashboard') }}">Tableau de bord</a></li>
            <li>Profil</li>
        </ul>
    </div>
</section>

<!-- Dashboard Section -->
<section class="dashboard-section pt-5 pb-5">
    <div class="auto-container">
        <div class="row">
            @include('front.member.partials.sidebar')

            <!-- Contenu Principal -->
            <div class="col-lg-9 col-md-12">
                <div class="card border-0 shadow-sm rounded-lg overflow-hidden">
                    <div class="card-header bg-white p-4 border-0">
                        <h4 class="mb-0 font-weight-bold text-dark">Paramètres du profil</h4>
                        <p class="text-muted mb-0 small">Gérez vos informations personnelles et votre photo de profil.</p>
                    </div>
                    <div class="card-body p-4 border-top">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm" role="alert">
                                <i class="fa fa-check-circle mr-2"></i> {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form action="{{ route('member.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @include('front.member.profile._form')

                            <div class="col-12 mt-4 text-right">
                                <button type="submit" class="btn btn_orange text-white rounded-pill px-5 py-2 font-weight-bold shadow-sm">
                                    <i class="fa fa-save mr-2"></i> Enregistrer les modifications
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

@section('extra_js')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#photo-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection

@section('extra_css')
<style>
    .rounded-lg { border-radius: 15px !important; }
    .btn_orange { background-color: #fa584d; border: none; }
    .btn_orange:hover { background-color: #e64b42; color: #fff; }
    .font-weight-bold { font-weight: 700 !important; }
    .form-control {
        border-color: #eee;
        height: 50px;
        transition: all 0.3s;
    }
    .form-control:focus {
        border-color: #fa584d;
        box-shadow: 0 0 0 0.2rem rgba(250, 88, 77, 0.1);
    }
    .profile-photo-wrapper label:hover {
        transform: scale(1.1);
        transition: transform 0.2s;
    }
</style>
@endsection
