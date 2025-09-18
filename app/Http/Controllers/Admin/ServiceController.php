<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Language;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('order')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $languages = active_languages();
        return view('admin.services.create', compact('languages'));
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
            $rules["content.{$language->code}"] = 'nullable|string';
        }
        
        $rules = array_merge($rules, [
            'image' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'active' => 'boolean',
        ]);
        
        $request->validate($rules);
        
        $service = new Service();
        
        // Set translatable fields
        foreach ($languages as $language) {
            $locale = $language->code;
            
            if (isset($request->title[$locale])) {
                $service->setTranslation('title', $locale, $request->title[$locale]);
            }
            
            if (isset($request->description[$locale])) {
                $service->setTranslation('description', $locale, $request->description[$locale]);
            }
            
            if (isset($request->content[$locale])) {
                $service->setTranslation('content', $locale, $request->content[$locale]);
            }
        }
        
        // Set non-translatable fields
        $service->image = $request->image;
        $service->icon = $request->icon;
        $service->order = $request->order ?? 0;
        $service->active = $request->has('active') ? 1 : 0;
        
        $service->save();
        
        return redirect()->route('services.index')
            ->with('success', 'Service created successfully.');
    }

    public function show(Service $service)
    {
        return view('admin.services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        $languages = active_languages();
        return view('admin.services.edit', compact('service', 'languages'));
    }

    public function update(Request $request, Service $service)
    {
        $languages = active_languages();
        $defaultLanguage = default_language();
        
        $rules = [];
        foreach ($languages as $language) {
            $isRequired = $language->is_default;
            $rules["title.{$language->code}"] = $isRequired ? 'required|string|max:255' : 'nullable|string|max:255';
            $rules["description.{$language->code}"] = 'nullable|string';
            $rules["content.{$language->code}"] = 'nullable|string';
        }
        
        $rules = array_merge($rules, [
            'image' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'active' => 'boolean',
        ]);
        
        $request->validate($rules);
        
        // Update translatable fields
        foreach ($languages as $language) {
            $locale = $language->code;
            
            if (isset($request->title[$locale])) {
                $service->setTranslation('title', $locale, $request->title[$locale]);
            }
            
            if (isset($request->description[$locale])) {
                $service->setTranslation('description', $locale, $request->description[$locale]);
            }
            
            if (isset($request->content[$locale])) {
                $service->setTranslation('content', $locale, $request->content[$locale]);
            }
        }
        
        // Update non-translatable fields
        $service->image = $request->image;
        $service->icon = $request->icon;
        $service->order = $request->order;
        $service->active = $request->has('active') ? 1 : 0;
        
        $service->save();
        
        return redirect()->route('services.index')
            ->with('success', 'Service updated successfully');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')
            ->with('success', 'Service deleted successfully');
    }
}