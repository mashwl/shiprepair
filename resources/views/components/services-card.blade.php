    <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
        <div class="service-item">
            <div class="service-inner">
                <div class="service-img">
                    <img src="{{$service -> getFirstMediaUrl()}}" class="img-fluid w-100 rounded" alt="{{ $service->title }}">
                </div>
                <div class="service-title">
                    <div class="service-title-name">
                        <div class="bg-primary text-center rounded p-3 mx-5 mb-4">
                            <a href="#" class="h4 text-white mb-0">{{ $service->title }}</a>
                        </div>
                        <a class="btn bg-light text-secondary rounded-pill py-3 px-5 mb-4" href="{{route('serviceDetail', $service->id)}}">Explore More</a>
                    </div>
                    <div class="service-content pb-4">
                        <a href="#"><h4 class="text-white mb-4 py-3">{{ $service->title }}</h4></a>
                        <div class="px-4">
                            <p class="mb-4">{{$service->short_description}}</p>
                            <a class="btn btn-primary border-secondary rounded-pill py-3 px-5" href="{{route('serviceDetail', $service->id) }}">Explore More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

