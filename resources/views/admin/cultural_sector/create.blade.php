@extends('admin.layouts.app')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Equipes</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.cultural-sectors.index') }}">Secteurs Culturels</a></li>
                <li class="breadcrumb-item active" aria-current="page">Nouveau</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->

<div class="row">
    <div class="col-xl-12 mx-auto">
        <h6 class="mb-0 text-uppercase">Créer un Secteur Culturel</h6>
        <hr/>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.cultural-sectors.store') }}" method="POST">
                    @csrf
                    @include('admin.cultural_sector._form')
                    <div class="mt-3">
                        <button type="submit" class="btn btn-outline-primary px-5 radius-30">Enregistrer</button>
                        <a href="{{ route('admin.cultural-sectors.index') }}" class="btn btn-outline-secondary px-5 radius-30">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
