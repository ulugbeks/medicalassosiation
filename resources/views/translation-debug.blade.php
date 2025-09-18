<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Translation Debug</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .debug-section { margin: 20px 0; padding: 15px; border: 1px solid #ddd; border-radius: 5px; }
        .debug-section h3 { margin: 0 0 10px 0; color: #333; }
        .test-item { margin: 10px 0; padding: 10px; background: #f9f9f9; }
        .success { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }
        .language-switch { margin: 10px 5px; padding: 8px 15px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
    <h1>Translation System Debug</h1>

    <div class="debug-section">
        <h3>Current Locale Information</h3>
        <div class="test-item">
            <strong>Current App Locale:</strong> {{ app()->getLocale() }}
        </div>
        <div class="test-item">
            <strong>Session Locale:</strong> {{ session('locale', 'Not set') }}
        </div>
        <div class="test-item">
            <strong>Config Locale:</strong> {{ config('app.locale') }}
        </div>
        <div class="test-item">
            <strong>Config Fallback Locale:</strong> {{ config('app.fallback_locale') }}
        </div>
    </div>

    <div class="debug-section">
        <h3>Database Languages</h3>
        @php
            $languages = \App\Models\Language::all();
            $defaultLang = \App\Models\Language::where('is_default', true)->first();
        @endphp
        
        @foreach($languages as $lang)
            <div class="test-item {{ $lang->active ? 'success' : 'error' }}">
                <strong>{{ $lang->name }} ({{ $lang->code }}):</strong> 
                {{ $lang->active ? 'Active' : 'Inactive' }}
                {{ $lang->is_default ? '(Default)' : '' }}
            </div>
        @endforeach
        
        <div class="test-item">
            <strong>Default Language from DB:</strong> {{ $defaultLang ? $defaultLang->code : 'None found' }}
        </div>
    </div>

    <div class="debug-section">
        <h3>Translation File Tests</h3>
        
        <div class="test-item">
            <strong>Testing __('Home'):</strong> "{{ __('Home') }}"
        </div>
        
        <div class="test-item">
            <strong>Testing __('Contact'):</strong> "{{ __('Contact') }}"
        </div>
        
        <div class="test-item">
            <strong>Testing __('About Us'):</strong> "{{ __('About Us') }}"
        </div>
        
        <div class="test-item">
            <strong>Testing trans('Home'):</strong> "{{ trans('Home') }}"
        </div>
        
        <div class="test-item">
            <strong>Testing with explicit file - messages.Home:</strong> "{{ __('messages.Home') }}"
        </div>
        
        <div class="test-item">
            <strong>Testing non-existent key:</strong> "{{ __('NonExistentKey') }}"
        </div>
    </div>

    <div class="debug-section">
        <h3>File Path Checks</h3>
        @php
            $currentLocale = app()->getLocale();
            $messagesPath = resource_path("lang/{$currentLocale}/messages.php");
            $messagesExists = file_exists($messagesPath);
        @endphp
        
        <div class="test-item {{ $messagesExists ? 'success' : 'error' }}">
            <strong>Messages file path:</strong> {{ $messagesPath }}
        </div>
        
        <div class="test-item {{ $messagesExists ? 'success' : 'error' }}">
            <strong>File exists:</strong> {{ $messagesExists ? 'Yes' : 'No' }}
        </div>
        
        @if($messagesExists)
            @php
                $messages = include $messagesPath;
                $homeKey = isset($messages['Home']) ? $messages['Home'] : 'Not found';
            @endphp
            <div class="test-item">
                <strong>Home key in file:</strong> "{{ $homeKey }}"
            </div>
        @endif
    </div>

    <div class="debug-section">
        <h3>Language Switching</h3>
        <p>Current locale: <strong>{{ app()->getLocale() }}</strong></p>
        
        <a href="{{ route('language.switch', 'en') }}" class="language-switch">Switch to English</a>
        <a href="{{ route('language.switch', 'lv') }}" class="language-switch">Switch to Latvian</a>
        
        <p><a href="{{ url()->current() }}">Refresh this page</a></p>
    </div>

    <div class="debug-section">
        <h3>Direct Laravel Translation Check</h3>
        @php
            // Force set locale and test
            $originalLocale = app()->getLocale();
            
            // Test English
            app()->setLocale('en');
            $englishHome = __('Home');
            
            // Test Latvian
            app()->setLocale('lv');
            $latvianHome = __('Home');
            
            // Restore original
            app()->setLocale($originalLocale);
        @endphp
        
        <div class="test-item">
            <strong>Forced EN - __('Home'):</strong> "{{ $englishHome }}"
        </div>
        
        <div class="test-item">
            <strong>Forced LV - __('Home'):</strong> "{{ $latvianHome }}"
        </div>
    </div>
</body>
</html>