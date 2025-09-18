<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StaticPage;
use App\Models\Language;
use App\Http\Controllers\Admin\Traits\AjaxResponseTrait;

class StaticPageController extends Controller
{
    use AjaxResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staticPages = StaticPage::orderBy('order')->get();
        return view('admin.static-pages.index', compact('staticPages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::where('active', true)->get();
        return view('admin.static-pages.create', compact('languages'));
    }

    public function store(Request $request)
    {
        $staticPage = null;
        
        return $this->handleAjaxStore($request, function() use ($request, &$staticPage) {
            $request->validate([
                'slug' => 'required|string|max:255|unique:static_pages,slug',
                'title.*' => 'required|string|max:255',
                'content.*' => 'required|string',
                'active' => 'nullable|boolean',
                'order' => 'integer'
            ]);

            $staticPage = new StaticPage();
            $staticPage->slug = $request->slug;
            $staticPage->active = (bool) $request->input('active', false);
            $staticPage->order = $request->order ?? 0;

            // Handle translations
            $languages = Language::where('active', true)->get();
            foreach ($languages as $language) {
                $locale = $language->code;
                
                if (isset($request->title[$locale])) {
                    $staticPage->setTranslation('title', $locale, $request->title[$locale]);
                }
                
                if (isset($request->content[$locale])) {
                    $staticPage->setTranslation('content', $locale, $request->content[$locale]);
                }
                
                if (isset($request->seo_title[$locale])) {
                    $staticPage->setTranslation('seo_title', $locale, $request->seo_title[$locale]);
                }
                
                if (isset($request->seo_description[$locale])) {
                    $staticPage->setTranslation('seo_description', $locale, $request->seo_description[$locale]);
                }
            }

            $staticPage->save();
            
            return redirect()->route('static-pages.index')->with('success', 'Static page created successfully!');
        }, 'Static page created successfully!', [
            'edit_url' => $staticPage ? route('static-pages.edit', $staticPage) : null
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(StaticPage $staticPage)
    {
        return view('admin.static-pages.show', compact('staticPage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StaticPage $staticPage)
    {
        $languages = Language::where('active', true)->get();
        return view('admin.static-pages.edit', compact('staticPage', 'languages'));
    }

    public function update(Request $request, StaticPage $staticPage)
    {
        return $this->handleAjaxUpdate($request, function() use ($request, $staticPage) {
            $request->validate([
                'slug' => 'required|string|max:255|unique:static_pages,slug,' . $staticPage->id,
                'title.*' => 'required|string|max:255',
                'content.*' => 'required|string',
                'active' => 'nullable|boolean',
                'order' => 'integer'
            ]);

            $staticPage->slug = $request->slug;
            $staticPage->active = (bool) $request->input('active', false);
            $staticPage->order = $request->order ?? 0;

            // Handle translations
            $languages = Language::where('active', true)->get();
            foreach ($languages as $language) {
                $locale = $language->code;
                
                if (isset($request->title[$locale])) {
                    $staticPage->setTranslation('title', $locale, $request->title[$locale]);
                }
                
                if (isset($request->content[$locale])) {
                    $staticPage->setTranslation('content', $locale, $request->content[$locale]);
                }
                
                if (isset($request->seo_title[$locale])) {
                    $staticPage->setTranslation('seo_title', $locale, $request->seo_title[$locale]);
                }
                
                if (isset($request->seo_description[$locale])) {
                    $staticPage->setTranslation('seo_description', $locale, $request->seo_description[$locale]);
                }
            }

            $staticPage->save();
            
            return redirect()->route('static-pages.index')->with('success', 'Static page updated successfully!');
        }, 'Static page updated successfully!');
    }

    public function destroy(StaticPage $staticPage)
    {
        return $this->handleAjaxDelete(request(), function() use ($staticPage) {
            $staticPage->delete();
            return redirect()->route('static-pages.index')->with('success', 'Static page deleted successfully!');
        }, 'Static page deleted successfully!');
    }
}