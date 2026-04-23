@extends('front.layouts.app')

@section('title', 'Gallérie Photos - COOPROM')

@section('content')
    <!--Page Title-->
    <section class="page-title" style="background-image: url({{ asset('assets/front/images/background/12.jpg') }});">
        <div class="auto-container">
            <h1>Gallérie Photos</h1>
            <span class="title_divider"></span>
            <ul class="page-breadcrumb">
                <li><a href="{{ route('home') }}">Accueil</a></li>
                <li>La Cooprom</li>
                <li>Gallérie Photos</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->

    <!-- Portfolio Section -->
    <section class="portfolio-section portfolio-three-col">
        <div class="auto-container">
            <div class="row">
                @forelse($photos as $photo)
                    @php
                        $media = $photo->getFirstMedia('library');
                    @endphp
                    @if($media)
                        <!-- Portfolio Block Three -->
                        <div class="portfolio-block-three col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image">
                                        <a href="{{ $media->getUrl() }}" class="lightbox-image" data-fancybox="gallery">
                                            <img src="{{ $media->getUrl('thumb') }}" alt="{{ $photo->title }}" class="portfolio_image" onerror="this.src='{{ $media->getUrl() }}';">
                                        </a>
                                    </figure>
                                </div>
                                <div class="lower-content">
                                    <h4><a href="javascript:;">{{ $photo->title }}</a></h4>
                                    @if($photo->description)
                                        <p>{{ Str::limit($photo->description, 100) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="col-12 text-center py-5">
                        <h3>Aucune photo disponible pour le moment.</h3>
                    </div>
                @endforelse
            </div>

            <!-- Styled Pagination -->
            <div class="styled-pagination text-center">
                {{ $photos->links('vendor.pagination.custom') }}
            </div>
        </div>
    </section>
    <!-- End Portfolio Section -->
@endsection

@section('extra_js')
<script>
    jQuery(document).ready(function($) {
        // Test direct click binding
        $('[data-fancybox="gallery"]').on('click', function(e) {
            console.log('[DEBUG] Click detected on image link!', this.href);
        });

        $('[data-fancybox="gallery"]').fancybox({
            animationEffect: 'fade',
            transitionEffect: 'slide',
            buttons: ['zoom','slideShow','fullScreen','download','thumbs','close']
        });

        // Also try manual trigger approach
        $('.lightbox-image').on('click', function(e) {
            e.preventDefault();
            var href = $(this).attr('href');
            console.log('[DEBUG] Manual click, opening:', href);
            $.fancybox.open({
                src: href,
                type: 'image'
            });
        });
    });
</script>
@endsection

@section('extra_css')
<style>
    .portfolio_image {
        width: 100%;
        height: 250px;
        object-fit: contain;
        background-color: #f8f9fa;
        transition: all 0.3s ease;
        display: block;
    }
    .portfolio-block-three .inner-box {
        border: 1px solid #eee;
        border-radius: 8px;
        overflow: hidden;
        background: #fff;
    }
    .portfolio-block-three .image-box {
        position: relative;
        overflow: hidden;
        background: #f8f9fa;
    }
    .portfolio-block-three .image-box .image {
        margin: 0;
    }
    .portfolio-block-three .inner-box:hover .portfolio_image {
        transform: scale(1.05);
    }
    .portfolio-block-three .image-box:after {
        content: "\f00e";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        font-size: 20px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0);
        background: rgba(250, 88, 77, 0.9);
        color: #fff;
        width: 50px;
        height: 50px;
        line-height: 50px;
        text-align: center;
        border-radius: 50%;
        transition: all 0.3s ease;
        pointer-events: none;
        z-index: 2;
    }
    .portfolio-block-three .inner-box:hover .image-box:after {
        transform: translate(-50%, -50%) scale(1);
    }
    .portfolio-block-three .lower-content {
        padding: 20px;
    }
</style>
@endsection

