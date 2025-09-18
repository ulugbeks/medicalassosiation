<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('posts')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = active_languages();
        return view('admin.categories.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $languages = active_languages();
        $defaultLanguage = default_language();
        
        $rules = [];
        foreach ($languages as $language) {
            $isRequired = $language->is_default;
            $rules["name.{$language->code}"] = $isRequired ? 'required|string|max:255' : 'nullable|string|max:255';
            $rules["description.{$language->code}"] = 'nullable|string';
        }
        
        $request->validate($rules);
        
        $category = new Category();
        
        // Set translatable fields
        foreach ($languages as $language) {
            $locale = $language->code;
            
            if (isset($request->name[$locale])) {
                $category->setTranslation('name', $locale, $request->name[$locale]);
            }
            
            if (isset($request->description[$locale])) {
                $category->setTranslation('description', $locale, $request->description[$locale]);
            }
        }
        
        // Generate slug from default language name
        $defaultLocale = $defaultLanguage->code;
        $name = $request->name[$defaultLocale];
        $slug = Str::slug($name);
        
        // Ensure the slug is unique
        $originalSlug = $slug;
        $count = 1;
        while (Category::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        
        $category->slug = $slug;
        $category->save();
        
        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $languages = active_languages();
        return view('admin.categories.edit', compact('category', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $languages = active_languages();
        $defaultLanguage = default_language();
        
        $rules = [];
        foreach ($languages as $language) {
            $isRequired = $language->is_default;
            $rules["name.{$language->code}"] = $isRequired ? 'required|string|max:255' : 'nullable|string|max:255';
            $rules["description.{$language->code}"] = 'nullable|string';
        }
        
        $request->validate($rules);
        
        // Update translatable fields
        foreach ($languages as $language) {
            $locale = $language->code;
            
            if (isset($request->name[$locale])) {
                $category->setTranslation('name', $locale, $request->name[$locale]);
            }
            
            if (isset($request->description[$locale])) {
                $category->setTranslation('description', $locale, $request->description[$locale]);
            }
        }
        
        // If name changed in default language, update slug
        $defaultLocale = $defaultLanguage->code;
        $newName = $request->name[$defaultLocale];
        $oldName = $category->getTranslation('name', $defaultLocale, false);
        
        if ($newName != $oldName) {
            $slug = Str::slug($newName);
            
            // Ensure the slug is unique
            $originalSlug = $slug;
            $count = 1;
            while (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            
            $category->slug = $slug;
        }
        
        $category->save();
        
        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Check if category has posts
        if ($category->posts()->count() > 0) {
            return redirect()->route('categories.index')
                ->with('error', 'Cannot delete category with associated posts.');
        }
        
        $category->delete();
        
        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}