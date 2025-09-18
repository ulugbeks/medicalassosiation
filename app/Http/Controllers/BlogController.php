<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Setting;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::where('active', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(9);
        $categories = Category::withCount('posts')->get();
        $recent_posts = Post::where('active', 1)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        $settings = Setting::first();
            
        return view('blog.index', compact(
            'posts',
            'categories',
            'recent_posts',
            'settings'
        ));
    }
    
    public function show($slug)
    {
        // Find the post by slug
        $post = Post::where('slug', $slug)
            ->where('active', 1)
            ->firstOrFail();
        
        // Get categories with post count
        $categories = Category::withCount('posts')->get();
        
        // Get recent posts (excluding current post)
        $recent_posts = Post::where('active', 1)
            ->where('id', '!=', $post->id)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
        
        // Get settings
        $settings = Setting::first();
        
        // Changed from blog.show to blog.single to match your view file
        return view('blog.single', compact(
            'post',
            'categories',
            'recent_posts',
            'settings'
        ));
    }
    
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = Post::where('active', 1)
            ->where('category_id', $category->id)
            ->orderBy('created_at', 'desc')
            ->paginate(9);
        $categories = Category::withCount('posts')->get();
        $recent_posts = Post::where('active', 1)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        $settings = Setting::first();
            
        return view('blog.category', compact(
            'category',
            'posts',
            'categories',
            'recent_posts',
            'settings'
        ));
    }
}