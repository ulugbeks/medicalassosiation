@extends('layouts.app')

@section('title', 'Home - Laboratory & Science Research')

@section('content')
<!-- hero section start -->
<div class="swiper banner-swiper banner-slider">
  <div class="swiper-wrapper">
    @foreach($sliders ?? [] as $slider)
    <div class="swiper-slide">
      <div class="slider-img" style="background-image: url('{{ asset($slider->image_path) }}'); background-size: cover; background-position: center center;"></div>
      <div class="banner-content">
        <div class="banner-text">
          <h6>{{ $slider->getTranslation('subtitle', app()->getLocale(), false) }}</h6>
          <h1 class="mb-5">{!! $slider->getTranslation('title', app()->getLocale(), false) !!}</h1>
          <p>{{ $slider->getTranslation('description', app()->getLocale(), false) }}</p>
          <div class="btn-box mt-5">
            <a class="themeht-btn primary-btn" href="{{ $slider->primary_button_url }}">{{ $slider->getTranslation('primary_button_text', app()->getLocale(), false) }}</a>
            <a class="themeht-btn dark-btn" href="{{ $slider->secondary_button_url }}">{{ $slider->getTranslation('secondary_button_text', app()->getLocale(), false) }}</a>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div id="banner-swiper-button-next" class="swiper-button-next"></div>
  <div id="banner-swiper-button-prev" class="swiper-button-prev"></div>
</div>
<!-- hero section end -->

