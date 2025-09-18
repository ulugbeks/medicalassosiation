<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use Illuminate\Support\Facades\Config;
use App\Models\Slider;
use App\Models\About;
use App\Models\AboutUs;
use App\Models\Service;
use App\Models\Post;
use App\Models\Category;
use App\Models\Portfolio;
use App\Models\TeamMember;
use App\Models\Setting;
use App\Models\SectionHeading;
use App\Models\ContactLocation;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();
        return view('admin.languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:5|unique:languages,code',
            'name' => 'required|string|max:50',
            'active' => 'boolean',
            'is_default' => 'boolean',
        ]);

        if ($request->has('is_default') && $request->is_default) {
            // If this language is default, make other languages non-default
            Language::where('is_default', true)->update(['is_default' => false]);
        }

        Language::create([
            'code' => $request->code,
            'name' => $request->name,
            'active' => $request->has('active') ? 1 : 0,
            'is_default' => $request->has('is_default') ? 1 : 0,
        ]);

        // Update the configuration
        $this->updateLanguageConfig();

        return redirect()->route('languages.index')
            ->with('success', 'Language added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Language $language)
    {
        return view('admin.languages.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Language $language)
    {
        $request->validate([
            'code' => 'required|string|max:5|unique:languages,code,' . $language->id,
            'name' => 'required|string|max:50',
            'active' => 'boolean',
            'is_default' => 'boolean',
        ]);

        if ($request->has('is_default') && $request->is_default) {
            // If this language is default, make other languages non-default
            Language::where('id', '!=', $language->id)
                   ->where('is_default', true)
                   ->update(['is_default' => false]);
        } else if ($language->is_default) {
            // Cannot remove default status from the current default language
            // unless there's another default language
            return redirect()->back()
                ->with('error', 'You must have one default language. Set another language as default first.');
        }

        $language->code = $request->code;
        $language->name = $request->name;
        $language->active = $request->has('active') ? 1 : 0;
        $language->is_default = $request->has('is_default') ? 1 : 0;
        $language->save();

        // Update the configuration
        $this->updateLanguageConfig();

        return redirect()->route('languages.index')
            ->with('success', 'Language updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Language $language)
    {
        if ($language->is_default) {
            return redirect()->route('languages.index')
                ->with('error', 'Cannot delete the default language');
        }

        $language->delete();

        // Update the configuration
        $this->updateLanguageConfig();

        return redirect()->route('languages.index')
            ->with('success', 'Language deleted successfully');
    }

    /**
     * Display translation dashboard.
     */
    public function dashboard()
    {
        $languages = Language::where('active', true)->get();
        $defaultLanguage = Language::where('is_default', true)->first();
        
        $translationStats = [];
        
        // Calculate statistics for each model
        
        // Sliders
        $sliders = Slider::all();
        $slidersStats = $this->calculateModelTranslationStats(
            $sliders, 
            ['title', 'subtitle', 'description', 'primary_button_text', 'secondary_button_text'], 
            $languages, 
            $defaultLanguage
        );
        $translationStats['Sliders'] = $slidersStats;
        
        // About
        $about = About::all();
        $aboutStats = $this->calculateModelTranslationStats(
            $about, 
            [
                'title', 'subtitle', 'description', 'doctor_name', 'doctor_title', 
                'second_section_subtitle', 'second_section_title', 'second_section_description',
                'second_section_feature1_title', 'second_section_feature1_description',
                'second_section_feature2_title', 'second_section_feature2_description'
            ], 
            $languages, 
            $defaultLanguage
        );
        $translationStats['About'] = $aboutStats;
        
        // AboutUs
        $aboutUs = AboutUs::all();
        $aboutUsStats = $this->calculateModelTranslationStats(
            $aboutUs, 
            ['title', 'subtitle', 'description', 'additional_title', 'additional_description', 'seo_title', 'seo_description'], 
            $languages, 
            $defaultLanguage
        );
        $translationStats['About Us Page'] = $aboutUsStats;
        
        // Services
        $services = Service::all();
        $servicesStats = $this->calculateModelTranslationStats(
            $services, 
            ['title', 'description', 'content'], 
            $languages, 
            $defaultLanguage
        );
        $translationStats['Services'] = $servicesStats;
        
        // Blog Posts
        $posts = Post::all();
        $postsStats = $this->calculateModelTranslationStats(
            $posts, 
            ['title', 'excerpt', 'content', 'seo_title', 'seo_description', 'author_name'], 
            $languages, 
            $defaultLanguage
        );
        $translationStats['Blog Posts'] = $postsStats;
        
        // Categories
        $categories = Category::all();
        $categoriesStats = $this->calculateModelTranslationStats(
            $categories, 
            ['name', 'description'], 
            $languages, 
            $defaultLanguage
        );
        $translationStats['Categories'] = $categoriesStats;
        
        // Portfolio
        $portfolios = Portfolio::all();
        $portfoliosStats = $this->calculateModelTranslationStats(
            $portfolios, 
            ['title', 'description'], 
            $languages, 
            $defaultLanguage
        );
        $translationStats['Portfolio'] = $portfoliosStats;
        
        // Team Members
        $teamMembers = TeamMember::all();
        $teamMembersStats = $this->calculateModelTranslationStats(
            $teamMembers, 
            ['name', 'title'], 
            $languages, 
            $defaultLanguage
        );
        $translationStats['Team Members'] = $teamMembersStats;
        
        // Section Headings
        $sectionHeadings = SectionHeading::all();
        $sectionHeadingsStats = $this->calculateModelTranslationStats(
            $sectionHeadings, 
            ['subtitle', 'title', 'title_span'], 
            $languages, 
            $defaultLanguage
        );
        $translationStats['Section Headings'] = $sectionHeadingsStats;
        
        // Contact Locations
        $contactLocations = ContactLocation::all();
        $contactLocationsStats = $this->calculateModelTranslationStats(
            $contactLocations, 
            ['title', 'address'], 
            $languages, 
            $defaultLanguage
        );
        $translationStats['Contact Locations'] = $contactLocationsStats;
        
        // Site Settings
        $settings = Setting::all();
        $settingsStats = $this->calculateModelTranslationStats(
            $settings, 
            ['site_name', 'site_title', 'meta_title', 'meta_description', 'address', 'working_hours', 'footer_cta_title', 'newsletter_text'], 
            $languages, 
            $defaultLanguage
        );
        $translationStats['Site Settings'] = $settingsStats;
        
        // Calculate total stats
        $totalStats = [];
        foreach ($languages as $language) {
            $totalStats[$language->code] = [
                'total' => 0,
                'translated' => 0,
                'percentage' => 0
            ];
        }
        
        foreach ($translationStats as $section => $stats) {
            foreach ($languages as $language) {
                $totalStats[$language->code]['total'] += $stats[$language->code]['total'];
                $totalStats[$language->code]['translated'] += $stats[$language->code]['translated'];
            }
        }
        
        // Calculate percentages for totals
        foreach ($languages as $language) {
            if ($totalStats[$language->code]['total'] > 0) {
                $totalStats[$language->code]['percentage'] = 
                    round(($totalStats[$language->code]['translated'] / $totalStats[$language->code]['total']) * 100);
            }
        }
        
        $translationStats['Total'] = $totalStats;
        
        // Get untranslated items counts for quick actions
        $untranslatedCounts = $this->getUntranslatedCounts($languages, $defaultLanguage);
        
        return view('admin.languages.dashboard', compact('languages', 'defaultLanguage', 'translationStats', 'untranslatedCounts'));
    }

    /**
     * Get counts of untranslated items by model type for quick actions
     *
     * @param \Illuminate\Database\Eloquent\Collection $languages
     * @param \App\Models\Language $defaultLanguage
     * @return array
     */
    protected function getUntranslatedCounts($languages, $defaultLanguage)
    {
        $counts = [];
        
        foreach ($languages as $language) {
            if ($language->is_default) {
                continue; // Skip default language
            }
            
            $counts[$language->code] = [
                'Sliders' => Slider::all()->filter(function ($slider) use ($language) {
                    return empty($slider->getTranslation('title', $language->code, false));
                })->count(),
                
                'Posts' => Post::all()->filter(function ($post) use ($language) {
                    return empty($post->getTranslation('title', $language->code, false));
                })->count(),
                
                'Categories' => Category::all()->filter(function ($category) use ($language) {
                    return empty($category->getTranslation('name', $language->code, false));
                })->count(),
                
                'Services' => Service::all()->filter(function ($service) use ($language) {
                    return empty($service->getTranslation('title', $language->code, false));
                })->count(),
            ];
        }
        
        return $counts;
    }

    /**
     * Calculate translation statistics for a model
     *
     * @param \Illuminate\Database\Eloquent\Collection $items
     * @param array $fields
     * @param \Illuminate\Database\Eloquent\Collection $languages
     * @param \App\Models\Language $defaultLanguage
     * @return array
     */
    protected function calculateModelTranslationStats($items, $fields, $languages, $defaultLanguage)
    {
        $stats = [];
        foreach ($languages as $language) {
            $stats[$language->code] = [
                'total' => count($items) * count($fields),
                'translated' => 0,
                'percentage' => 0
            ];
        }
        
        foreach ($items as $item) {
            foreach ($fields as $field) {
                foreach ($languages as $language) {
                    if (!method_exists($item, 'getTranslation')) {
                        continue;
                    }
                    
                    $translation = $item->getTranslation($field, $language->code, false);
                    if (!empty($translation)) {
                        $stats[$language->code]['translated']++;
                    }
                }
            }
        }
        
        // Calculate percentages
        foreach ($languages as $language) {
            if ($stats[$language->code]['total'] > 0) {
                $stats[$language->code]['percentage'] = 
                    round(($stats[$language->code]['translated'] / $stats[$language->code]['total']) * 100);
            }
        }
        
        return $stats;
    }

    /**
     * Show incomplete translations for a specific model type and language
     */
    public function incompleteTranslations($modelType, $languageCode)
    {
        $language = Language::where('code', $languageCode)->where('active', true)->firstOrFail();
        $defaultLanguage = Language::where('is_default', true)->first();
        
        if ($language->is_default) {
            return redirect()->route('languages.dashboard')
                ->with('error', 'Default language is always fully translated.');
        }
        
        $items = [];
        $fields = [];
        $modelName = '';
        
        switch ($modelType) {
            case 'sliders':
                $items = Slider::all()->filter(function ($slider) use ($language) {
                    return empty($slider->getTranslation('title', $language->code, false));
                });
                $fields = ['title', 'subtitle', 'description', 'primary_button_text', 'secondary_button_text'];
                $modelName = 'Sliders';
                $routePrefix = 'sliders';
                break;
            
            case 'posts':
                $items = Post::all()->filter(function ($post) use ($language) {
                    return empty($post->getTranslation('title', $language->code, false));
                });
                $fields = ['title', 'excerpt', 'content', 'seo_title', 'seo_description', 'author_name'];
                $modelName = 'Blog Posts';
                $routePrefix = 'posts';
                break;
                
            case 'categories':
                $items = Category::all()->filter(function ($category) use ($language) {
                    return empty($category->getTranslation('name', $language->code, false));
                });
                $fields = ['name', 'description'];
                $modelName = 'Categories';
                $routePrefix = 'categories';
                break;
                
            case 'services':
                $items = Service::all()->filter(function ($service) use ($language) {
                    return empty($service->getTranslation('title', $language->code, false));
                });
                $fields = ['title', 'description', 'content'];
                $modelName = 'Services';
                $routePrefix = 'services';
                break;
                
            default:
                return redirect()->route('languages.dashboard')
                    ->with('error', 'Invalid model type.');
        }
        
        return view('admin.languages.incomplete', compact('items', 'fields', 'language', 'defaultLanguage', 'modelName', 'routePrefix'));
    }

    /**
     * Copy translations from default language to a target language for all models
     */
    public function copyFromDefault($targetLanguageCode)
    {
        $targetLanguage = Language::where('code', $targetLanguageCode)
                                  ->where('active', true)
                                  ->first();
                                  
        if (!$targetLanguage) {
            return redirect()->route('languages.dashboard')
                ->with('error', 'Target language not found or not active.');
        }
        
        $defaultLanguage = Language::where('is_default', true)->first();
        
        if ($targetLanguage->code === $defaultLanguage->code) {
            return redirect()->route('languages.dashboard')
                ->with('error', 'Cannot copy to default language.');
        }
        
        // Copy translations for all models
        $this->copyModelTranslations(Slider::all(), [
            'title', 'subtitle', 'description', 'primary_button_text', 'secondary_button_text'
        ], $defaultLanguage, $targetLanguage);
        
        $this->copyModelTranslations(About::all(), [
            'title', 'subtitle', 'description', 'doctor_name', 'doctor_title', 
            'second_section_subtitle', 'second_section_title', 'second_section_description',
            'second_section_feature1_title', 'second_section_feature1_description',
            'second_section_feature2_title', 'second_section_feature2_description'
        ], $defaultLanguage, $targetLanguage);
        
        $this->copyModelTranslations(AboutUs::all(), [
            'title', 'subtitle', 'description', 'additional_title', 'additional_description', 
            'seo_title', 'seo_description'
        ], $defaultLanguage, $targetLanguage);
        
        $this->copyModelTranslations(Service::all(), [
            'title', 'description', 'content'
        ], $defaultLanguage, $targetLanguage);
        
        $this->copyModelTranslations(Post::all(), [
            'title', 'excerpt', 'content', 'seo_title', 'seo_description', 'author_name'
        ], $defaultLanguage, $targetLanguage);
        
        $this->copyModelTranslations(Category::all(), [
            'name', 'description'
        ], $defaultLanguage, $targetLanguage);
        
        $this->copyModelTranslations(Portfolio::all(), [
            'title', 'description'
        ], $defaultLanguage, $targetLanguage);
        
        $this->copyModelTranslations(TeamMember::all(), [
            'name', 'title'
        ], $defaultLanguage, $targetLanguage);
        
        $this->copyModelTranslations(SectionHeading::all(), [
            'subtitle', 'title', 'title_span'
        ], $defaultLanguage, $targetLanguage);
        
        $this->copyModelTranslations(ContactLocation::all(), [
            'title', 'address'
        ], $defaultLanguage, $targetLanguage);
        
        $this->copyModelTranslations(Setting::all(), [
            'site_name', 'site_title', 'meta_title', 'meta_description', 'address', 
            'working_hours', 'footer_cta_title', 'newsletter_text'
        ], $defaultLanguage, $targetLanguage);
        
        return redirect()->route('languages.dashboard')
            ->with('success', "Translations copied from {$defaultLanguage->name} to {$targetLanguage->name}.");
    }

    /**
     * Copy translations from default language to target language for a specific model
     *
     * @param \Illuminate\Database\Eloquent\Collection $items
     * @param array $fields
     * @param \App\Models\Language $defaultLanguage
     * @param \App\Models\Language $targetLanguage
     * @return void
     */
    protected function copyModelTranslations($items, $fields, $defaultLanguage, $targetLanguage)
    {
        foreach ($items as $item) {
            if (!method_exists($item, 'getTranslation')) {
                continue;
            }
            
            $changed = false;
            
            foreach ($fields as $field) {
                $defaultValue = $item->getTranslation($field, $defaultLanguage->code, false);
                $targetValue = $item->getTranslation($field, $targetLanguage->code, false);
                
                // Only copy if default has a value and target is empty
                if (!empty($defaultValue) && empty($targetValue)) {
                    $item->setTranslation($field, $targetLanguage->code, $defaultValue);
                    $changed = true;
                }
            }
            
            if ($changed) {
                $item->save();
            }
        }
    }

    /**
     * Update the language configuration at runtime
     *
     * @return void
     */
    protected function updateLanguageConfig()
    {
        $activeLanguages = Language::where('active', true)->pluck('code')->toArray();
        $defaultLanguage = Language::where('is_default', true)->value('code') ?? 'en';

        // Update the configuration at runtime
        Config::set('translatable.locales', $activeLanguages);
        Config::set('translatable.default_locale', $defaultLanguage);
        
        // In a production app, you might want to write these to the configuration file
        // or use the database for configuration instead of the file
    }
}