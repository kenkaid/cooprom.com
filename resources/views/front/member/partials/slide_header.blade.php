<section class="page-title"
         style="background-image: url({{ asset($image_link) }});">
    <div class="auto-container">
        <h1>{{ $title  }}</h1>
        <ul class="page-breadcrumb">
            <li><a href="/">Accueil</a></li>
            <li><a href="{{ route('member.dashboard') }}">Dashboard</a></li>
            @php $i=0; @endphp
            @foreach ($breadcumb_table as $root_link => $breadcumb_title )
                @php $i++;  @endphp
                <li>
                    @if($i < count($breadcumb_table))
                        <a href="{{ route($root_link) }}">{{ $breadcumb_title }}</a>
                    @else
                        {{ $breadcumb_title }}
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</section>