<!-- feature section start -->
<section>
  <div class="container">
    <div class="row gx-lg-4">
      @foreach($features ?? [] as $index => $feature)
      <div class="col-lg-3 col-md-6 {{ $index > 0 ? 'mt-6 mt-md-0' : '' }}">
        <div class="featured-item style-1 {{ $feature->active ? 'featured-active' : '' }}">
          <div class="featured-icon">
            <i class="{{ $feature->icon }}"></i>
          </div>
          <div class="featured-desc">
            <div class="featured-title">
              <h4>{{ $feature->getTranslation('title', app()->getLocale(), false) }}</h4>
              <p>{{ $feature->getTranslation('description', app()->getLocale(), false) }}</p>
              <a class="ht-link-btn" href="{{ $feature->link_url }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="arr-2" viewBox="0 0 24 24">
                  <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                </svg>
                <span>{{ __('Read More') }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="arr-1" viewBox="0 0 24 24">
                  <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <div class="animated-icon-shape">
    <img class="img-fluid small-circle-animation" src="{{ asset('images/small-icon/01.png') }}" alt="">
    <img class="img-fluid small-circle-animation" src="{{ asset('images/small-icon/02.png') }}" alt="">
    <img class="img-fluid small-circle-animation" src="{{ asset('images/small-icon/03.png') }}" alt="">
    <img class="img-fluid small-circle-animation" src="{{ asset('images/small-icon/04.png') }}" alt="">
  </div>
</section>
<!-- feature section end -->

<!-- marquee start -->
<section class="overflow-hidden p-0">
  <div class="container-fluid p-0">
    <div class="row">
      <div class="col">
        <div class="marquee-wrap">
          <div class="marquee-text">
            <span>{{ __('Laboratory') }}</span>
            <span>{{ __('Science') }}</span>
            <span>{{ __('Research') }}</span>
            <span>{{ __('Laboratory') }}</span>
            <span>{{ __('Science') }}</span>
            <span>{{ __('Research') }}</span>
            <span>{{ __('Laboratory') }}</span>
            <span>{{ __('Science') }}</span>
            <span>{{ __('Research') }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- marquee end -->

<!-- about section start -->
<section>
  <div class="container">
    <div class="row align-items-center justify-content-between">
      <div class="col-lg-6 col-12">
        <div class="row g-0">
          <div class="col-md-6 mb-4 mb-md-0">
            <div class="about1-img-shape w-100 h-100">
              <img class="img-fluid" src="{{ asset($about->image1 ?? 'images/about/01.jpg') }}" alt="">
            </div>
          </div>
          <div class="col-md-6 mb-4 mb-md-0">
            <div class="about1-img-shape w-100 h-100">
              <img class="img-fluid" src="{{ asset($about->image2 ?? 'images/about/02.jpg') }}" alt="">
            </div>
          </div>
        </div>
        <div class="row g-0 mt-md-n5 justify-content-center text-center">
          <div class="col-md-6">
            <div class="about1-img-shape w-100 h-100">
              <img class="img-fluid" src="{{ asset($about->image3 ?? 'images/about/08.jpg') }}" alt="">
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-12 mt-6 mt-lg-0 ps-lg-8">
        <div class="theme-title">
          <h6>{{ $about->getTranslation('subtitle', app()->getLocale(), false) ?? __('About Us') }}</h6>
          <h2>{!! $about->getTranslation('title', app()->getLocale(), false) ?? __('Experiment With The Best <span>Lab Test And Service</span>') !!}</h2>
          <p>{{ $about->getTranslation('description', app()->getLocale(), false) ?? __('With a belief that knowledge is power, we connect our patients directly with their results so they have valuable health information when they need it most.') }}</p>
        </div>
        <div class="row mt-4 mb-3">
          @php
            $about_features = [];
            if(isset($about->features)) {
                $about_features = is_string($about->features) ? json_decode($about->features) : $about->features;
                if(!is_array($about_features)) $about_features = [];
            }
          @endphp
          
          @if(!empty($about_features))
            @foreach($about_features as $index => $feature)
              @if($index % 2 == 0)
                <div class="col-md-6">
                  <ul class="list-unstyled list-icon style-2 mb-0">
                    <li class="mb-3">
                      <i class="bi bi-check2-all"></i> {{ $feature }}
                    </li>
              @else
                    <li>
                      <i class="bi bi-check2-all"></i> {{ $feature }}
                    </li>
                  </ul>
                </div>
              @endif
            @endforeach
          @endif
        </div>
        <hr class="border border-light">
        <div class="row mt-5 mb-5">
          <div class="col-md-6">
            <img class="img-fluid" src="{{ asset($about->signature_image ?? 'images/sign.png') }}" alt="">
          </div>
          <div class="col-md-6 mt-3 mt-md-0">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <img class="rounded-circle" src="{{ asset($about->doctor_image ?? 'images/about-thumb.jpg') }}" alt="...">
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-0">{{ $about->getTranslation('doctor_name', app()->getLocale(), false) ?? __('Dr. Abigail George') }}</h6>
                <label class="text-theme">{{ $about->getTranslation('doctor_title', app()->getLocale(), false) ?? __('Laboratory Specialist') }}</label>
              </div>
            </div>
          </div>
        </div>
        <a class="themeht-btn primary-btn" href="{{ route('about') }}">{{ __('More About Us') }}</a>
      </div>
    </div>
  </div>
</section>
<!-- about section end -->

<!-- services section start -->
@if(!empty($services ?? []))
<!-- <section class="z-index-1 primary-bg position-relative" data-bg-img="{{ asset('images/bg/04.png') }}">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-xl-6 col-lg-8 col-md-12">
        <div class="theme-title text-white">
          <h6>{{ __('Our Services') }}</h6>
          <h2>{{ __('Comprehensive Solutions For') }} <span>{{ __('Every Challenge.') }}</span></h2>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid px-lg-8">
    <div class="row">
      <div class="col">
        <div class="swiper service-swiper">
          <div class="swiper-wrapper">
            @foreach($services as $service)
            <div class="swiper-slide">
              <div class="service-item style-2">
                <div class="service-img">
                  <img class="img-fluid" src="{{ asset($service->image) }}" alt="{{ $service->getTranslation('title', app()->getLocale(), false) }}">
                  <div class="service-icon">
                    <i class="{{ $service->icon }}"></i>
                  </div>
                </div>
                <div class="service-desc">
                  <div class="service-title">
                    <h4>{{ $service->getTranslation('title', app()->getLocale(), false) }}</h4>
                  </div>
                  <p>{{ $service->getTranslation('description', app()->getLocale(), false) }}</p>
                  <a class="ht-link-btn" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" class="arr-2" viewBox="0 0 24 24">
                      <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                    </svg>
                    <span>{{ __('Read More') }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="arr-1" viewBox="0 0 24 24">
                      <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                    </svg>
                  </a>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <div class="swiper-dots-white">
            <div id="service-pagination" class="swiper-pagination"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> -->
@endif
<!-- services section end -->

<!-- about section 2 start -->
<section>
  <div class="container">
    <div class="row align-items-center justify-content-between">
      <div class="col-lg-6 col-12 mb-5 mb-lg-0 order-lg-1 position-relative">
        <div class="about-img-shape">
          <img class="img-fluid" src="{{ asset('images/about/03.jpg') }}" alt="">
        </div>
        <div class="about-img-shape-small">
          <img class="img-fluid" src="{{ asset('images/about/04.jpg') }}" alt="">
        </div>
        <div class="about-counter position-absolute start-0 top-50 topBottom">
          <div class="counter">
            <div class="counter-desc">
              <span class="count-number" data-count="{{ $about->second_section_years ?? 15 }}"></span>
              <span>+</span>
              <h6>{{ __('Years of Experience') }}</h6>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-12 mt-10 mt-lg-0 pe-md-8">
        <div class="theme-title">
          <h6>{{ $about->getTranslation('second_section_subtitle', app()->getLocale(), false) ?? __('Who We Are') }}</h6>
          <h2>{!! $about->getTranslation('second_section_title', app()->getLocale(), false) ?? __('Discover Our Commitment to <span>Research Center</span>') !!}</h2>
          <p>{{ $about->getTranslation('second_section_description', app()->getLocale(), false) ?? __('Delivering cutting-edge scientific services with precise testing, research support, and consultation, committed to excellence and advancement in every project.') }}</p>
        </div>
        <div class="row mt-5 mb-5">
          <div class="col-md-6">
            <div class="featured-item style-2">
              <div class="featured-top">
                <div class="featured-icon">
                  <i class="flaticon flaticon-laboratory"></i>
                </div>
                <div class="featured-title">
                  <h4>{{ $about->getTranslation('second_section_feature1_title', app()->getLocale(), false) ?? __('Medical laboratory Technician') }}</h4>
                </div>
              </div>
              <div class="featured-desc">
                <p>{{ $about->getTranslation('second_section_feature1_description', app()->getLocale(), false) ?? __('New evidence has been published on the protein dosing patients.') }}</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="featured-item style-2">
              <div class="featured-top">
                <div class="featured-icon">
                  <i class="flaticon flaticon-microscope"></i>
                </div>
                <div class="featured-title">
                  <h4>{{ $about->getTranslation('second_section_feature2_title', app()->getLocale(), false) ?? __('10+ Quality Research Center') }}</h4>
                </div>
              </div>
              <div class="featured-desc">
                <p>{{ $about->getTranslation('second_section_feature2_description', app()->getLocale(), false) ?? __('We believe in fostering collaboration, innovation, and a knowledge.') }}</p>
              </div>
            </div>
          </div>
        </div>
        <a class="themeht-btn primary-btn" href="{{ route('about') }}">{{ __('More About Us') }}</a>
      </div>
    </div>
  </div>
</section>
<!-- about section 2 end -->

<!-- marquee start -->
<section class="pt-0 pb-8">
  <div class="container-fluid p-0">
    <div class="row">
      <div class="col">
        <div class="marquee-wrap">
          <div class="marquee-text">
            <span>{{ __('Our Specialist') }}</span>
            <span>{{ __('Team Member') }}</span>
            <span>{{ __('Expert Doctor') }}</span>
            <span>{{ __('Our Specialist') }}</span>
            <span>{{ __('Team Member') }}</span>
            <span>{{ __('Expert Doctor') }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- marquee end -->

<!-- team section start -->
<section class="pt-0" style="display: none;">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="swiper team-swiper">
          <div class="swiper-wrapper">
            @foreach($team_members ?? [] as $member)
            <div class="swiper-slide">
              <div class="team-member">
                <div class="team-images">
                  <img class="img-fluid rounded" src="{{ asset($member->image) }}" alt="{{ $member->getTranslation('name', app()->getLocale(), false) }}">
                  <ul class="social-icons team-social-icon list-inline mb-0">
                    @if($member->facebook)
                    <li>
                      <a href="{{ $member->facebook }}">
                        <i class="flaticon flaticon-facebook"></i>
                      </a>
                    </li>
                    @endif
                    @if($member->twitter)
                    <li>
                      <a href="{{ $member->twitter }}">
                        <i class="flaticon flaticon-twitter-1"></i>
                      </a>
                    </li>
                    @endif
                    @if($member->linkedin)
                    <li>
                      <a href="{{ $member->linkedin }}">
                        <i class="flaticon flaticon-linkedin"></i>
                      </a>
                    </li>
                    @endif
                  </ul>
                </div>
                <div class="team-desc">
                  <h4>
                    <a href="#">{{ $member->getTranslation('name', app()->getLocale(), false) }}</a>
                  </h4>
                  <span>{{ $member->getTranslation('title', app()->getLocale(), false) }}</span>
                </div>
              </div>
            </div>
            @endforeach
            
            @if(empty($team_members) || count($team_members) == 0)
            <!-- Резервные данные, если в базе нет членов команды -->
            <div class="swiper-slide">
              <div class="team-member">
                <div class="team-images">
                  <img class="img-fluid rounded" src="{{ asset('images/team/01.jpg') }}" alt="">
                  <ul class="social-icons team-social-icon list-inline mb-0">
                    <li><a href="#"><i class="flaticon flaticon-facebook"></i></a></li>
                    <li><a href="#"><i class="flaticon flaticon-twitter-1"></i></a></li>
                    <li><a href="#"><i class="flaticon flaticon-linkedin"></i></a></li>
                  </ul>
                </div>
                <div class="team-desc">
                  <h4><a href="#">{{ __('Penny Damion') }}</a></h4>
                  <span>{{ __('Lab technician') }}</span>
                </div>
              </div>
            </div>
            <!-- Остальные резервные элементы... -->
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- team section end -->

<!-- form section start -->
<section class="pt-0">
  <div class="container">
    <div class="row align-items-end mb-6">
      <div class="col-lg-6 col-md-12">
        <div class="theme-title mb-0">
          <h6>{{ $appointment_settings->getTranslation('subtitle', app()->getLocale(), false) ?? __('Book An Appointment') }}</h6>
          <h2>{{ $appointment_settings->getTranslation('title', app()->getLocale(), false) ?? __('Effortless Online Booking for') }}</h2>
        </div>
      </div>
      <div class="col-lg-5 ms-auto mt-5 mt-lg-0">
        <p>{{ $appointment_settings->getTranslation('description', app()->getLocale(), false) ?? __('We believe in a future where renewable energy sources play avital role in reducing carbon emissions. we provide a wide range of diagnostic services ranging from complete health check-up packages.') }}</p>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-12">
        <form id="contact-form" method="post" action="{{ route('contact.submit') }}">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>{{ __('Your Name') }}</label>
                <input id="form_name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('Enter Your Name') }}" required="required" value="{{ old('name') }}">
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>{{ __('Email Address') }}</label>
                <input id="form_email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Enter Email Address') }}" required="required" value="{{ old('email') }}">
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>{{ __('Phone Number') }}</label>
                <input id="form_phone" type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="{{ __('Enter Phone number') }}" required="required" value="{{ old('phone') }}">
                <input type="hidden" name="full_phone" id="full_phone">
                @error('phone')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>{{ __('Message') }}</label>
                <textarea id="form_message" name="message" class="form-control @error('message') is-invalid @enderror" placeholder="{{ __('Write Your Message Here...') }}" rows="4" required="required">{{ old('message') }}</textarea>
                @error('message')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-12 mt-3">
              <button type="submit" class="themeht-btn primary-btn">
                {{ $appointment_settings->getTranslation('button_text', app()->getLocale(), false) ?? __('Send Message') }}
              </button>
            </div>
          </div>
        </form>
      </div>
      <div class="col-lg-5 col-md-12 ms-auto mt-5 mt-lg-0">
        <div class="primary-bg p-8 rounded">
          <h4 class="text-white">{{ __('Working Hours') }}</h4>
          @php
            $working_hours = $appointment_settings->working_hours ?? [
                'Mon - Tues' => '09:00AM - 6:00PM',
                'Wed - Thu' => '09:00AM - 6:00PM',
                'Fri - Sat' => '09:00AM - 6:00PM',
                'Emergency' => '24/7 Hours 7 Days'
            ];
          @endphp
          
          @foreach($working_hours as $day => $hours)
          <div class="working-hours-item {{ $loop->last ? 'mb-0 pb-0 border-bottom-0' : '' }}">
            <span class="working-day">{{ __($day) }}</span>
            <span class="working-time">{{ $hours }}</span>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
<!-- form section end -->

<!-- portfolio section start -->
<section class="pt-0">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="theme-title">
          <h6>{{ $portfolio_heading->getTranslation('subtitle', app()->getLocale(), false) ?? __('Latest Portfolio') }}</h6>
          <h2>{{ $portfolio_heading->getTranslation('title', app()->getLocale(), false) ?? __('We\'ve Done A Lot\'s, Check') }} <span>{{ $portfolio_heading->getTranslation('title_span', app()->getLocale(), false) ?? __('Our Latest Research') }}</span></h2>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid px-lg-5">
    <div class="row">
      <div class="col">
        <div class="swiper portfolio-swiper">
          <div class="swiper-wrapper">
            @foreach($portfolios ?? [] as $portfolio)
            <div class="swiper-slide">
              <div class="portfolio-item">
                <div class="portfolio-img">
                  <img class="img-fluid w-100" src="{{ asset($portfolio->image) }}" alt="{{ $portfolio->getTranslation('title', app()->getLocale(), false) }}">
                </div>
                <div class="portfolio-desc">
                  <span>{{ $portfolio->getTranslation('category', app()->getLocale(), false) }}</span>
                  <h4>
                    <a href="#">{{ $portfolio->getTranslation('title', app()->getLocale(), false) }}</a>
                  </h4>
                </div>
              </div>
            </div>
            @endforeach
            
            @if(empty($portfolios) || count($portfolios) == 0)
            <!-- Резервные данные для портфолио, если в базе нет элементов -->
            <div class="swiper-slide">
              <div class="portfolio-item">
                <div class="portfolio-img">
                  <img class="img-fluid w-100" src="{{ asset('images/portfolio/01.jpg') }}" alt="">
                </div>
                <div class="portfolio-desc">
                  <span>{{ __('DNA') }}</span>
                  <h4><a href="#">{{ __('Blood DNA Detect') }}</a></h4>
                </div>
              </div>
            </div>
            <!-- Остальные резервные элементы... -->
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- portfolio section end -->

<!-- blog section start -->
<section class="pt-0">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="theme-title">
          <h6>{{ $blog_heading->getTranslation('subtitle', app()->getLocale(), false) ?? __('Recent Articles') }}</h6>
          <h2>{{ $blog_heading->getTranslation('title', app()->getLocale(), false) ?? __('Innovation in Focus Stories') }} <span>{{ $blog_heading->getTranslation('title_span', app()->getLocale(), false) ?? __('Updated From Lab') }}</span></h2>
        </div>
      </div>
    </div>
    <div class="row">
      @foreach($recent_posts ?? [] as $post)
      <div class="col-lg-4 col-md-12 {{ $loop->index > 0 ? 'mt-6 mt-lg-0' : '' }}">
        <div class="post-card style-1">
          <div class="post-image">
            <img class="img-fluid w-100" src="{{ asset($post->featured_image) }}" alt="{{ $post->getTranslation('title', app()->getLocale(), false) }}">
          </div>
          <div class="post-desc">
            <div class="post-bottom">
              <ul class="list-inline mb-0">
                <li class="list-inline-item">
                  <i class="bi bi-calendar3"></i>{{ $post->created_at ? $post->created_at->format('d F, Y') : date('d F, Y') }}
                </li>
                <li class="list-inline-item">
                  <i class="bi bi-tag"></i> {{ $post->category ? $post->category->getTranslation('name', app()->getLocale(), false) : __('General') }}
                </li>
              </ul>
            </div>
            <div class="post-title">
              <h4>
                <a href="#">{{ $post->getTranslation('title', app()->getLocale(), false) }}</a>
              </h4>
            </div>
            <a class="ht-link-btn" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" class="arr-2" viewBox="0 0 24 24">
                <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
              </svg>
              <span>{{ __('Read More') }}</span>
              <svg xmlns="http://www.w3.org/2000/svg" class="arr-1" viewBox="0 0 24 24">
                <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
              </svg>
            </a>
          </div>
        </div>
      </div>
      @endforeach
      
      @if(empty($recent_posts) || count($recent_posts) == 0)
      <!-- Резервные данные для блога, если в базе нет постов -->
      <div class="col-lg-4 col-md-12">
        <div class="post-card style-1">
          <div class="post-image">
            <img class="img-fluid w-100" src="{{ asset('images/blog/01.jpg') }}" alt="">
          </div>
          <div class="post-desc">
            <div class="post-bottom">
              <ul class="list-inline mb-0">
                <li class="list-inline-item">
                  <i class="bi bi-calendar3"></i>10 March, 2025
                </li>
                <li class="list-inline-item">
                  <i class="bi bi-tag"></i> {{ __('Biochemistry') }}
                </li>
              </ul>
            </div>
            <div class="post-title">
              <h4>
                <a href="#">{{ __('The Role of Medical Laboratories in Infectious Disease Testing') }}</a>
              </h4>
            </div>
            <a class="ht-link-btn" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" class="arr-2" viewBox="0 0 24 24">
                <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
              </svg>
              <span>{{ __('Read More') }}</span>
              <svg xmlns="http://www.w3.org/2000/svg" class="arr-1" viewBox="0 0 24 24">
                <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
              </svg>
            </a>
          </div>
        </div>
      </div>
      <!-- Другие резервные элементы... -->
      @endif
    </div>
  </div>
</section>
<!-- blog section end -->
@endsection

@section('extra_js')
<script>
  // Инициализация слайдеров после загрузки документа
  document.addEventListener('DOMContentLoaded', function() {
    // Инициализация слайдера баннера, если он есть на странице
    if (document.querySelector('.banner-swiper')) {
        new Swiper('.banner-swiper', {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            speed: 4000, // Увеличьте скорость для более плавного перехода
            effect: 'fade', // Используйте эффект затухания для более плавных переходов
            fadeEffect: {
                crossFade: true // Обеспечивает плавное перекрытие слайдов
            },
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '#banner-swiper-button-next',
                prevEl: '#banner-swiper-button-prev',
            },
            on: {
                // Проверить, загружены ли изображения перед началом слайдера
                init: function() {
                    const swiper = this;
                    const slides = swiper.slides;
                    
                    // Предзагрузка изображений
                    for (let i = 0; i < slides.length; i++) {
                        const bgImgEl = slides[i].querySelector('.slider-img');
                        if (bgImgEl) {
                            const bgImgUrl = bgImgEl.getAttribute('data-bg-img');
                            if (bgImgUrl) {
                                // Предзагрузка изображения
                                const img = new Image();
                                img.src = bgImgUrl;
                                img.onload = function() {
                                    // Установка фона после загрузки
                                    bgImgEl.style.backgroundImage = `url(${bgImgUrl})`;
                                    bgImgEl.style.backgroundSize = 'cover';
                                    bgImgEl.style.backgroundPosition = 'center center';
                                };
                            }
                        }
                    }
                }
            }
        });
    }

    // Инициализация слайдера сервисов
    if (document.querySelector('.service-swiper')) {
      new Swiper('.service-swiper', {
        slidesPerView: 1,
        spaceBetween: 30,
        pagination: {
          el: '#service-pagination',
          clickable: true,
        },
        breakpoints: {
          576: {
            slidesPerView: 2,
          },
          992: {
            slidesPerView: 3,
          },
          1200: {
            slidesPerView: 4,
          },
        },
      });
    }

    // Инициализация слайдера команды
    if (document.querySelector('.team-swiper')) {
      new Swiper('.team-swiper', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
        },
        breakpoints: {
          576: {
            slidesPerView: 2,
          },
          992: {
            slidesPerView: 3,
          },
          1200: {
            slidesPerView: 4,
          },
        },
      });
    }

    // Инициализация слайдера портфолио
    if (document.querySelector('.portfolio-swiper')) {
      new Swiper('.portfolio-swiper', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
        },
        breakpoints: {
          576: {
            slidesPerView: 2,
          },
          992: {
            slidesPerView: 3,
          },
          1200: {
            slidesPerView: 4,
          },
        },
      });
    }

    // Инициализация счетчиков
    const counterElements = document.querySelectorAll('.count-number');
    if (counterElements.length > 0) {
      counterElements.forEach(function(element) {
        const target = parseInt(element.getAttribute('data-count'), 10);
        let count = 0;
        const interval = setInterval(function() {
          element.textContent = count;
          if (count >= target) {
            clearInterval(interval);
          }
          count = Math.min(count + 1, target);
        }, 30);
      });
    }
  });
</script>
@endsection