<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Language;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // Check for locale in route parameter (for localized routes)
        if ($request->route('locale')) {
            $locale = $request->route('locale');
            $localeExists = Language::where('code', $locale)
                                  ->where('active', true)
                                  ->exists();
            
            if ($localeExists) {
                App::setLocale($locale);
                session(['locale' => $locale]);
                session()->save();
            }
        } 
        // Check for locale in session
        else if (session()->has('locale')) {
            $locale = session('locale');
            $localeExists = Language::where('code', $locale)
                                  ->where('active', true)
                                  ->exists();
            
            if ($localeExists) {
                App::setLocale($locale);
            }
        } 
        // Set default if none of the above
        else {
            $defaultLanguage = Language::where('is_default', true)->first();
            if ($defaultLanguage) {
                App::setLocale($defaultLanguage->code);
                session(['locale' => $defaultLanguage->code]);
                session()->save();
            }
        }

        return $next($request);
    }
}