<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SectionHeading;
use Illuminate\Http\Request;

class SectionHeadingController extends Controller
{
    /**
     * Show the form for editing section headings.
     */
    public function edit()
    {
        // Get or create the portfolio section heading
        $portfolio = SectionHeading::firstOrCreate(
            ['section_key' => 'portfolio'],
            [
                'subtitle' => 'Latest Portfolio',
                'title' => 'We\'ve Done A Lot\'s, Check',
                'title_span' => 'Our Latest Research'
            ]
        );
        
        // Get or create the blog section heading
        $blog = SectionHeading::firstOrCreate(
            ['section_key' => 'blog'],
            [
                'subtitle' => 'Recent Articles',
                'title' => 'Innovation in Focus Stories',
                'title_span' => 'Updated From Lab'
            ]
        );
        
        $languages = active_languages();
        
        return view('admin.section-headings.edit', compact('portfolio', 'blog', 'languages'));
    }

    /**
     * Update the section headings.
     */
    public function update(Request $request)
    {
        $languages = active_languages();
        $defaultLanguage = default_language();
        
        $rules = [];
        foreach ($languages as $language) {
            $isRequired = $language->is_default;
            // Portfolio rules
            $rules["portfolio_subtitle.{$language->code}"] = 'nullable|string|max:255';
            $rules["portfolio_title.{$language->code}"] = 'nullable|string|max:255';
            $rules["portfolio_title_span.{$language->code}"] = 'nullable|string|max:255';
            
            // Blog rules
            $rules["blog_subtitle.{$language->code}"] = 'nullable|string|max:255';
            $rules["blog_title.{$language->code}"] = 'nullable|string|max:255';
            $rules["blog_title_span.{$language->code}"] = 'nullable|string|max:255';
        }
        
        $request->validate($rules);
        
        // Update portfolio section
        $portfolio = SectionHeading::where('section_key', 'portfolio')->first();
        if ($portfolio) {
            foreach ($languages as $language) {
                $locale = $language->code;
                
                if (isset($request->{"portfolio_subtitle"}[$locale])) {
                    $portfolio->setTranslation('subtitle', $locale, $request->{"portfolio_subtitle"}[$locale]);
                }
                
                if (isset($request->{"portfolio_title"}[$locale])) {
                    $portfolio->setTranslation('title', $locale, $request->{"portfolio_title"}[$locale]);
                }
                
                if (isset($request->{"portfolio_title_span"}[$locale])) {
                    $portfolio->setTranslation('title_span', $locale, $request->{"portfolio_title_span"}[$locale]);
                }
            }
            
            $portfolio->save();
        }
        
        // Update blog section
        $blog = SectionHeading::where('section_key', 'blog')->first();
        if ($blog) {
            foreach ($languages as $language) {
                $locale = $language->code;
                
                if (isset($request->{"blog_subtitle"}[$locale])) {
                    $blog->setTranslation('subtitle', $locale, $request->{"blog_subtitle"}[$locale]);
                }
                
                if (isset($request->{"blog_title"}[$locale])) {
                    $blog->setTranslation('title', $locale, $request->{"blog_title"}[$locale]);
                }
                
                if (isset($request->{"blog_title_span"}[$locale])) {
                    $blog->setTranslation('title_span', $locale, $request->{"blog_title_span"}[$locale]);
                }
            }
            
            $blog->save();
        }
        
        return redirect()->route('section-headings.edit')
            ->with('success', 'Section headings updated successfully');
    }
}