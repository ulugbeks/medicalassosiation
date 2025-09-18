<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactLocation;
use App\Models\Language;

class ContactLocationController extends Controller
{
    public function index()
    {
        $locations = ContactLocation::all();
        return view('admin.contact-locations.index', compact('locations'));
    }

    public function create()
    {
        $languages = active_languages();
        return view('admin.contact-locations.create', compact('languages'));
    }

    public function store(Request $request)
    {
        $languages = active_languages();
        $defaultLanguage = default_language();
        
        $rules = [];
        foreach ($languages as $language) {
            $isRequired = $language->is_default;
            $rules["title.{$language->code}"] = $isRequired ? 'required|string|max:255' : 'nullable|string|max:255';
            $rules["address.{$language->code}"] = $isRequired ? 'required|string|max:255' : 'nullable|string|max:255';
        }
        
        $rules = array_merge($rules, [
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
        ]);

        $request->validate($rules);
        
        $location = new ContactLocation();
        
        // Set translatable fields
        foreach ($languages as $language) {
            $locale = $language->code;
            
            if (isset($request->title[$locale])) {
                $location->setTranslation('title', $locale, $request->title[$locale]);
            }
            
            if (isset($request->address[$locale])) {
                $location->setTranslation('address', $locale, $request->address[$locale]);
            }
        }
        
        // Set non-translatable fields
        $location->email = $request->email;
        $location->phone = $request->phone;
        
        $location->save();

        return redirect()->route('contact-locations.index')
            ->with('success', 'Contact location created successfully.');
    }

    public function edit(ContactLocation $contactLocation)
    {
        $languages = active_languages();
        return view('admin.contact-locations.edit', compact('contactLocation', 'languages'));
    }

    public function update(Request $request, ContactLocation $contactLocation)
    {
        $languages = active_languages();
        $defaultLanguage = default_language();
        
        $rules = [];
        foreach ($languages as $language) {
            $isRequired = $language->is_default;
            $rules["title.{$language->code}"] = $isRequired ? 'required|string|max:255' : 'nullable|string|max:255';
            $rules["address.{$language->code}"] = $isRequired ? 'required|string|max:255' : 'nullable|string|max:255';
        }
        
        $rules = array_merge($rules, [
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
        ]);

        $request->validate($rules);
        
        // Update translatable fields
        foreach ($languages as $language) {
            $locale = $language->code;
            
            if (isset($request->title[$locale])) {
                $contactLocation->setTranslation('title', $locale, $request->title[$locale]);
            }
            
            if (isset($request->address[$locale])) {
                $contactLocation->setTranslation('address', $locale, $request->address[$locale]);
            }
        }
        
        // Update non-translatable fields
        $contactLocation->email = $request->email;
        $contactLocation->phone = $request->phone;
        
        $contactLocation->save();

        return redirect()->route('contact-locations.index')
            ->with('success', 'Contact location updated successfully');
    }

    public function destroy(ContactLocation $contactLocation)
    {
        $contactLocation->delete();

        return redirect()->route('contact-locations.index')
            ->with('success', 'Contact location deleted successfully');
    }
}