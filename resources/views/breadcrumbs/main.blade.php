@if (count($breadcrumbs))

    <ul>
        @foreach ($breadcrumbs as $key => $breadcrumb)

            @if ($breadcrumb->url && !$loop->last)
                <li>
                    @if($key === 0) <i class="fas fa-home"></i> @endif
                    <a class="breadcrumb-link" href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
                </li>
            @else
                <li><a class="breadcrumb-link active" href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @endif

        @endforeach
    </ul>

@endif
