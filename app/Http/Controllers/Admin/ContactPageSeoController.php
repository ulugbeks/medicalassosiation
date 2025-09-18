<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactPageSeo;

class ContactPageSeoController extends Controller
{
    public function edit()
    {
        $seo = ContactPageSeo::first();
        if (!$seo) {
            $seo = new ContactPageSeo();
        }
        
        $languages = active_languages();
        
        return view('admin.contact-page-seo.edit', compact('seo', 'languages'));
    }

    public function update(Request $request)
    {
        $languages = active_languages();
        $defaultLanguage = default_language();
        
        $rules = [];
        foreach ($languages as $language) {
            $isRequired = $language->is_default;
            $rules["seo_title.{$language->code}"] = 'nullable|string|max:255';
            $rules["seo_description.{$language->code}"] = 'nullable|string';
        }
        
        $request->validate($rules);
        
        $seo = ContactPageSeo::first();
        if (!$seo) {
            $seo = new ContactPageSeo();
        }
        
        // Set translatable fields
        foreach ($languages as $language) {
            $locale = $language->code;
            
            if (isset($request->seo_title[$locale])) {
                $seo->setTranslation('seo_title', $locale, $request->seo_title[$locale]);
            }
            
            if (isset($request->seo_description[$locale])) {
                $seo->setTranslation('seo_description', $locale, $request->seo_description[$locale]);
            }
        }
        
        $seo->save();
        
        return redirect()->route('contact-page-seo.edit')->with('success', 'Contact page SEO settings updated successfully');
    }
}