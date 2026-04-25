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
                <li class="breadcrumb-item active" aria-current="page">Détails du Partenaire</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->

<div class="row">
    <div class="col-xl-9 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="mb-0">Partenaire : {{ $partner->name }}</h5>
                    <a href="{{ route('admin.partners.edit', $partner->uuid) }}" class="btn btn-warning btn-sm">Modifier</a>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-4 text-center mb-3">
                        <img src="{{ $partner->logo == 'default.png' ? asset('assets/front/images/resource/members/visa.jpeg') : asset('storage/partners/' . $partner->logo) }}"
                             alt="{{ $partner->name }}"
                             style="width: 100%; max-width: 200px; height: auto; object-fit: contain;" class="border p-2">
                    </div>
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tr>
                                <th width="30%">Nom :</th>
                                <td>{{ $partner->name }}</td>
                            </tr>
                            <tr>
                                <th>Téléphone :</th>
                                <td>{{ $partner->phone_number }}</td>
                            </tr>
                            <tr>
                                <th>Créé le :</th>
                                <td>{{ $partner->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="mt-4">
                    <h6>Description :</h6>
                    <div class="p-3 border rounded bg-light">
                        {!! nl2br(e($partner->description)) ?: '<span class="text-muted italic">Aucune description fournie.</span>' !!}
                    </div>
                </div>
                <div class="mt-4 text-end">
                    <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary px-4">Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
