@extends('admin.layouts.app')

@section('title', 'Modifier Guide Visa - COOPROM Admin')

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Orientation Visa</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.visa-guides.index') }}">Guides Visa</a></li>
                <li class="breadcrumb-item active" aria-current="page">Modifier le Guide</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-xl-9 mx-auto">
        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Modifier le guide : {{ $visaGuide->country }}</h5>
                <form action="{{ route('admin.visa-guides.update', $visaGuide->uuid) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('admin.visa_guide._form', ['guide' => $visaGuide])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
