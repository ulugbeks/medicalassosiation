<?php

/**
 * Helper functions for multilingual support
 */

if (!function_exists('t')) {
    /**
     * Get translated attribute from a model with robust fallback
     *
     * @param mixed $model
     * @param string $attribute
     * @param string|null $locale
     * @return string
     */
    function t($model, $attribute, $locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        $defaultLocale = config('translatable.default_locale');
        
        if (method_exists($model, 'getTranslation')) {
            // Try with requested locale
            $translation = $model->getTranslation($attribute, $locale, false);
            
            // If empty, try with default locale
            if (empty($translation) && $locale !== $defaultLocale) {
                $translation = $model->getTranslation($attribute, $defaultLocale, false);
            }
            
            // If still empty, try to find any non-empty translation
            if (empty($translation)) {
                foreach (config('translatable.locales') as $attemptLocale) {
                    $attemptTranslation = $model->getTranslation($attribute, $attemptLocale, false);
                    if (!empty($attemptTranslation)) {
                        return $attemptTranslation;
                    }
                }
            }
            
            return $translation;
        }
        
        return $model->{$attribute};
    }
}

if (!function_exists('active_languages')) {
    /**
     * Get all active languages
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    function active_languages()
    {
        return \App\Models\Language::where('active', true)->get();
    }
}

if (!function_exists('default_language')) {
    /**
     * Get the default language
     *
     * @return \App\Models\Language|null
     */
    function default_language()
    {
        return \App\Models\Language::where('is_default', true)->first();
    }
}

if (!function_exists('current_language')) {
    /**
     * Get current language
     *
     * @return \App\Models\Language|null
     */
    function current_language()
    {
        $locale = app()->getLocale();
        return \App\Models\Language::where('code', $locale)->first();
    }
}

if (!function_exists('translation_status')) {
    /**
     * Get translation status for a model field (translated/untranslated)
     * 
     * @param mixed $model
     * @param string $attribute
     * @param string $locale
     * @return string
     */
    function translation_status($model, $attribute, $locale)
    {
        if (!method_exists($model, 'getTranslation')) {
            return 'not-translatable';
        }
        
        $translation = $model->getTranslation($attribute, $locale, false);
        
        if (empty($translation)) {
            return 'untranslated';
        }
        
        // Check if it's the same as default language (might be fallback)
        $defaultLocale = config('translatable.default_locale');
        if ($locale !== $defaultLocale) {
            $defaultTranslation = $model->getTranslation($attribute, $defaultLocale, false);
            if ($translation === $defaultTranslation) {
                return 'using-default';
            }
        }
        
        return 'translated';
    }
}

if (!function_exists('localized_route')) {
    /**
     * Generate a localized route with translated slug
     * 
     * @param string $route_key
     * @param string $locale
     * @param array $parameters
     * @return string
     */
    function localized_route($route_key, $locale = null, $parameters = [])
    {
        $locale = $locale ?: app()->getLocale();
        $localized_routes = config('localized_routes', []);
        
        // Get the translated slug for the route key
        $translated_slug = $localized_routes[$locale][$route_key] ?? $route_key;
        
        // Build the URL
        $url = '/' . $locale . '/' . $translated_slug;
        
        // Add additional parameters
        if (!empty($parameters)) {
            $url .= '/' . implode('/', $parameters);
        }
        
        return $url;
    }
}

if (!function_exists('route_slug')) {
    /**
     * Get translated slug for a route key
     * 
     * @param string $route_key
     * @param string $locale
     * @return string
     */
    function route_slug($route_key, $locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        $localized_routes = config('localized_routes', []);
        
        return $localized_routes[$locale][$route_key] ?? $route_key;
    }
}

if (!function_exists('get_route_key_by_slug')) {
    /**
     * Get route key by translated slug
     * 
     * @param string $slug
     * @param string $locale
     * @return string|null
     */
    function get_route_key_by_slug($slug, $locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        $localized_routes = config('localized_routes', []);
        
        if (!isset($localized_routes[$locale])) {
            return null;
        }
        
        // Search for the route key by slug
        foreach ($localized_routes[$locale] as $route_key => $translated_slug) {
            if ($translated_slug === $slug) {
                return $route_key;
            }
        }
        
        return null;
    }
}

if (!function_exists('localized_url')) {
    /**
     * Generate a localized URL for the current page in different language
     * 
     * @param string $locale
     * @return string
     */
    function localized_url($locale)
    {
        $request = request();
        $currentLocale = app()->getLocale();
        $currentPath = $request->path();
        
        // Remove current locale from path if present
        if (str_starts_with($currentPath, $currentLocale . '/')) {
            $pathWithoutLocale = substr($currentPath, strlen($currentLocale) + 1);
        } elseif ($currentPath === $currentLocale) {
            $pathWithoutLocale = '';
        } else {
            $pathWithoutLocale = $currentPath;
        }
        
        // Handle homepage
        if (empty($pathWithoutLocale) || $pathWithoutLocale === '/') {
            return url('/' . $locale);
        }
        
        // Get the route segments
        $segments = explode('/', trim($pathWithoutLocale, '/'));
        $translatedSegments = [];
        
        foreach ($segments as $segment) {
            // Try to find translation for this segment
            $routeKey = get_route_key_by_slug($segment, $currentLocale);
            if ($routeKey) {
                $translatedSegments[] = route_slug($routeKey, $locale);
            } else {
                $translatedSegments[] = $segment;
            }
        }
        
        $translatedPath = implode('/', $translatedSegments);
        return url('/' . $locale . '/' . $translatedPath);
    }
}

if (!function_exists('clean_html')) {
    /**
     * Clean and sanitize HTML content for safe output
     * 
     * @param string $html
     * @return string
     */
    function clean_html($html)
    {
        // Remove potentially dangerous tags and attributes
        $allowedTags = '<p><br><strong><b><em><i><u><h1><h2><h3><h4><h5><h6><ul><ol><li><a><blockquote><div><span>';
        
        // Strip tags except allowed ones
        $cleaned = strip_tags($html, $allowedTags);
        
        // Remove any javascript: or data: protocols from links
        $cleaned = preg_replace('/href=["\']javascript:[^"\']*/i', 'href="#"', $cleaned);
        $cleaned = preg_replace('/href=["\']data:[^"\']*/i', 'href="#"', $cleaned);
        
        // Remove any onXXX event handlers
        $cleaned = preg_replace('/\son\w+=["\'][^"\']*/i', '', $cleaned);
        
        return $cleaned;
    }
}