@extends('layouts.app')

@section('title', 'About Us - Laboratory & Science Research')

@section('content')
<!-- page title start -->
<section class="page-title" data-bg-img="{{ asset('images/bg/02.jpg') }}">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <h1>
          {{ __('About Us') }}
        </h1>
        <nav aria-label="breadcrumb" class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ route('home') }}">
                <i class="bi bi-house-door me-1"></i>{{ __('Home') }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('About Us') }}</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <div id="particles-js"></div>
</section>
<!-- page title end -->

<!-- about start -->
<section class="pt-120">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 col-md-12">
        <img src="{{ asset('images/about/01.jpg') }}" class="img-fluid rounded" alt="">
      </div>
      <div class="col-lg-6 col-md-12 mt-8 mt-lg-0">
        <div class="theme-title">
          <h6>{{ t($about, 'subtitle', app()->getLocale()) ?? __('What We Do') }}</h6>
          <h2>{!! t($about, 'title', app()->getLocale()) ?? __('Strong Values That Bring <span>Great People Together.</span>') !!}</h2>
          <p>{{ t($about, 'description', app()->getLocale()) ?? __('We redefine the boundaries of scientific exploration Our state-of-the-art laboratory and dedicated research teams are committed to advancing knowledge.') }}</p>
        </div>
        @if(!empty($about_features ?? []))
          @foreach($about_features as $feature)
          <div class="featured-item style-6 mb-5">
            <div class="featured-icon">
              <i class="flaticon flaticon-check-mark"></i>
            </div>
            <div class="featured-desc">
              <div class="featured-title">
                <h4>{{ t($feature, 'title', app()->getLocale()) }}</h4>
              </div>
              <p>{{ t($feature, 'description', app()->getLocale()) }}</p>
            </div>
          </div>
          @endforeach
        @endif
      </div>
    </div>
  </div>
</section>
<!-- about end -->

<!-- about text -->
<section class="pt-0">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-12 col-md-12 mt-8 mt-lg-0">
        <div class="theme-title">
          <h3>{{ t($about, 'additional_title', app()->getLocale()) ?? __('Strong Values That Bring') }}</h3>
          <p>{{ t($about, 'additional_description', app()->getLocale()) ?? __('We redefine the boundaries of scientific exploration Our state-of-the-art laboratory and dedicated research teams are committed to advancing knowledge.') }}</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- about text end -->

<!-- timeline section -->
<section class="overflow-hidden">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="main-timeline position-relative">
          @foreach($timeline ?? [] as $item)
          <div class="timeline_item">
            <div class="date-content {{ $loop->index % 2 == 0 ? 'timeline-order-1b' : 'timeline-order-1' }}">
              <div class="date">
                {{ $item->year }}
              </div>
            </div>
            <div class="timeline-icon {{ $loop->index % 2 == 0 ? 'timeline-order-2b' : 'timeline-order-2' }}">
              <i class="{{ $item->icon }}"></i>
            </div>
            <div class="timeline-content {{ $loop->index % 2 == 0 ? 'timeline-order-3b' : 'timeline-order-3' }} col-md">
              <h4>{{ t($item, 'title', app()->getLocale()) }}</h4>
              <p>{{ t($item, 'description', app()->getLocale()) }}</p>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
<!-- timeline section end -->
@endsection