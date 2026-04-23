@extends('admin.layouts.app')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Utilisateurs</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Nouveau Utilisateur</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->

<div class="row">
    <div class="col-xl-12 mx-auto">
        <h6 class="mb-0 text-uppercase">Ajouter un utilisateur</h6>
        <hr/>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('admin.user._form')
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary px-5">Enregistrer</button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary px-5">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
