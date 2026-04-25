@extends('admin.layouts.app')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Configuration</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.partners.index') }}">Partenaires</a></li>
                <li class="breadcrumb-item active" aria-current="page">Modifier Partenaire</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->

<div class="row">
    <div class="col-xl-9 mx-auto">
        <div class="card">
            <div class="card-body">
                <h6 class="mb-0 text-uppercase">Informations du partenaire : {{ $partner->name }}</h6>
                <hr/>
                <form action="{{ route('admin.partners.update', $partner->uuid) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('admin.partners._form')
                    <div class="mb-3 text-end">
                        <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary px-4">Annuler</a>
                        <button type="submit" class="btn btn-primary px-4">Mettre à jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
