<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    
    @if(Route::is('home'))
        @php
        $homePageSeo = App\Models\HomePageSeo::first();
        @endphp
        <meta name="keywords" content="{{ $settings->meta_keywords ?? 'laboratory, science, research' }}" />
        <meta name="description" content="{{ $homePageSeo ? $homePageSeo->getTranslation('seo_description', app()->getLocale(), false) : ($settings->meta_description ?? 'Laboratory & Science Research') }}" />
        <title>{{ $homePageSeo ? $homePageSeo->getTranslation('seo_title', app()->getLocale(), false) : ($settings->meta_title ?? $settings->site_title ?? 'Laboratory & Science Research') }} - {{ __('Home') }}</title>
    @elseif(Route::is('about'))
        @php
        $aboutPage = App\Models\AboutUs::first();
        @endphp
        <meta name="keywords" content="{{ $settings->meta_keywords ?? 'laboratory, science, research' }}" />
        <meta name="description" content="{{ $aboutPage ? $aboutPage->getTranslation('seo_description', app()->getLocale(), false) : ($settings->meta_description ?? 'Laboratory & Science Research') }}" />
        <title>{{ $aboutPage ? $aboutPage->getTranslation('seo_title', app()->getLocale(), false) : ($settings->meta_title ?? $settings->site_title ?? 'Laboratory & Science Research') }} - {{ __('About Us') }}</title>
    @elseif(Route::is('contact'))
        @php
        $contactPageSeo = App\Models\ContactPageSeo::first();
        @endphp
        <meta name="keywords" content="{{ $settings->meta_keywords ?? 'laboratory, science, research' }}" />
        <meta name="description" content="{{ $contactPageSeo ? $contactPageSeo->getTranslation('seo_description', app()->getLocale(), false) : ($settings->meta_description ?? 'Laboratory & Science Research') }}" />
        <title>{{ $contactPageSeo ? $contactPageSeo->getTranslation('seo_title', app()->getLocale(), false) : ($settings->meta_title ?? $settings->site_title ?? 'Laboratory & Science Research') }} - {{ __('Contact') }}</title>
    @elseif(Route::is('blog.show') && isset($post))
        <meta name="keywords" content="{{ isset($post->category) ? $post->category->getTranslation('name', app()->getLocale(), false) : '' }}, {{ $settings->meta_keywords ?? 'laboratory, science, research' }}" />
        <meta name="description" content="{{ $post ? $post->getTranslation('seo_description', app()->getLocale(), false) ?? $post->getTranslation('excerpt', app()->getLocale(), false) : ($settings->meta_description ?? 'Laboratory & Science Research') }}" />
        <title>{{ $post ? $post->getTranslation('seo_title', app()->getLocale(), false) ?? $post->getTranslation('title', app()->getLocale(), false) : ($settings->meta_title ?? $settings->site_title ?? 'Laboratory & Science Research') }}</title>
    @elseif(Route::is('blog.index'))
        <meta name="keywords" content="{{ __('blog') }}, {{ __('articles') }}, {{ $settings->meta_keywords ?? 'laboratory, science, research' }}" />
        <meta name="description" content="{{ __('Latest articles and research updates') }} {{ $settings->meta_description ?? __('from our Laboratory & Science Research center') }}" />
        <title>{{ __('Blog') }} - {{ $settings->meta_title ?? $settings->site_title ?? 'Laboratory & Science Research' }}</title>
    @elseif(Route::is('blog.category') && isset($category))
        <meta name="keywords" content="{{ $category->getTranslation('name', app()->getLocale(), false) }}, {{ __('blog') }}, {{ $settings->meta_keywords ?? 'laboratory, science, research' }}" />
        <meta name="description" content="{{ __('Articles in') }} {{ $category->getTranslation('name', app()->getLocale(), false) }} {{ __('category') }} {{ $settings->meta_description ?? __('from our Laboratory & Science Research center') }}" />
        <title>{{ $category->getTranslation('name', app()->getLocale(), false) }} - {{ __('Blog') }} - {{ $settings->meta_title ?? $settings->site_title ?? 'Laboratory & Science Research' }}</title>
    @else
        <meta name="keywords" content="{{ $settings->meta_keywords ?? 'laboratory, science, research' }}" />
        <meta name="description" content="{{ $settings->meta_description ?? 'Laboratory & Science Research' }}" />
        <title>{{ $settings->meta_title ?? $settings->site_title ?? 'Laboratory & Science Research' }} - @yield('title', __('Home'))</title>
    @endif
    
    <meta name="author" content="www.bapm.eu" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Hreflang tags for SEO -->
    @php
    $languages = App\Models\Language::where('active', 1)->get();
    $defaultLanguage = App\Models\Language::where('is_default', 1)->first();
    $currentRoute = Route::currentRouteName();
    $routeParams = Route::current() ? Route::current()->parameters() : [];
    @endphp

    @foreach($languages as $language)
        @if($language->is_default)
            <link rel="alternate" hreflang="x-default" href="{{ url(Request::path() === app()->getLocale() ? '' : Request::path()) }}" />
            <link rel="alternate" hreflang="{{ $language->code }}" href="{{ url(Request::path() === app()->getLocale() ? '' : Request::path()) }}" />
        @else
            @if($currentRoute)
                <link rel="alternate" hreflang="{{ $language->code }}" href="{{ route($currentRoute, array_merge(['locale' => $language->code], $routeParams)) }}" />
            @else
                <link rel="alternate" hreflang="{{ $language->code }}" href="{{ url($language->code . '/' . (Request::path() === app()->getLocale() ? '' : substr(Request::path(), strlen(app()->getLocale()) + 1))) }}" />
            @endif
        @endif
    @endforeach

    <!-- favicon icon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" />

    <!-- inject css start -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/magnific-popup.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/odometer.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/spacing.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/labozu-icon.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/base.css') }}?v={{ time() }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/shortcodes.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/style.css') }}?v={{ time() }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" type="text/css" />
    @yield('extra_css')
    <!-- inject css end -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">
    <style>
      .iti {
        width: 100%;
      }
      .iti__flag {
        background-image: url("https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/img/flags.png");
      }
      @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
        .iti__flag {
          background-image: url("https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/img/flags@2x.png");
        }
      }
      
      /* Language switcher styles */
      .language-switcher {
        margin-left: 20px;
        display: flex;
        align-items: center;
      }
      
      .language-switcher a {
        display: inline-block;
        padding: 5px 10px;
        color: #fff;
        text-decoration: none;
        margin-right: 5px;
        border-radius: 3px;
      }
      
      .language-switcher a.active {
        background-color: rgba(255, 255, 255, 0.2);
        font-weight: bold;
      }
      
      .language-switcher a:hover {
        background-color: rgba(255, 255, 255, 0.1);
      }
    </style>
