<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Language;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('order')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        $languages = Language::where('active', true)->get();
        return view('admin.sliders.create', compact('languages'));
    }

    public function store(Request $request)
    {
        // Validation
        $languages = Language::where('active', true)->get();
        $defaultLanguage = Language::where('is_default', true)->first();
        
        $rules = [];
        foreach ($languages as $language) {
            $isRequired = $language->is_default;
            $rules["title.{$language->code}"] = $isRequired ? 'required|string|max:255' : 'nullable|string|max:255';
            $rules["subtitle.{$language->code}"] = 'nullable|string|max:255';
            $rules["description.{$language->code}"] = 'nullable|string';
            $rules["primary_button_text.{$language->code}"] = 'nullable|string|max:255';
            $rules["secondary_button_text.{$language->code}"] = 'nullable|string|max:255';
        }
        
        $rules = array_merge($rules, [
            'image_path' => 'required|string|max:255',
            'primary_button_url' => 'nullable|string|max:255',
            'secondary_button_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'active' => 'boolean',
        ]);
        
        $request->validate($rules);
        
        // Create new slider
        $slider = new Slider();
        
        // Set translatable fields
        foreach ($languages as $language) {
            $locale = $language->code;
            
            if (isset($request->title[$locale])) {
                $slider->setTranslation('title', $locale, $request->title[$locale]);
            }
            
            if (isset($request->subtitle[$locale])) {
                $slider->setTranslation('subtitle', $locale, $request->subtitle[$locale]);
            }
            
            if (isset($request->description[$locale])) {
                $slider->setTranslation('description', $locale, $request->description[$locale]);
            }
            
            if (isset($request->primary_button_text[$locale])) {
                $slider->setTranslation('primary_button_text', $locale, $request->primary_button_text[$locale]);
            }
            
            if (isset($request->secondary_button_text[$locale])) {
                $slider->setTranslation('secondary_button_text', $locale, $request->secondary_button_text[$locale]);
            }
        }
        
        // Set non-translatable fields
        $slider->image_path = $request->image_path;
        $slider->primary_button_url = $request->primary_button_url;
        $slider->secondary_button_url = $request->secondary_button_url;
        $slider->order = $request->order ?? 0;
        $slider->active = $request->has('active') ? 1 : 0;
        
        $slider->save();
        
        return redirect()->route('sliders.index')
            ->with('success', 'Slider created successfully.');
    }

    public function edit(Slider $slider)
    {
        $languages = Language::where('active', true)->get();
        return view('admin.sliders.edit', compact('slider', 'languages'));
    }

    public function update(Request $request, Slider $slider)
    {
        $languages = Language::where('active', true)->get();
        $defaultLanguage = Language::where('is_default', true)->first();
        
        // Validation
        $rules = [];
        foreach ($languages as $language) {
            $isRequired = $language->is_default;
            $rules["title.{$language->code}"] = $isRequired ? 'required|string|max:255' : 'nullable|string|max:255';
            $rules["subtitle.{$language->code}"] = 'nullable|string|max:255';
            $rules["description.{$language->code}"] = 'nullable|string';
            $rules["primary_button_text.{$language->code}"] = 'nullable|string|max:255';
            $rules["secondary_button_text.{$language->code}"] = 'nullable|string|max:255';
        }
        
        $rules = array_merge($rules, [
            'image_path' => 'required|string|max:255',
            'primary_button_url' => 'nullable|string|max:255',
            'secondary_button_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'active' => 'boolean',
        ]);
        
        $request->validate($rules);
        
        // Update translatable fields
        foreach ($languages as $language) {
            $locale = $language->code;
            
            if (isset($request->title[$locale])) {
                $slider->setTranslation('title', $locale, $request->title[$locale]);
            }
            
            if (isset($request->subtitle[$locale])) {
                $slider->setTranslation('subtitle', $locale, $request->subtitle[$locale]);
            }
            
            if (isset($request->description[$locale])) {
                $slider->setTranslation('description', $locale, $request->description[$locale]);
            }
            
            if (isset($request->primary_button_text[$locale])) {
                $slider->setTranslation('primary_button_text', $locale, $request->primary_button_text[$locale]);
            }
            
            if (isset($request->secondary_button_text[$locale])) {
                $slider->setTranslation('secondary_button_text', $locale, $request->secondary_button_text[$locale]);
            }
        }
        
        // Set non-translatable fields
        $slider->image_path = $request->image_path;
        $slider->primary_button_url = $request->primary_button_url;
        $slider->secondary_button_url = $request->secondary_button_url;
        $slider->order = $request->order;
        $slider->active = $request->has('active') ? 1 : 0;
        
        $slider->save();
        
        return redirect()->route('sliders.index')
            ->with('success', 'Slider updated successfully');
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();

        return redirect()->route('sliders.index')
            ->with('success', 'Slider deleted successfully');
    }
}