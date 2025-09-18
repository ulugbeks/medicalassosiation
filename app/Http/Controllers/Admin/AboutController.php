<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;

class AboutController extends Controller
{
    /**
     * Show the form for editing the about section content.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        // Get or create the about content
        $about = About::first();
        if (!$about) {
            $about = new About();
        }
        
        // Get languages for tabs
        $languages = active_languages();
        
        return view('admin.about.edit', compact('about', 'languages'));
    }

    /**
     * Update the about section content.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $languages = active_languages();
        $defaultLanguage = default_language();
        
        // Build validation rules
        $rules = [];
        foreach ($languages as $language) {
            $isRequired = $language->is_default;
            $rules["title.{$language->code}"] = 'nullable|string|max:255';
            $rules["subtitle.{$language->code}"] = 'nullable|string|max:255';
            $rules["description.{$language->code}"] = 'nullable|string';
            $rules["doctor_name.{$language->code}"] = 'nullable|string|max:255';
            $rules["doctor_title.{$language->code}"] = 'nullable|string|max:255';
            $rules["second_section_subtitle.{$language->code}"] = 'nullable|string|max:255';
            $rules["second_section_title.{$language->code}"] = 'nullable|string|max:255';
            $rules["second_section_description.{$language->code}"] = 'nullable|string';
            $rules["second_section_feature1_title.{$language->code}"] = 'nullable|string|max:255';
            $rules["second_section_feature1_description.{$language->code}"] = 'nullable|string';
            $rules["second_section_feature2_title.{$language->code}"] = 'nullable|string|max:255';
            $rules["second_section_feature2_description.{$language->code}"] = 'nullable|string';
        }
        
        // Non-translatable field rules
        $rules = array_merge($rules, [
            'image1' => 'nullable|string',
            'image2' => 'nullable|string',
            'image3' => 'nullable|string',
            'signature_image' => 'nullable|string',
            'doctor_image' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string',
            'second_section_years' => 'nullable|integer',
        ]);
        
        $request->validate($rules);
        
        // Get or create about record
        $about = About::first();
        if (!$about) {
            $about = new About();
        }
        
        // Process translatable fields
        foreach ($languages as $language) {
            $locale = $language->code;
            
            // Main section fields
            if (isset($request->title[$locale])) {
                $about->setTranslation('title', $locale, $request->title[$locale]);
            }
            
            if (isset($request->subtitle[$locale])) {
                $about->setTranslation('subtitle', $locale, $request->subtitle[$locale]);
            }
            
            if (isset($request->description[$locale])) {
                $about->setTranslation('description', $locale, $request->description[$locale]);
            }
            
            // Doctor info fields
            if (isset($request->doctor_name[$locale])) {
                $about->setTranslation('doctor_name', $locale, $request->doctor_name[$locale]);
            }
            
            if (isset($request->doctor_title[$locale])) {
                $about->setTranslation('doctor_title', $locale, $request->doctor_title[$locale]);
            }
            
            // Second section fields
            if (isset($request->second_section_subtitle[$locale])) {
                $about->setTranslation('second_section_subtitle', $locale, $request->second_section_subtitle[$locale]);
            }
            
            if (isset($request->second_section_title[$locale])) {
                $about->setTranslation('second_section_title', $locale, $request->second_section_title[$locale]);
            }
            
            if (isset($request->second_section_description[$locale])) {
                $about->setTranslation('second_section_description', $locale, $request->second_section_description[$locale]);
            }
            
            // Feature fields
            if (isset($request->second_section_feature1_title[$locale])) {
                $about->setTranslation('second_section_feature1_title', $locale, $request->second_section_feature1_title[$locale]);
            }
            
            if (isset($request->second_section_feature1_description[$locale])) {
                $about->setTranslation('second_section_feature1_description', $locale, $request->second_section_feature1_description[$locale]);
            }
            
            if (isset($request->second_section_feature2_title[$locale])) {
                $about->setTranslation('second_section_feature2_title', $locale, $request->second_section_feature2_title[$locale]);
            }
            
            if (isset($request->second_section_feature2_description[$locale])) {
                $about->setTranslation('second_section_feature2_description', $locale, $request->second_section_feature2_description[$locale]);
            }
        }
        
        // Process non-translatable fields
        if ($request->has('image1')) {
            $about->image1 = $request->image1;
        }
        
        if ($request->has('image2')) {
            $about->image2 = $request->image2;
        }
        
        if ($request->has('image3')) {
            $about->image3 = $request->image3;
        }
        
        if ($request->has('signature_image')) {
            $about->signature_image = $request->signature_image;
        }
        
        if ($request->has('doctor_image')) {
            $about->doctor_image = $request->doctor_image;
        }
        
        if ($request->has('second_section_years')) {
            $about->second_section_years = $request->second_section_years;
        }
        
        // Process features as JSON
        if ($request->has('features')) {
            $features = array_filter($request->features, function($feature) {
                return !empty(trim($feature));
            });
            
            $about->features = json_encode(array_values($features));
        }
        
        // Save the record
        $about->save();
        
        return redirect()->route('about.edit')->with('success', 'About section content updated successfully');
    }
}