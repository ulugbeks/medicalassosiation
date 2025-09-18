<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomePageSeo;
use App\Models\Language;

class HomePageSeoController extends Controller
{
    public function edit()
    {
        $seo = HomePageSeo::first();
        if (!$seo) {
            $seo = new HomePageSeo();
        }
        
        return view('admin.home-page-seo.edit', compact('seo'));
    }

    public function update(Request $request)
    {
        $languages = Language::where('active', true)->get();
        
        $rules = [];
        foreach ($languages as $language) {
            $rules["seo_title.{$language->code}"] = 'nullable|string|max:255';
            $rules["seo_description.{$language->code}"] = 'nullable|string';
        }
        
        $request->validate($rules);
        
        $seo = HomePageSeo::first();
        if (!$seo) {
            $seo = new HomePageSeo();
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
        
        return redirect()->route('home-page-seo.edit')->with('success', 'Home page SEO settings updated successfully');
    }
}