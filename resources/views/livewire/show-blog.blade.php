<main>
    <section class="page-header bg-tertiary">
        <!-- Page header content -->
    </section>

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="me-lg-4">
                        <div class="row gy-5">
                            @if ($articles->isNotEmpty())
                                @foreach ($articles->where('status', 1) as $article)
                                    <div class="col-md-6" data-aos="fade">
                                        <article class="blog-post">
                                            <div class="post-slider slider-sm rounded">
                                                @if ($article->image)
                                                    <img loading="lazy" decoding="async" src="{{ asset('storage/'.$article->image) }}" alt="Post Thumbnail">
                                                @endif
                                            </div>
                                            <div class="pt-4">
                                                <p class="mb-3">{{ \Carbon\Carbon::parse($article->created_at)->format('d M, Y') }}</p>
                                                <h2 class="h4">
                                                    <a class="text-black" wire:navigate href="{{ route('blogDetail', $article->id) }}">{{ $article->title }}</a>
                                                </h2>
                                                <a wire:navigate href="{{ route('blogDetail', $article->id) }}" class="text-primary fw-bold" aria-label="Read the full article by clicking here">Read More</a>
                                            </div>
                                        </article>
                                    </div>
                                @endforeach
                            @else
                                <p>No articles available.</p>
                            @endif

                            <div class="col-12">
                                {{ $articles->links() }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <!-- Categories -->
                    <!-- Categories -->
                    <!-- Tags -->
                    <div class="widget widget-categories">
                        <h4 class="widget-title"><span>Categories</span></h4>
                        <ul class="list-inline widget-list widget-list-inline taxonomies-list">
                            @if ($categories->isNotEmpty())
                                @foreach ($categories->where('status',1) as $category)
                                    <li class="d-inline me-2">
                                        <a wire:navigate href="{{ route('blog', ['categorySlug' => $category->slug]) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            @else
                                <p>No tags available.</p>
                            @endif
                        </ul>
                    </div>




                    <!-- Tags -->
                    <div class="widget widget-tags">
                        <h4 class="widget-title"><span>Tags</span></h4>
                        <ul class="list-inline widget-list widget-list-inline taxonomies-list">
                            @if ($tags->isNotEmpty())
                                @foreach ($tags as $tag)
                                    <li class="d-inline me-2">
                                        <a wire:navigate href="{{ route('blog', ['tagSlug' => $tag->slug]) }}">{{ $tag->name }}</a>
                                    </li>
                                @endforeach
                            @else
                                <p>No tags available.</p>
                            @endif
                        </ul>
                    </div>

                    <!-- Latest Posts -->
                    <div class="widget">
                        <h5 class="widget-title"><span>Latest Article</span></h5>
                        @if ($latestArticles->isNotEmpty())
                            @foreach ($latestArticles->where('status', 1) as $latestArticle)
                                <ul class="list-unstyled widget-list">
                                    <li class="d-flex widget-post align-items-center">
                                        <a class="text-black" wire:navigate href="{{ route('blogDetail', $latestArticle->id) }}">
                                            <div class="widget-post-image flex-shrink-0 me-3">
                                                @if ($latestArticle->image)
                                                    <img loading="lazy" decoding="async" src="{{ asset('storage/'.$latestArticle->image) }}" alt="Post Thumbnail">
                                                @endif
                                            </div>
                                        </a>
                                        <div class="flex-grow-1">
                                            <h5 class="h6 mb-0"><a class="text-black" href="{{ route('blogDetail', $latestArticle->id) }}">{{ $latestArticle->title }}</a></h5>
                                            <small>{{ \Carbon\Carbon::parse($latestArticle->created_at)->format('d M, Y') }}</small>
                                        </div>
                                    </li>
                                </ul>
                            @endforeach
                        @else
                            <p>No latest articles available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
