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