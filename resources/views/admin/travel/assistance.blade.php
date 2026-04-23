@extends('admin.layouts.app')

@section('title', 'Assistance Voyage - COOPROM Admin')

@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Opérations Métiers</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Assistance Voyage</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="mb-0">Assistance Voyage</h5>
            <hr/>
            <p>Gestion des demandes d'assistance voyage, assurances et support logistique pour les adhérents.</p>
        </div>
    </div>
@endsection
