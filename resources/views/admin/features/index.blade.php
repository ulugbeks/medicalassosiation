@extends('admin.layouts.app')

@section('title', 'Features')

@section('page_title', 'Features')

@section('breadcrumb')
<li class="breadcrumb-item active">Features</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Features</h3>
        <div class="card-tools">
            <a href="{{ route('features.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Feature
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Title</th>
                    <th>Icon</th>
                    <th>Description</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th style="width: 150px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($features as $feature)
                <tr>
                    <td>{{ $feature->id }}</td>
                    <td>{{ $feature->title }}</td>
                    <td><i class="{{ $feature->icon }}"></i> {{ $feature->icon }}</td>
                    <td>{{ Str::limit($feature->description, 50) }}</td>
                    <td>{{ $feature->order }}</td>
                    <td>
                        <span class="badge {{ $feature->active ? 'bg-success' : 'bg-danger' }}">
                            {{ $feature->active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('features.edit', $feature->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('features.destroy', $feature->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection