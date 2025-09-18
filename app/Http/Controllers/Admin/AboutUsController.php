<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;
use App\Models\Timeline;

class AboutUsController extends Controller
{
    /**
     * Show the form for editing the about page content.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        // Get or create the about content
        $about = AboutUs::first();
        if (!$about) {
            $about = new AboutUs();
        }
        
        // Get timelines for the page
        $timelines = Timeline::orderBy('year', 'asc')->get();
        
        // Get languages for tabs
        $languages = active_languages();
        
        return view('admin.aboutus.edit', compact('about', 'timelines', 'languages'));
    }

    /**
     * Update the about page content.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $languages = active_languages();
        $defaultLanguage = default_language();
        
        $rules = [];
        foreach ($languages as $language) {
            $isRequired = $language->is_default;
            $rules["title.{$language->code}"] = 'nullable|string|max:255';
            $rules["subtitle.{$language->code}"] = 'nullable|string|max:255';
            $rules["description.{$language->code}"] = 'nullable|string';
            $rules["additional_title.{$language->code}"] = 'nullable|string|max:255';
            $rules["additional_description.{$language->code}"] = 'nullable|string';
            $rules["seo_title.{$language->code}"] = 'nullable|string|max:255';
            $rules["seo_description.{$language->code}"] = 'nullable|string';
        }
        
        $request->validate($rules);
        
        $about = AboutUs::first();
        if (!$about) {
            $about = new AboutUs();
        }
        
        // Set translatable fields
        foreach ($languages as $language) {
            $locale = $language->code;
            
            if (isset($request->title[$locale])) {
                $about->setTranslation('title', $locale, $request->title[$locale]);
            }
            
            if (isset($request->subtitle[$locale])) {
                $about->setTranslation('subtitle', $locale, $request->subtitle[$locale]);
            }
            
            if (isset($request->description[$locale])) {
                $about->setTranslation('description', $locale, $request->description[$locale]);
            }
            
            if (isset($request->additional_title[$locale])) {
                $about->setTranslation('additional_title', $locale, $request->additional_title[$locale]);
            }
            
            if (isset($request->additional_description[$locale])) {
                $about->setTranslation('additional_description', $locale, $request->additional_description[$locale]);
            }
            
            if (isset($request->seo_title[$locale])) {
                $about->setTranslation('seo_title', $locale, $request->seo_title[$locale]);
            }
            
            if (isset($request->seo_description[$locale])) {
                $about->setTranslation('seo_description', $locale, $request->seo_description[$locale]);
            }
        }
        
        $about->save();
        
        return redirect()->route('aboutus.edit')->with('success', 'About page content updated successfully');
    }
}