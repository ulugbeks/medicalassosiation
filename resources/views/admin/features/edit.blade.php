@extends('admin.layouts.app')

@section('title', 'Edit Feature')

@section('page_title', 'Edit Feature')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('features.index') }}">Features</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Feature</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('features.update', $feature->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Translatable fields -->
            <div class="card mb-4">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="language-tabs" role="tablist">
                        @foreach($languages as $index => $language)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $index === 0 ? 'active' : '' }}" 
                                        id="{{ $language->code }}-tab" 
                                        data-bs-toggle="tab" 
                                        data-bs-target="#{{ $language->code }}-content" 
                                        type="button" 
                                        role="tab" 
                                        aria-controls="{{ $language->code }}-content" 
                                        aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                    {{ $language->name }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="language-content">
                        @foreach($languages as $index => $language)
                            <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" 
                                 id="{{ $language->code }}-content" 
                                 role="tabpanel" 
                                 aria-labelledby="{{ $language->code }}-tab">
                                
                                <div class="form-group">
                                    <label for="title-{{ $language->code }}">Title ({{ $language->name }})</label>
                                    <input type="text" 
                                           name="title[{{ $language->code }}]" 
                                           id="title-{{ $language->code }}" 
                                           class="form-control @error('title.'.$language->code) is-invalid @enderror" 
                                           value="{{ old('title.'.$language->code, $feature->getTranslation('title', $language->code, false)) }}" 
                                           {{ $language->is_default ? 'required' : '' }}>
                                    @error('title.'.$language->code)
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group mt-3">
                                    <label for="description-{{ $language->code }}">Description ({{ $language->name }})</label>
                                    <textarea name="description[{{ $language->code }}]" 
                                              id="description-{{ $language->code }}" 
                                              class="form-control @error('description.'.$language->code) is-invalid @enderror" 
                                              rows="3">{{ old('description.'.$language->code, $feature->getTranslation('description', $language->code, false)) }}</textarea>
                                    @error('description.'.$language->code)
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Non-translatable fields -->
            <div class="form-group">
                <label for="icon">Icon Class</label>
                <input type="text" name="icon" id="icon" class="form-control @error('icon') is-invalid @enderror" value="{{ old('icon', $feature->icon) }}" placeholder="flaticon flaticon-chemistry-2">
                @error('icon')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <small class="form-text text-muted">Example: flaticon flaticon-chemistry-2</small>
                @if($feature->icon)
                <div class="mt-2">
                    <i class="{{ $feature->icon }}" style="font-size: 2em;"></i>
                </div>
                @endif
            </div>
            
            <div class="form-group">
                <label for="link_url">Link URL</label>
                <input type="text" name="link_url" id="link_url" class="form-control @error('link_url') is-invalid @enderror" value="{{ old('link_url', $feature->link_url) }}">
                @error('link_url')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="order">Order</label>
                        <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', $feature->order) }}">
                        @error('order')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="active">Status</label>
                        <select name="active" id="active" class="form-control @error('active') is-invalid @enderror">
                            <option value="1" {{ old('active', $feature->active) == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('active', $feature->active) == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('active')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Feature</button>
                <a href="{{ route('features.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Bootstrap tabs
        var triggerTabList = [].slice.call(document.querySelectorAll('#language-tabs button'))
        triggerTabList.forEach(function (triggerEl) {
            var tabTrigger = new bootstrap.Tab(triggerEl)

            triggerEl.addEventListener('click', function (event) {
                event.preventDefault()
                tabTrigger.show()
            })
        })
    });
</script>
@endsection