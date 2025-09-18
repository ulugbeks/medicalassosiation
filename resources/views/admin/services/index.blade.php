<!-- admin/services/index.blade.php -->
@extends('admin.layouts.app')

@section('title', 'Services')

@section('page_title', 'Services')

@section('breadcrumb')
<li class="breadcrumb-item active">Services</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Services</h3>
        <div class="card-tools">
            <a href="{{ route('services.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Service
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
                    <th>Image</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th style="width: 150px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                <tr>
                    <td>{{ $service->id }}</td>
                    <td>{{ $service->title }}</td>
                    <td><i class="{{ $service->icon }}"></i> {{ $service->icon }}</td>
                    <td>
                        <img src="{{ asset($service->image) }}" alt="{{ $service->title }}" style="max-width: 100px;">
                    </td>
                    <td>{{ $service->order }}</td>
                    <td>
                        <span class="badge {{ $service->active ? 'bg-success' : 'bg-danger' }}">
                            {{ $service->active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('services.edit', $service->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline">
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