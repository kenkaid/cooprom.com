@extends('admin.layouts.app')

@section('title', 'Modifier Partenaire Santé - COOPROM Admin')

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Aide Sociale</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.health-insurances.index') }}">Santé & Prévoyance</a></li>
                <li class="breadcrumb-item active" aria-current="page">Modifier</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('admin.health-insurances.update', $healthInsurance) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('admin.health_insurance._form')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
