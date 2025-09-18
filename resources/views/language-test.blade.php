<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Language Test</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
    <style>
        body { padding: 20px; }
        .debug-info { background: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 20px; }
        .language-list a { display: inline-block; margin-right: 10px; padding: 5px 10px; border: 1px solid #ddd; border-radius: 3px; text-decoration: none; }
        .language-list a.active { background: #007bff; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Language Test Page</h1>
        
        <div class="debug-info">
            <h3>Debug Information</h3>
            <ul>
                <li><strong>Current App Locale:</strong> {{ app()->getLocale() }}</li>
                <li><strong>Session Locale:</strong> {{ session('locale') ?? 'Not set' }}</li>
                <li><strong>Default Language (from DB):</strong> 
                    @php
                        $defaultLang = \App\Models\Language::where('is_default', true)->first();
                        echo $defaultLang ? $defaultLang->code : 'Not found';
                    @endphp
                </li>
                <li><strong>Current URL:</strong> {{ url()->current() }}</li>
                <li><strong>Current Route:</strong> {{ Route::currentRouteName() }}</li>
                <li><strong>Request Headers:</strong> 
                    <ul>
                        @foreach(request()->header() as $name => $values)
                            <li>{{ $name }}: {{ implode(', ', $values) }}</li>
                        @endforeach
                    </ul>
                </li>
                <li><strong>Session Data:</strong> 
                    <ul>
                        @foreach(session()->all() as $key => $value)
                            @if(is_string($value) || is_numeric($value))
                                <li>{{ $key }}: {{ $value }}</li>
                            @else
                                <li>{{ $key }}: [complex value]</li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
        
        <div class="language-list mb-4">
            <h3>Switch Language</h3>
            <a href="{{ route('language.switch', ['locale' => 'en']) }}" class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">
                <span class="flag-icon flag-icon-gb me-2"></span> English
            </a>
            <a href="{{ route('language.switch', ['locale' => 'lv']) }}" class="{{ app()->getLocale() === 'lv' ? 'active' : '' }}">
                <span class="flag-icon flag-icon-lv me-2"></span> Latviešu
            </a>
        </div>
        
        <div class="translation-test">
            <h3>Translation Test</h3>
            <p>English text: Hello, world!</p>
            <p>Translated text: {{ __('Hello, world!!') }}</p>
        </div>
        
        <div class="actions mt-4">
            <h3>Actions</h3>
            <a href="{{ route('language.test') }}?_={{ time() }}" class="btn btn-primary">Reload This Page (Cache Bust)</a>
            <form action="{{ route('language.switch', ['locale' => app()->getLocale() === 'en' ? 'lv' : 'en']) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-secondary">Switch Using POST (to {{ app()->getLocale() === 'en' ? 'LV' : 'EN' }})</button>
            </form>
        </div>
    </div>
</body>
</html>