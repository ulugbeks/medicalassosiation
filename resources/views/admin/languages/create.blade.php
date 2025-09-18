@extends('admin.layouts.app')

@section('title', 'Create Language')

@section('page_title', 'Create Language')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('languages.index') }}">Languages</a></li>
<li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create New Language</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('languages.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="code">Language Code</label>
                <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}" required>
                <small class="form-text text-muted">Use standard language codes like 'en', 'fr', 'es'</small>
                @error('code')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="name">Language Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="active" name="active" value="1" {{ old('active', '1') == '1' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="active">Active</label>
                </div>
            </div>
            
            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="is_default" name="is_default" value="1" {{ old('is_default') == '1' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="is_default">Default Language</label>
                </div>
                <small class="form-text text-muted">If checked, this will become the default language for the site.</small>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Save Language</button>
                <a href="{{ route('languages.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection