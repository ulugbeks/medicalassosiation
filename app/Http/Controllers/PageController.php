<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Feature;
use App\Models\About;
use App\Models\AboutUs;
use App\Models\Service;
use App\Models\Post;
use App\Models\Timeline;
use App\Models\Setting;
use App\Models\TeamMember;
use App\Models\Portfolio;
use App\Models\SectionHeading; 
use App\Models\AppointmentSetting;
use App\Models\HomePageSeo;

class PageController extends Controller
{
    public function home()
    {
        $sliders = Slider::where('active', 1)->orderBy('order')->get();
        $features = Feature::where('active', 1)->orderBy('order')->limit(4)->get();
        $about = About::first();
        $services = Service::where('active', 1)->orderBy('order')->get();
        $team_members = TeamMember::where('active', 1)->orderBy('order')->get();
        $portfolios = Portfolio::where('active', 1)->orderBy('order')->get();
        $appointment_settings = AppointmentSetting::first();

        // Get SEO data
        $seo = HomePageSeo::first();

        $recent_posts = [];
        try {
            $recent_posts = Post::where('active', 1)
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get();
        } catch (\Exception $e) {
            // The posts table may not exist
        }

        $settings = Setting::first();
        
        // Get section headings
        $portfolio_heading = SectionHeading::where('section_key', 'portfolio')->first();
        $blog_heading = SectionHeading::where('section_key', 'blog')->first();
        
        // If headings don't exist, create them with default values
        if (!$portfolio_heading) {
            $portfolio_heading = new SectionHeading([
                'section_key' => 'portfolio',
                'subtitle' => 'Latest Portfolio',
                'title' => 'We\'ve Done A Lot\'s, Check',
                'title_span' => 'Our Latest Research'
            ]);
        }
        
        if (!$blog_heading) {
            $blog_heading = new SectionHeading([
                'section_key' => 'blog',
                'subtitle' => 'Recent Articles',
                'title' => 'Innovation in Focus Stories',
                'title_span' => 'Updated From Lab'
            ]);
        }
        
        return view('pages.home', compact(
            'sliders', 
            'features', 
            'about', 
            'services', 
            'recent_posts',
            'settings',
            'team_members',
            'portfolios',
            'appointment_settings',
            'portfolio_heading',
            'blog_heading',
            'seo'
        ));

        $team_members = [
            [
                'name' => 'Penny Damion',
                'title' => 'Lab technician',
                'image' => 'images/team/01.jpg',
                'facebook' => '#',
                'twitter' => '#',
                'linkedin' => '#',
            ],
            [
                'name' => 'Christian Barber',
                'title' => 'CEO Of Lab',
                'image' => 'images/team/02.jpg',
                'facebook' => '#',
                'twitter' => '#',
                'linkedin' => '#',
            ],
            [
                'name' => 'Birdette Corvos',
                'title' => 'Research Expert',
                'image' => 'images/team/03.jpg',
                'facebook' => '#',
                'twitter' => '#',
                'linkedin' => '#',
            ],
            [
                'name' => 'Aaliyah Surreal',
                'title' => 'Pathology Special',
                'image' => 'images/team/04.jpg',
                'facebook' => '#',
                'twitter' => '#',
                'linkedin' => '#',
            ],
        ];

        // В методе home добавьте:
        $portfolios = [
            [
                'title' => 'Blood DNA Detect',
                'category' => 'DNA',
                'image' => 'images/portfolio/01.jpg',
            ],
            [
                'title' => 'Laboratory analysis',
                'category' => 'Lab',
                'image' => 'images/portfolio/02.jpg',
            ],
            [
                'title' => 'Genetic testing',
                'category' => 'Test',
                'image' => 'images/portfolio/03.jpg',
            ],
            [
                'title' => 'Chemical testing',
                'category' => 'Chemical',
                'image' => 'images/portfolio/04.jpg',
            ],
            [
                'title' => 'Research results',
                'category' => 'Research',
                'image' => 'images/portfolio/05.jpg',
            ],
            [
                'title' => 'Scientific medicine',
                'category' => 'Medicine',
                'image' => 'images/portfolio/06.jpg',
            ],
        ];

    }
    
    public function about()
    {
        // Get sliders for the page
        $sliders = Slider::where('active', 1)->orderBy('order')->get();
        
        // Get features for features section
        $features = Feature::where('active', 1)->orderBy('order')->limit(3)->get();
        
        // Get about information
        $about = AboutUs::first();
        
        // Get services for services section
        $services = Service::where('active', 1)->orderBy('order')->limit(3)->get();
        
        // Get timeline for history section
        $timeline = Timeline::orderBy('year', 'asc')->get();
        
        // Get team members
        $team_members = TeamMember::where('active', 1)->orderBy('order')->get();
        
        // Get settings
        $settings = Setting::first();
        
        // Get portfolio items
        $portfolios = Portfolio::where('active', 1)->orderBy('order')->get();
        
        // Get recent posts
        $recent_posts = [];
        try {
            $recent_posts = Post::where('active', 1)
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get();
        } catch (\Exception $e) {
            // Table may not exist yet
        }
        
        return view('pages.about', compact(
            'sliders',
            'features',
            'about',
            'services',
            'timeline',
            'recent_posts',
            'settings',
            'team_members',
            'portfolios'
        ));
    }

    public function contact()
    {
        $locations = ContactLocation::where('active', 1)->get();
        $services = Service::where('active', 1)->orderBy('title')->get();
        $settings = Setting::first();
        
        // Get SEO data
        $seo = ContactPageSeo::first();
        
        return view('pages.contact', compact('locations', 'services', 'settings', 'seo'));
    }
}