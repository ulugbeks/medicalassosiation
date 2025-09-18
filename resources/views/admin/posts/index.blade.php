@extends('admin.layouts.app')

@section('title', 'Blog Posts')

@section('page_title', 'Blog Posts')

@section('breadcrumb')
<li class="breadcrumb-item active">Blog Posts</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Blog Posts</h3>
        <div class="card-tools">
            <a href="{{ route('posts.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Post
            </a>
        </div>
    </div>
    <div class="card-body">
        @if(count($posts) > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th style="width: 150px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category ? $post->category->name : 'None' }}</td>
                        <td>
                            @if($post->featured_image)
                            <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" style="max-width: 100px;">
                            @else
                            No Image
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $post->active ? 'bg-success' : 'bg-danger' }}">
                                {{ $post->active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>{{ $post->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-primary btn-sm" target="_blank">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
        @else
        <div class="alert alert-info">
            No blog posts found. <a href="{{ route('posts.create') }}">Create a new post</a>.
        </div>
        @endif
    </div>
</div>
@endsection