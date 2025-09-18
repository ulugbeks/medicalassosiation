<header id="site-header" class="header">
  <div class="header-top">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-lg-4 col-md-6 d-flex align-items-center">
          <div class="topbar-link">
            <ul class="list-inline">
              <li>
                <i class="flaticon flaticon-location-1"></i>
                <span>{{ $settings->address ?? '5th Street, 21st Floor, New York, USA' }}</span>
              </li>
            </ul>
          </div>
          <!-- <div class="header-number ms-4">
            <i class="flaticon flaticon-phone"></i>
            <a href="tel:{{ $settings->phone ?? '(123) 456-7890' }}">{{ $settings->phone ?? '(123) 456-7890' }}</a>
          </div> -->
        </div>
        <div class="col-lg-8 col-md-6 d-flex align-items-center justify-content-end">
          <div class="topbar-link">
            <ul class="list-inline">
              <li>
                <i class="flaticon flaticon-phone"></i>
                <a href="tel:{{ $settings->phone ?? '(123) 456-7890' }}">{{ $settings->phone ?? '(123) 456-7890' }}</a>
              </li>
              <li>
                <i class="flaticon flaticon-envelope"></i>
                <a href="mailto:{{ $settings->email ?? 'info@example.com' }}">{{ $settings->email ?? 'info@example.com' }}</a>
              </li>
              <li>
                <i class="bi bi-clock-fill"></i>
                <span>{{ $settings->working_hours ?? 'Mon - Fri 10:00 to 6:00' }}</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="header-wrap">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <!-- Navbar -->
          <nav class="navbar navbar-expand-xl">
            <a class="navbar-brand logo" href="{{ route('home') }}">
              <img class="img-fluid" src="{{ asset('images/logo123.svg') }}" alt="">
            </a>
            <button class="navbar-toggler ht-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <svg width="100" height="100" viewBox="0 0 100 100">
                <path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058"></path>
                <path class="line line2" d="M 20,50 H 80"></path>
                <path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942"></path>
              </svg>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
              <!-- Left nav -->
              <ul class="nav navbar-nav">
                <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('blog*') ? 'active' : '' }}" href="{{ route('blog.index') }}">Blog</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                </li>
              </ul>
            </div>
            <div class="header-right d-flex align-items-center justify-content-end">
              <!-- Language switcher -->
              @include('layouts.partials.language-switcher')
              <div class="social-icons mx-4">
                <ul class="list-inline">
                  <li>
                    <a href="{{ $settings->facebook ?? '#' }}">
                      <i class="flaticon flaticon-facebook"></i>
                    </a>
                  </li>
                  <li>
                    <a href="{{ $settings->twitter ?? '#' }}">
                      <i class="flaticon flaticon-twitter-1"></i>
                    </a>
                  </li>
                  <li>
                    <a href="{{ $settings->linkedin ?? '#' }}">
                      <i class="flaticon flaticon-linkedin"></i>
                    </a>
                  </li>
                </ul>
              </div>
              <a class="themeht-btn primary-btn" href="{{ route('contact') }}">Contact Us</a>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </div>
</header>