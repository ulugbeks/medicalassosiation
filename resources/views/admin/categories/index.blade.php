@extends('admin.layouts.app')

@section('title', 'Blog Categories')

@section('page_title', 'Blog Categories')

@section('breadcrumb')
<li class="breadcrumb-item active">Blog Categories</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Categories</h3>
        <div class="card-tools">
            <a href="{{ route('categories.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Category
            </a>
        </div>
    </div>
    <div class="card-body">
        @if(count($categories) > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Posts</th>
                        <th>Description</th>
                        <th style="width: 150px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->posts_count }}</td>
                        <td>{{ Str::limit($category->description, 50) }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if($category->posts_count == 0)
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @else
                            <button class="btn btn-danger btn-sm" disabled title="Cannot delete category with posts">
                                <i class="fas fa-trash"></i>
                            </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $categories->links() }}
        </div>
        @else
        <div class="alert alert-info">
            No categories found. <a href="{{ route('categories.create') }}">Create a new category</a>.
        </div>
        @endif
    </div>
</div>
@endsection