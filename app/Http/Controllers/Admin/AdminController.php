<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Contact;
use App\Models\Slider;
use App\Models\Service;

class AdminController extends Controller
{
    public function index()
    {
        // Счетчики для дашборда
        $total_posts = Post::count();
        $total_messages = Contact::count();
        $unread_messages = Contact::where('read', false)->count();
        $total_sliders = Slider::count();
        $total_services = Service::count();
        
        // Последние сообщения
        $latest_messages = Contact::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        // Последние посты для блога (если таблица существует)
        $latest_posts = [];
        try {
            $latest_posts = Post::orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        } catch (\Exception $e) {
            // Таблица постов может не существовать еще
        }

        // Add languages data
        $languages = \App\Models\Language::where('active', true)->get();
        
        return view('admin.dashboard', compact(
            'total_posts',
            'total_messages',
            'unread_messages',
            'total_sliders',
            'total_services',
            'latest_messages',
            'latest_posts',
            'languages'
        ));
    }
}