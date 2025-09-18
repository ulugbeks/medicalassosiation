<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\Language;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::orderBy('order')->get();
        return view('admin.portfolio.index', compact('portfolios'));
    }

    public function create()
    {
        $languages = active_languages();
        return view('admin.portfolio.create', compact('languages'));
    }

    public function store(Request $request)
    {
        $languages = active_languages();
        $defaultLanguage = default_language();
        
        $rules = [];
        foreach ($languages as $language) {
            $isRequired = $language->is_default;
            $rules["title.{$language->code}"] = $isRequired ? 'required|string|max:255' : 'nullable|string|max:255';
            $rules["category.{$language->code}"] = $isRequired ? 'required|string|max:255' : 'nullable|string|max:255';
            $rules["description.{$language->code}"] = 'nullable|string';
        }
        
        $rules = array_merge($rules, [
            'image' => 'required|string|max:255',
            'order' => 'nullable|integer',
            'active' => 'nullable|boolean',
        ]);

        $request->validate($rules);
        
        $portfolio = new Portfolio();
        
        // Set translatable fields
        foreach ($languages as $language) {
            $locale = $language->code;
            
            if (isset($request->title[$locale])) {
                $portfolio->setTranslation('title', $locale, $request->title[$locale]);
            }
            
            if (isset($request->category[$locale])) {
                $portfolio->setTranslation('category', $locale, $request->category[$locale]);
            }
            
            if (isset($request->description[$locale])) {
                $portfolio->setTranslation('description', $locale, $request->description[$locale]);
            }
        }
        
        // Set non-translatable fields
        $portfolio->image = $request->image;
        $portfolio->order = $request->order ?? 0;
        $portfolio->active = $request->has('active') ? 1 : 0;
        
        $portfolio->save();

        return redirect()->route('portfolio.index')
            ->with('success', 'Portfolio item created successfully.');
    }

    public function edit(Portfolio $portfolio)
    {
        $languages = active_languages();
        return view('admin.portfolio.edit', compact('portfolio', 'languages'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $languages = active_languages();
        $defaultLanguage = default_language();
        
        $rules = [];
        foreach ($languages as $language) {
            $isRequired = $language->is_default;
            $rules["title.{$language->code}"] = $isRequired ? 'required|string|max:255' : 'nullable|string|max:255';
            $rules["category.{$language->code}"] = $isRequired ? 'required|string|max:255' : 'nullable|string|max:255';
            $rules["description.{$language->code}"] = 'nullable|string';
        }
        
        $rules = array_merge($rules, [
            'image' => 'required|string|max:255',
            'order' => 'nullable|integer',
            'active' => 'nullable|boolean',
        ]);

        $request->validate($rules);
        
        // Update translatable fields
        foreach ($languages as $language) {
            $locale = $language->code;
            
            if (isset($request->title[$locale])) {
                $portfolio->setTranslation('title', $locale, $request->title[$locale]);
            }
            
            if (isset($request->category[$locale])) {
                $portfolio->setTranslation('category', $locale, $request->category[$locale]);
            }
            
            if (isset($request->description[$locale])) {
                $portfolio->setTranslation('description', $locale, $request->description[$locale]);
            }
        }
        
        // Update non-translatable fields
        $portfolio->image = $request->image;
        $portfolio->order = $request->order;
        $portfolio->active = $request->has('active') ? 1 : 0;
        
        $portfolio->save();

        return redirect()->route('portfolio.index')
            ->with('success', 'Portfolio item updated successfully.');
    }

    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();

        return redirect()->route('portfolio.index')
            ->with('success', 'Portfolio item deleted successfully.');
    }
}