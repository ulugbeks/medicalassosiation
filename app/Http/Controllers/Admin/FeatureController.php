<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feature;
use App\Models\Language;

class FeatureController extends Controller
{
    public function index()
    {
        $features = Feature::orderBy('order')->get();
        return view('admin.features.index', compact('features'));
    }

    public function create()
    {
        $languages = active_languages();
        return view('admin.features.create', compact('languages'));
    }

    public function store(Request $request)
    {
        $languages = active_languages();
        $defaultLanguage = default_language();
        
        $rules = [];
        foreach ($languages as $language) {
            $isRequired = $language->is_default;
            $rules["title.{$language->code}"] = $isRequired ? 'required|string|max:255' : 'nullable|string|max:255';
            $rules["description.{$language->code}"] = 'nullable|string';
        }
        
        $rules = array_merge($rules, [
            'icon' => 'nullable|string|max:255',
            'link_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'active' => 'boolean',
        ]);
        
        $request->validate($rules);
        
        $feature = new Feature();
        
        // Set translatable fields
        foreach ($languages as $language) {
            $locale = $language->code;
            
            if (isset($request->title[$locale])) {
                $feature->setTranslation('title', $locale, $request->title[$locale]);
            }
            
            if (isset($request->description[$locale])) {
                $feature->setTranslation('description', $locale, $request->description[$locale]);
            }
        }
        
        // Set non-translatable fields
        $feature->icon = $request->icon;
        $feature->link_url = $request->link_url;
        $feature->order = $request->order ?? 0;
        $feature->active = $request->has('active') ? 1 : 0;
        
        $feature->save();
        
        return redirect()->route('features.index')
            ->with('success', 'Feature created successfully.');
    }

    public function edit(Feature $feature)
    {
        $languages = active_languages();
        return view('admin.features.edit', compact('feature', 'languages'));
    }

    public function update(Request $request, Feature $feature)
    {
        $languages = active_languages();
        $defaultLanguage = default_language();
        
        $rules = [];
        foreach ($languages as $language) {
            $isRequired = $language->is_default;
            $rules["title.{$language->code}"] = $isRequired ? 'required|string|max:255' : 'nullable|string|max:255';
            $rules["description.{$language->code}"] = 'nullable|string';
        }
        
        $rules = array_merge($rules, [
            'icon' => 'nullable|string|max:255',
            'link_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'active' => 'boolean',
        ]);
        
        $request->validate($rules);
        
        // Update translatable fields
        foreach ($languages as $language) {
            $locale = $language->code;
            
            if (isset($request->title[$locale])) {
                $feature->setTranslation('title', $locale, $request->title[$locale]);
            }
            
            if (isset($request->description[$locale])) {
                $feature->setTranslation('description', $locale, $request->description[$locale]);
            }
        }
        
        // Update non-translatable fields
        $feature->icon = $request->icon;
        $feature->link_url = $request->link_url;
        $feature->order = $request->order;
        $feature->active = $request->has('active') ? 1 : 0;
        
        $feature->save();
        
        return redirect()->route('features.index')
            ->with('success', 'Feature updated successfully');
    }

    public function destroy(Feature $feature)
    {
        $feature->delete();

        return redirect()->route('features.index')
            ->with('success', 'Feature deleted successfully');
    }
}