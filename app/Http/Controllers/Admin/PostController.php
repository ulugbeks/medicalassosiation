<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category')
                     ->orderBy('created_at', 'desc')
                     ->paginate(10);
        
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $languages = active_languages();
        return view('admin.posts.create', compact('categories', 'languages'));
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
            $rules["title.{$language->code}"] = $isRequired ? 'required|string|max:255' : 'nullable|string|max:255';
            $rules["excerpt.{$language->code}"] = 'nullable|string';
            $rules["content.{$language->code}"] = $isRequired ? 'required|string' : 'nullable|string';
            $rules["seo_title.{$language->code}"] = 'nullable|string|max:255';
            $rules["seo_description.{$language->code}"] = 'nullable|string';
            $rules["author_name.{$language->code}"] = 'nullable|string|max:255';
        }
        
        $rules = array_merge($rules, [
            'category_id' => 'exists:categories,id',
            'featured_image' => 'required|string|max:255',
            'active' => 'boolean',
            'author_link' => 'nullable|string|max:255',
        ]);
        
        $request->validate($rules);
        
        $post = new Post();
        
        // Set translatable fields
        foreach ($languages as $language) {
            $locale = $language->code;
            
            if (isset($request->title[$locale])) {
                $post->setTranslation('title', $locale, $request->title[$locale]);
            }
            
            if (isset($request->excerpt[$locale])) {
                $post->setTranslation('excerpt', $locale, $request->excerpt[$locale]);
            }
            
            if (isset($request->content[$locale])) {
                $post->setTranslation('content', $locale, $request->content[$locale]);
            }
            
            if (isset($request->seo_title[$locale])) {
                $post->setTranslation('seo_title', $locale, $request->seo_title[$locale]);
            }
            
            if (isset($request->seo_description[$locale])) {
                $post->setTranslation('seo_description', $locale, $request->seo_description[$locale]);
            }
            
            if (isset($request->author_name[$locale])) {
                $post->setTranslation('author_name', $locale, $request->author_name[$locale]);
            }
        }
        
        // Generate slug from default language title
        $defaultLocale = $defaultLanguage->code;
        $title = $request->title[$defaultLocale];
        $slug = Str::slug($title);
        
        // Ensure the slug is unique
        $originalSlug = $slug;
        $count = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        
        $post->slug = $slug;
        $post->category_id = $request->category_id;
        $post->featured_image = $request->featured_image;
        $post->author_link = $request->author_link;
        $post->active = $request->has('active') ? 1 : 0;
        $post->save();
        
        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $languages = active_languages();
        return view('admin.posts.edit', compact('post', 'categories', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $languages = active_languages();
        $defaultLanguage = default_language();
        
        $rules = [];
        foreach ($languages as $language) {
            $isRequired = $language->is_default;
            $rules["title.{$language->code}"] = $isRequired ? 'required|string|max:255' : 'nullable|string|max:255';
            $rules["excerpt.{$language->code}"] = 'nullable|string';
            $rules["content.{$language->code}"] = $isRequired ? 'required|string' : 'nullable|string';
            $rules["seo_title.{$language->code}"] = 'nullable|string|max:255';
            $rules["seo_description.{$language->code}"] = 'nullable|string';
            $rules["author_name.{$language->code}"] = 'nullable|string|max:255';
        }
        
        $rules = array_merge($rules, [
            'category_id' => 'exists:categories,id',
            'featured_image' => 'required|string|max:255',
            'active' => 'boolean',
            'author_link' => 'nullable|string|max:255',
        ]);
        
        $request->validate($rules);
        
        // Update translatable fields
        foreach ($languages as $language) {
            $locale = $language->code;
            
            if (isset($request->title[$locale])) {
                $post->setTranslation('title', $locale, $request->title[$locale]);
            }
            
            if (isset($request->excerpt[$locale])) {
                $post->setTranslation('excerpt', $locale, $request->excerpt[$locale]);
            }
            
            if (isset($request->content[$locale])) {
                $post->setTranslation('content', $locale, $request->content[$locale]);
            }
            
            if (isset($request->seo_title[$locale])) {
                $post->setTranslation('seo_title', $locale, $request->seo_title[$locale]);
            }
            
            if (isset($request->seo_description[$locale])) {
                $post->setTranslation('seo_description', $locale, $request->seo_description[$locale]);
            }
            
            if (isset($request->author_name[$locale])) {
                $post->setTranslation('author_name', $locale, $request->author_name[$locale]);
            }
        }
        
        // If title changed in default language, update slug
        $defaultLocale = $defaultLanguage->code;
        $newTitle = $request->title[$defaultLocale];
        $oldTitle = $post->getTranslation('title', $defaultLocale, false);
        
        if ($newTitle != $oldTitle) {
            $slug = Str::slug($newTitle);
            
            // Ensure the slug is unique
            $originalSlug = $slug;
            $count = 1;
            while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            
            $post->slug = $slug;
        }
        
        $post->category_id = $request->category_id;
        $post->featured_image = $request->featured_image;
        $post->author_link = $request->author_link;
        $post->active = $request->has('active') ? 1 : 0;
        $post->save();
        
        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        
        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully.');
    }
}