</head>

<body>
    <!-- page wrapper start -->
    <div class="page-wrapper">
        
        <!-- preloader start -->
        <div id="ht-preloader">
            <div class="loader clear-loader">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                  <g>
                    <path d="m 16.999389,6 a 3,3 0 1 1 3,-3 3.00082,3.00082 0 0 1 -3,3 z" id="path3859" />
                    <path d="m 23.999389,8 a 2,2 0 1 1 2,-2 1.99884,1.99884 0 0 1 -2,2 z" id="path3857" />
                    <path d="m 7.9993894,6.4 a 2,2 0 1 1 2,-2 1.99883,1.99883 0 0 1 -2,2 z" id="path3855" />
                    <path d="M 2.9720294,30.25 11.026749,15.74608 a 3.303,3.303 0 0 1 0.9726,-1.0078 V 11.5 A 1.89446,1.89446 0 0 1 9.9993494,9.75 1.8918,1.8918 0 0 1 11.999349,8 h 8 a 1.89184,1.89184 0 0 1 2,1.75 1.89449,1.89449 0 0 1 -2,1.75 v 3.23828 a 3.28838,3.28838 0 0 1 0.97168,1.0078 L 29.027709,30.25 A 1.07993,1.07993 0 0 1 27.999389,32 H 3.9993894 a 1.07943,1.07943 0 0 1 -1.02736,-1.75 z" id="path3853" />
                    <path d="m 24.888029,28 -2.22168,-4 H 9.3313494 l -2.22064,4 z" id="path3728" />
                  </g>
                </svg>
            </div>
        </div>

        <!--@include('layouts.partials.cookie-consent')-->

        <!-- preloader end -->

        <!-- header start -->
        @include('layouts.partials.header')
        
        
        <!-- header end -->

        <!-- content start -->
        @yield('content')
        <!-- content end -->

        <!-- footer start -->
        @include('layouts.partials.footer')
        <!-- footer end -->

    </div>
    <!-- page wrapper end -->

    <!-- back-to-top start -->
    <div class="scroll-top">
        <svg class="scroll-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- back-to-top end -->

    <!-- inject js start -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery-appear.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/mixitup.min.js') }}"></script>
    <script src="{{ asset('js/odometer.min.js') }}"></script>
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('js/particles.js') }}"></script>
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('js/labozu-swiper-init.js') }}"></script>
    <script src="{{ asset('js/theme-script.js') }}"></script>
    @yield('extra_js')
    <!-- inject js end -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // Initialize the telephone input
        var phoneInput = document.querySelector("#form_phone");
        if (phoneInput) {
          var iti = window.intlTelInput(phoneInput, {
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js",
            separateDialCode: true,
            initialCountry: "auto",
            geoIpLookup: function(callback) {
              fetch("https://ipapi.co/json")
                .then(function(res) { return res.json(); })
                .then(function(data) { callback(data.country_code); })
                .catch(function() { callback("us"); });
            },
            preferredCountries: ["us", "gb", "ca", "au"],
            formatOnDisplay: true
          });
          
          // Store the full phone number with country code when submitting the form
          var contactForm = document.getElementById('contact-form');
          if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
              var fullNumber = iti.getNumber();
              document.getElementById('full_phone').value = fullNumber;
              
              // Validate phone number
              if (!iti.isValidNumber()) {
                e.preventDefault();
                phoneInput.classList.add('is-invalid');
                
                // Create or update error message
                var errorDiv = phoneInput.nextElementSibling;
                if (!errorDiv || !errorDiv.classList.contains('invalid-feedback')) {
                  errorDiv = document.createElement('div');
                  errorDiv.className = 'invalid-feedback';
                  phoneInput.parentNode.insertBefore(errorDiv, phoneInput.nextSibling);
                }
                
                errorDiv.innerText = '{{ __("Please enter a valid phone number") }}';
              } else {
                phoneInput.classList.remove('is-invalid');
              }
            });
          }
        }
      });
    </script>
</body>
</html>