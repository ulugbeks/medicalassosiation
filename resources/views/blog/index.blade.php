@extends('layouts.app')

@section('title', 'Blog - Laboratory & Science Research')

@section('content')
<!--page title start-->
<section class="page-title" data-bg-img="{{ asset('images/bg/02.jpg') }}">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <h1>
          Blog
        </h1>
        <nav aria-label="breadcrumb" class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ route('home') }}">
                <i class="bi bi-house-door me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Blog</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <div id="particles-js"></div>
</section>
<!--page title end-->

<!--body content start-->
<div class="page-content">
  <section class="themeht-blogs">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-12 order-lg-12">
          @if($posts && count($posts) > 0)
            @foreach($posts as $post)
            <div class="post-card post-classic">
              @if($post->featured_image)
              <div class="post-image">
                <img class="img-fluid w-100" src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}">
              </div>
              @endif
              <div class="post-desc">
                <div class="post-bottom">
                  <ul class="list-inline">
                    @if($post->author_name)
                    <li class="list-inline-item">
                        <i class="bi bi-person"></i> 
                        @if($post->author_link)
                            <a href="{{ $post->author_link }}" target="_blank">{{ $post->author_name }}</a>
                        @else
                            {{ $post->author_name }}
                        @endif
                    </li>
                    @endif
                    <li class="list-inline-item">
                      <i class="bi bi-calendar3"></i>{{ $post->created_at->format('d F, Y') }}
                    </li>
                    @if($post->category)
                    <li class="list-inline-item">
                      <i class="bi bi-tag"></i> {{ $post->category->name }}
                    </li>
                    @endif
                  </ul>
                </div>
                <div class="post-title">
                  <h4>
                    <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                  </h4>
                </div>
                <p>{{ $post->excerpt }}</p>
                <a class="themeht-btn primary-btn" href="{{ route('blog.show', $post->slug) }}">Learn More</a>
              </div>
            </div>
            @endforeach

            <!-- Pagination -->
            {{ $posts->links('vendor.pagination.custom') }}
          @else
            <div class="alert alert-info">
              No blog posts found.
            </div>
          @endif
        </div>
        <div class="col-lg-4 col-md-12 order-lg-1 mt-7 mt-lg-0 ps-lg-10">
          <div class="themeht-sidebar">
            <div class="widget">
              <h5 class="widget-title">Recent Post</h5>
              <div class="recent-post">
                <ul class="list-unstyled">
                  @if($recent_posts && count($recent_posts) > 0)
                    @foreach($recent_posts as $recent)
                    <li class="{{ !$loop->last ? 'mb-3' : '' }}">
                      <div class="recent-post-thumb">
                        <img class="img-fluid" src="{{ asset($recent->featured_image) }}" alt="{{ $recent->title }}">
                      </div>
                      <div class="recent-post-desc">
                        <a href="{{ route('blog.show', $recent->slug) }}">{{ $recent->title }}</a>
                        <div class="post-date-small">{{ $recent->created_at->format('d F, Y') }}</div>
                      </div>
                    </li>
                    @endforeach
                  @else
                    <li>No recent posts</li>
                  @endif
                </ul>
              </div>
            </div>
            <div class="widget">
              <h5 class="widget-title">Categories</h5>
              <ul class="widget-categories list-unstyled">
                @if($categories && count($categories) > 0)
                  @foreach($categories as $category)
                  <li>
                    <a href="{{ route('blog.category', $category->slug) }}">{{ $category->name }} <span>({{ $category->posts_count }})</span></a>
                  </li>
                  @endforeach
                @else
                  <li>No categories</li>
                @endif
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!--body content end-->
@endsection