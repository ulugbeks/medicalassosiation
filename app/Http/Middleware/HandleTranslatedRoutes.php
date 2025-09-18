<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Language;

class HandleTranslatedRoutes
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->route('locale');
        $slug = $request->route('slug');
        
        if ($locale && $slug) {
            // Check if locale exists and is active
            $localeExists = Language::where('code', $locale)
                                  ->where('active', true)
                                  ->exists();
            
            if (!$localeExists) {
                return redirect()->route('home');
            }
            
            // Get the route key from the translated slug
            $route_key = get_route_key_by_slug($slug, $locale);
            
            if (!$route_key) {
                // If the slug is not found in translations, try English slug directly
                $route_key = $slug;
            }
            
            // Store the route key for the controller to use
            $request->attributes->set('route_key', $route_key);
            $request->attributes->set('translated_slug', $slug);
        }
        
        return $next($request);
    }
}