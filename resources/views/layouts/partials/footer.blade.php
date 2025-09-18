<footer class="footer">
  <div class="primary-footer">
    <div class="container">
      <div class="row align-items-center footer-top">
        <div class="col-lg-6">
          <h2 class="text-white mb-0">{{ t($settings, 'footer_cta_title', app()->getLocale()) ?? 'Need help on Emergency? Book Your Appointment Today.' }}</h2>
        </div>
        <div class="col-lg-6 text-lg-end mt-4 mt-lg-0">
          <a href="{{ route('contact') }}" class="themeht-btn primary-btn">{{ __('Contacts') }}</a>
          <a href="tel:{{ $settings->phone ?? '(123) 456-7890' }}" class="themeht-btn white-btn ms-3">{{ $settings->phone ?? '(123) 456-7890' }}</a>
        </div>
      </div>
      <div class="footer-btm">
        <div class="row">
          <div class="col-lg-4 pe-lg-8">
            <ul class="media-icon list-unstyled">
              <li>
                <i class="flaticon flaticon-location-1"></i>
                <p class="mb-0">{{ t($settings, 'address', app()->getLocale()) ?? '5th Street, 21st Floor, New York, USA' }}</p>
              </li>
              <li>
                <i class="flaticon flaticon-envelope"></i>
                <a href="mailto:{{ $settings->email ?? 'info@example.com' }}">{{ $settings->email ?? 'info@example.com' }}</a>
              </li>
              <li>
                <i class="flaticon flaticon-phone"></i>
                <a href="tel:{{ $settings->phone ?? '(123) 456-7890' }}">{{ $settings->phone ?? '(123) 456-7890' }}</a>
              </li>
            </ul>            
          </div>          
          <div class="col-lg-8 mt-5 mt-lg-0">
            <div class="row">              
              <div class="col-md-3 footer-menu">
                <h5>{{ __('Quick Links') }}</h5>
                <ul class="list-unstyled w-100">
                  <li>
                    <a href="#">{{ __('Terms & Conditions') }}</a>
                  </li>
                  <li>
                    <a href="#">{{ __('Privacy Policy') }}</a>
                  </li>
                  <li>
                    <a href="#">{{ __('Cookies') }}</a>
                  </li>
                </ul>
              </div>
              <div class="col-md-3 mt-5 mt-md-0 footer-menu">
                <h5>{{ __('Our Services') }}</h5>
                <ul class="list-unstyled">
                  @foreach($footerServices ?? [] as $service)
                  <li>
                    <a href="#">{{ t($service, 'title', app()->getLocale()) }}</a>
                  </li>
                  @endforeach
                </ul>
              </div>
              <div class="col-md-6 mt-5 mt-md-0 ps-lg-8 footer-subscribe">
                <h5>{{ __('Newsletter') }}</h5>
                <p>{{ t($settings, 'newsletter_text', app()->getLocale()) ?? 'Subscribe to our newsletter to get the latest updates.' }}</p>
                <form action="{{ route('newsletter.subscribe') }}" method="post" class="subscribe-form">
                  @csrf
                  <input type="email" name="email" class="email" placeholder="{{ __('Email Address') }}" required="">
                  <button type="submit" value="Sign up">
                    <i class="bi bi-send-fill"></i>
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="secondary-footer">
          <div class="row">
            <div class="col-lg-7 copyright">{{ __('Copyright') }} {{ date('Y') }}. {{ t($settings, 'site_name', app()->getLocale()) ?? 'Your Site' }}. {{ __('All Rights Reserved') }}</div>
            <div class="col-lg-5 text-lg-end mt-4 mt-lg-0">
              <ul class="list-inline ps-0 ms-0 mb-0 footer-social social-icons">
                <li class="list-inline-item">
                  <a href="{{ $settings->facebook ?? '#' }}">
                    <i class="flaticon flaticon-facebook"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="{{ $settings->twitter ?? '#' }}">
                    <i class="flaticon flaticon-twitter-1"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="{{ $settings->linkedin ?? '#' }}">
                    <i class="flaticon flaticon-linkedin"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="{{ $settings->whatsapp ?? '#' }}">
                    <i class="flaticon flaticon-whatsapp"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="animated-icon-shape">
    <img class="img-fluid small-circle-animation" src="{{ asset('images/small-icon/01.png') }}" alt="">
    <img class="img-fluid small-circle-animation" src="{{ asset('images/small-icon/05.png') }}" alt="">
    <img class="img-fluid small-circle-animation" src="{{ asset('images/small-icon/06.png') }}" alt="">
    <img class="img-fluid small-circle-animation" src="{{ asset('images/small-icon/04.png') }}" alt="">
  </div>
</footer>