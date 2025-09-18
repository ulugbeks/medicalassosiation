@extends('layouts.app')

@section('title', 'Contact Us - Laboratory & Science Research')

@section('content')
<!-- page title start -->
<section class="page-title" data-bg-img="{{ asset('images/bg/02.jpg') }}">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <h1>
          {{ __('Contact Us') }}
        </h1>
        <nav aria-label="breadcrumb" class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ route('home') }}">
                <i class="bi bi-house-door me-1"></i>{{ __('Home') }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Contact Us') }}</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <div id="particles-js"></div>
</section>
<!-- page title end -->

<!-- contact form start -->
<section class="pt-50">
  <div class="container">
    <div class="row">
      @foreach($contact_locations ?? [] as $location)
      <div class="col-lg-5 col-md-12 {{ $loop->index > 0 ? 'mt-5 mt-lg-0' : '' }}">
        <div class="contact-info">
          <h4>{{ t($location, 'title', app()->getLocale()) }}</h4>
          <ul class="list-unstyled">
            <li>
              <i class="flaticon flaticon-location-1"></i>
              <span>{{ __('Visit Our Location') }}</span>
              <p>{{ t($location, 'address', app()->getLocale()) }}</p>
            </li>
            <li>
              <i class="flaticon flaticon-envelope"></i>
              <span>{{ __('Send Us Email') }}</span>
              <a href="mailto:{{ $location->email }}">{{ $location->email }}</a>
            </li>
            <li>
              <i class="flaticon flaticon-phone"></i>
              <span>{{ __('Call Us') }}</span>
              <a href="tel:{{ $location->phone }}">{{ $location->phone }}</a>
            </li>
          </ul>
        </div>
      </div>
      @endforeach
      <div class="col-lg-7 col-md-12 mt-10 mt-lg-0 pe-lg-10">
        <div class="box-shadow rounded p-5">
          <div class="theme-title">
            <h3>{{ __('Booking for Your Laboratory Visit') }}</h3>
          </div>
          @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
          @endif
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
                  {{ __('Send Message') }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- contact form end -->

<!-- map start -->
<section class="overflow-hidden p-0">
  <div class="container-fluid px-0">
    <div class="row">
      <div class="col-md-12">
        <div class="map iframe-h">
          <iframe src="{{ $settings->map_url ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.840108181602!2d144.95373631539215!3d-37.8172139797516!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4c2b349649%3A0xb6899234e561db11!2sEnvato!5e0!3m2!1sen!2sin!4v1497005461921' }}" allowfullscreen=""></iframe>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- map end -->
@endsection