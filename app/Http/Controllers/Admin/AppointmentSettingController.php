<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppointmentSetting;

class AppointmentSettingController extends Controller
{
    public function edit()
    {
        $settings = AppointmentSetting::first();
        if (!$settings) {
            $settings = new AppointmentSetting();
            $settings->working_hours = [
                'Mon - Tues' => '09:00AM - 6:00PM',
                'Wed - Thu' => '09:00AM - 6:00PM',
                'Fri - Sat' => '09:00AM - 6:00PM',
                'Emergency' => '24/7 Hours 7 Days'
            ];
        }
        
        $languages = active_languages();
        
        return view('admin.appointment.edit', compact('settings', 'languages'));
    }

    public function update(Request $request)
    {
        $languages = active_languages();
        $defaultLanguage = default_language();
        
        $rules = [];
        foreach ($languages as $language) {
            $isRequired = $language->is_default;
            $rules["title.{$language->code}"] = 'nullable|string|max:255';
            $rules["subtitle.{$language->code}"] = 'nullable|string|max:255';
            $rules["description.{$language->code}"] = 'nullable|string';
            $rules["button_text.{$language->code}"] = 'nullable|string|max:255';
        }
        
        // Add non-translatable fields
        $rules = array_merge($rules, [
            'working_hours' => 'nullable|array',
            'active' => 'nullable|boolean',
        ]);
        
        $request->validate($rules);
        
        $settings = AppointmentSetting::first();
        if (!$settings) {
            $settings = new AppointmentSetting();
        }
        
        // Set translatable fields
        foreach ($languages as $language) {
            $locale = $language->code;
            
            if (isset($request->title[$locale])) {
                $settings->setTranslation('title', $locale, $request->title[$locale]);
            }
            
            if (isset($request->subtitle[$locale])) {
                $settings->setTranslation('subtitle', $locale, $request->subtitle[$locale]);
            }
            
            if (isset($request->description[$locale])) {
                $settings->setTranslation('description', $locale, $request->description[$locale]);
            }
            
            if (isset($request->button_text[$locale])) {
                $settings->setTranslation('button_text', $locale, $request->button_text[$locale]);
            }
        }
        
        // Set non-translatable fields
        $settings->active = $request->has('active');
        
        // Process working hours
        if ($request->has('working_hours')) {
            $workingHours = [];
            $days = $request->input('working_hours.days', []);
            $hours = $request->input('working_hours.hours', []);
            
            foreach ($days as $index => $day) {
                if (!empty($day) && isset($hours[$index])) {
                    $workingHours[$day] = $hours[$index];
                }
            }
            
            $settings->working_hours = $workingHours;
        }
        
        $settings->save();
        
        return redirect()->route('appointment.edit')
            ->with('success', 'Appointment settings updated successfully');
    }
}