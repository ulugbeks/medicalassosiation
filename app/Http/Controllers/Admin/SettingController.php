<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::first();
        if (!$settings) {
            $settings = new Setting();
        }
        
        $languages = active_languages();
        
        return view('admin.settings.edit', compact('settings', 'languages'));
    }

    public function update(Request $request)
    {
        $languages = active_languages();
        $defaultLanguage = default_language();
        
        $rules = [];
        foreach ($languages as $language) {
            $isRequired = $language->is_default;
            $rules["site_name.{$language->code}"] = $isRequired ? 'required|string|max:255' : 'nullable|string|max:255';
            $rules["site_title.{$language->code}"] = 'nullable|string|max:255';
            $rules["site_description.{$language->code}"] = 'nullable|string';
            $rules["meta_title.{$language->code}"] = 'nullable|string|max:255';
            $rules["meta_description.{$language->code}"] = 'nullable|string';
            $rules["meta_keywords.{$language->code}"] = 'nullable|string|max:255';
            $rules["address.{$language->code}"] = 'nullable|string|max:255';
            $rules["working_hours.{$language->code}"] = 'nullable|string|max:255';
            $rules["footer_cta_title.{$language->code}"] = 'nullable|string';
            $rules["newsletter_text.{$language->code}"] = 'nullable|string';
        }
        
        // Add non-translatable fields
        $rules = array_merge($rules, [
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'map_url' => 'nullable|string',
        ]);
        
        $request->validate($rules);
        
        $settings = Setting::first();
        if (!$settings) {
            $settings = new Setting();
        }
        
        // Set translatable fields
        foreach ($languages as $language) {
            $locale = $language->code;
            
            if (isset($request->site_name[$locale])) {
                $settings->setTranslation('site_name', $locale, $request->site_name[$locale]);
            }
            
            if (isset($request->site_title[$locale])) {
                $settings->setTranslation('site_title', $locale, $request->site_title[$locale]);
            }
            
            if (isset($request->site_description[$locale])) {
                $settings->setTranslation('site_description', $locale, $request->site_description[$locale]);
            }
            
            if (isset($request->meta_title[$locale])) {
                $settings->setTranslation('meta_title', $locale, $request->meta_title[$locale]);
            }
            
            if (isset($request->meta_description[$locale])) {
                $settings->setTranslation('meta_description', $locale, $request->meta_description[$locale]);
            }
            
            if (isset($request->meta_keywords[$locale])) {
                $settings->setTranslation('meta_keywords', $locale, $request->meta_keywords[$locale]);
            }
            
            if (isset($request->address[$locale])) {
                $settings->setTranslation('address', $locale, $request->address[$locale]);
            }
            
            if (isset($request->working_hours[$locale])) {
                $settings->setTranslation('working_hours', $locale, $request->working_hours[$locale]);
            }
            
            if (isset($request->footer_cta_title[$locale])) {
                $settings->setTranslation('footer_cta_title', $locale, $request->footer_cta_title[$locale]);
            }
            
            if (isset($request->newsletter_text[$locale])) {
                $settings->setTranslation('newsletter_text', $locale, $request->newsletter_text[$locale]);
            }
        }
        
        // Set non-translatable fields
        $settings->email = $request->email;
        $settings->phone = $request->phone;
        $settings->facebook = $request->facebook;
        $settings->twitter = $request->twitter;
        $settings->linkedin = $request->linkedin;
        $settings->whatsapp = $request->whatsapp;
        $settings->map_url = $request->map_url;
        
        $settings->save();
        
        return redirect()->route('settings.edit')->with('success', 'Settings updated successfully');
    }
}