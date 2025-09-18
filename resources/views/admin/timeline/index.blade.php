@extends('admin.layouts.app')

@section('title', 'Timeline')

@section('page_title', 'Timeline')

@section('breadcrumb')
<li class="breadcrumb-item active">Timeline</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Timeline Items</h3>
        <div class="card-tools">
            <a href="{{ route('timeline.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Item
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Year</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Icon</th>
                    <th style="width: 150px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($timelines as $timeline)
                <tr>
                    <td>{{ $timeline->id }}</td>
                    <td>{{ $timeline->year }}</td>
                    <td>{{ $timeline->title }}</td>
                    <td>{{ Str::limit($timeline->description, 50) }}</td>
                    <td><i class="{{ $timeline->icon }}"></i> {{ $timeline->icon }}</td>
                    <td>
                        <a href="{{ route('timeline.edit', $timeline->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('timeline.destroy', $timeline->id) }}" method="POST" style="display:inline">
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