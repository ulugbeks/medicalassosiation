<div class="language-switcher dropdown">
    <a class="dropdown-toggle language-btn" href="#" role="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        @if(app()->getLocale() === 'en')
            <span class="flag-icon flag-icon-gb"></span> EN
        @elseif(app()->getLocale() === 'lv')
            <span class="flag-icon flag-icon-lv"></span> LV
        @else
            <span class="flag-icon flag-icon-{{ app()->getLocale() }}"></span> {{ strtoupper(app()->getLocale()) }}
        @endif
    </a>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
        @if(app()->getLocale() !== 'en')
            <li>
                <a class="dropdown-item" href="{{ route('language.switch', ['locale' => 'en']) }}">
                    <span class="flag-icon flag-icon-gb me-2"></span> English
                </a>
            </li>
        @endif
        @if(app()->getLocale() !== 'lv')
            <li>
                <a class="dropdown-item" href="{{ route('language.switch', ['locale' => 'lv']) }}">
                    <span class="flag-icon flag-icon-lv me-2"></span> Latviešu
                </a>
            </li>
        @endif
    </ul>
</div>

<style type="text/css" media="screen">

.language-switcher {
  margin-right: 15px;
}

.language-switcher .language-btn {
  display: flex;
  align-items: center;
  color: #555;
  text-decoration: none;
  padding: 6px 10px;
  border-radius: 4px;
  background: rgba(255, 255, 255, 0.1);
  transition: all 0.3s ease;
}

.language-switcher .language-btn:hover {
  background: rgba(255, 255, 255, 0.2);
}

.language-switcher .flag-icon {
  width: 20px;
  height: 15px;
  margin-right: 5px;
  background-size: cover;
  background-position: center;
  display: inline-block;
  vertical-align: middle;
  border-radius: 2px;
}

/* Flag icons */
.flag-icon-gb {
  background-image: url('https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/flags/4x3/gb.svg');
}

.flag-icon-lv {
  background-image: url('https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/flags/4x3/lv.svg');
}

.language-switcher .dropdown-menu {
  min-width: 8rem;
  padding: 0.5rem 0;
  margin: 0.125rem 0 0;
  background-color: #fff;
  border: 1px solid rgba(0, 0, 0, 0.15);
  border-radius: 0.25rem;
}

.language-switcher .dropdown-item {
  display: flex;
  align-items: center;
  padding: 0.5rem 1rem;
  color: #212529;
  text-decoration: none;
  transition: background-color 0.15s ease-in-out;
}

.language-switcher .dropdown-item.active,
.language-switcher .dropdown-item:active {
  color: #fff;
  background-color: var(--theme-color);
}

.language-switcher .dropdown-item:hover {
  background-color: rgba(var(--theme-color-rgb), 0.1);
}

</style>