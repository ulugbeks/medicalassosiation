@extends('admin.layouts.app')

@section('title', 'Portfolio')

@section('page_title', 'Portfolio')

@section('breadcrumb')
<li class="breadcrumb-item active">Portfolio</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Portfolio Items</h3>
        <div class="card-tools">
            <a href="{{ route('portfolio.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Item
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th style="width: 150px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($portfolios as $portfolio)
                <tr>
                    <td>{{ $portfolio->id }}</td>
                    <td>{{ $portfolio->title }}</td>
                    <td>{{ $portfolio->category }}</td>
                    <td>
                        <img src="{{ asset($portfolio->image) }}" alt="{{ $portfolio->title }}" style="max-width: 100px;">
                    </td>
                    <td>{{ $portfolio->order }}</td>
                    <td>
                        <span class="badge {{ $portfolio->active ? 'bg-success' : 'bg-danger' }}">
                            {{ $portfolio->active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('portfolio.edit', $portfolio->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('portfolio.destroy', $portfolio->id) }}" method="POST" style="display:inline">
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