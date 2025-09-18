<!-- admin/team/edit.blade.php -->
@extends('admin.layouts.app')

@section('title', 'Edit Team Member')

@section('page_title', 'Edit Team Member')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('team.index') }}">Team Members</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Team Member</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('team.update', $member->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $member->name) }}" required>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Title/Position</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $member->title) }}" required>
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="image">Image Path</label>
                <input type="text" name="image" id="image" class="form-control @error('image') is-invalid @enderror" value="{{ old('image', $member->image) }}" required>
                @error('image')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <small class="form-text text-muted">Example: images/team/01.jpg</small>
                @if($member->image)
                <div class="mt-2">
                    <img src="{{ asset($member->image) }}" alt="{{ $member->name }}" style="max-width: 200px;">
                </div>
                @endif
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="facebook">Facebook URL</label>
                        <input type="text" name="facebook" id="facebook" class="form-control @error('facebook') is-invalid @enderror" value="{{ old('facebook', $member->facebook) }}">
                        @error('facebook')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="twitter">Twitter URL</label>
                        <input type="text" name="twitter" id="twitter" class="form-control @error('twitter') is-invalid @enderror" value="{{ old('twitter', $member->twitter) }}">
                        @error('twitter')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="linkedin">LinkedIn URL</label>
                        <input type="text" name="linkedin" id="linkedin" class="form-control @error('linkedin') is-invalid @enderror" value="{{ old('linkedin', $member->linkedin) }}">
                        @error('linkedin')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="order">Order</label>
                        <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', $member->order) }}">
                        @error('order')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="active">Status</label>
                        <select name="active" id="active" class="form-control @error('active') is-invalid @enderror">
                            <option value="1" {{ old('active', $member->active) == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('active', $member->active) == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('active')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Team Member</button>
                <a href="{{ route('team.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection