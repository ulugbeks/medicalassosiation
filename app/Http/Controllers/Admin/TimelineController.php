<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Timeline;
use App\Models\Language;

class TimelineController extends Controller
{
    public function index()
    {
        $timelines = Timeline::orderBy('year')->get();
        return view('admin.timeline.index', compact('timelines'));
    }

    public function create()
    {
        $languages = active_languages();
        return view('admin.timeline.create', compact('languages'));
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
            'year' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
        ]);

        $request->validate($rules);
        
        $timeline = new Timeline();
        
        // Set translatable fields
        foreach ($languages as $language) {
            $locale = $language->code;
            
            if (isset($request->title[$locale])) {
                $timeline->setTranslation('title', $locale, $request->title[$locale]);
            }
            
            if (isset($request->description[$locale])) {
                $timeline->setTranslation('description', $locale, $request->description[$locale]);
            }
        }
        
        // Set non-translatable fields
        $timeline->year = $request->year;
        $timeline->icon = $request->icon;
        
        $timeline->save();

        return redirect()->route('timeline.index')
            ->with('success', 'Timeline item created successfully.');
    }

    public function edit(Timeline $timeline)
    {
        $languages = active_languages();
        return view('admin.timeline.edit', compact('timeline', 'languages'));
    }

    public function update(Request $request, Timeline $timeline)
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
            'year' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
        ]);

        $request->validate($rules);
        
        // Update translatable fields
        foreach ($languages as $language) {
            $locale = $language->code;
            
            if (isset($request->title[$locale])) {
                $timeline->setTranslation('title', $locale, $request->title[$locale]);
            }
            
            if (isset($request->description[$locale])) {
                $timeline->setTranslation('description', $locale, $request->description[$locale]);
            }
        }
        
        // Update non-translatable fields
        $timeline->year = $request->year;
        $timeline->icon = $request->icon;
        
        $timeline->save();

        return redirect()->route('timeline.index')
            ->with('success', 'Timeline item updated successfully');
    }

    public function destroy(Timeline $timeline)
    {
        $timeline->delete();

        return redirect()->route('timeline.index')
            ->with('success', 'Timeline item deleted successfully');
    }
}