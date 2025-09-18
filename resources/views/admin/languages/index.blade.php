@extends('admin.layouts.app')

@section('title', 'Languages')

@section('page_title', 'Languages')

@section('breadcrumb')
<li class="breadcrumb-item active">Languages</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Languages</h3>
        <div class="card-tools">
            <a href="{{ route('languages.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Language
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Default</th>
                    <th style="width: 150px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($languages as $language)
                <tr>
                    <td>{{ $language->id }}</td>
                    <td>{{ $language->code }}</td>
                    <td>{{ $language->name }}</td>
                    <td>
                        <span class="badge {{ $language->active ? 'bg-success' : 'bg-danger' }}">
                            {{ $language->active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        @if($language->is_default)
                            <span class="badge bg-primary">Default</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('languages.edit', $language->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        @if(!$language->is_default)
                        <form action="{{ route('languages.destroy', $language->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this language?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection