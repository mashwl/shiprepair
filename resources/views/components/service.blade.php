<div class="card bg-transparent border-0 text-center">
    <div class="card-img">
        @if ($service->icon_class !='')
        <img loading="lazy" decoding="async" src=" {{ asset('storage/'.$service->icon_class) }} " alt="Scarlet Pena" class="rounded w-100" width="300" height="332">
        @endif
        @if ($service->short_description !='')
        <ul class=" card-social list-inline">
            <li class="list-inline-item"
                <a wire:navigate href="{{ route('serviceDetail', $service->id) }}">
                    {{ $service->short_description }}
                </a>
            </li>

        </ul>
        @endif

    </div>

    <div class="card-body">
        <h3>{{ $service->title }}</h3>
        {{--  <p>{{ $service->short_description }}</p>  --}}
    </div>
</div>
