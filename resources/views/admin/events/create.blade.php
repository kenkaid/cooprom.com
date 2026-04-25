@extends('admin.layouts.app')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Organisation</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">Événements</a></li>
                <li class="breadcrumb-item active" aria-current="page">Nouveau</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h6 class="mb-0 text-uppercase">Créer un événement</h6>
                <hr/>
                <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="alert alert-info border-0 bg-light-info alert-dismissible fade show">
                        <div class="d-flex align-items-center">
                            <div class="fs-3 text-info"><i class="bi bi-info-circle-fill"></i></div>
                            <div class="ms-3">
                                <div class="text-info">Complétez les informations pour le suivi budgétaire et technique dès la création pour une meilleure organisation.</div>
                            </div>
                        </div>
                    </div>
                    @include('admin.events._form')

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Annuler</a>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
