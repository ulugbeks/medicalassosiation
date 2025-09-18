<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Language;

class Locale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->route('locale');
        
        // Check if locale exists and is active
        $localeExists = Language::where('code', $locale)
                              ->where('active', true)
                              ->exists();
        
        if (!$localeExists) {
            // Redirect to default language route
            $defaultLanguage = Language::where('is_default', true)->first();
            $defaultCode = $defaultLanguage ? $defaultLanguage->code : 'en';
            
            // Get the current route name without 'localized.' prefix
            $routeName = $request->route()->getName();
            $baseRouteName = str_replace('localized.', '', $routeName);
            
            // Get route parameters except locale
            $parameters = $request->route()->parameters();
            unset($parameters['locale']);
            
            // Check if base route exists
            if (\Route::has($baseRouteName)) {
                return redirect()->route($baseRouteName, $parameters);
            }
            
            // If no base route, redirect to home
            return redirect()->route('home');
        }
        
        // Set locale for this request
        App::setLocale($locale);
        session(['locale' => $locale]);
        
        return $next($request);
    }
}