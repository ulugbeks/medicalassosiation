@extends('admin.layouts.app')

@section('title', 'Edit Slider')

@section('page_title', 'Edit Slider')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('sliders.index') }}">Sliders</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Slider</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('sliders.update', $slider->id) }}" method="POST">
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
                                           value="{{ old('title.'.$language->code, $slider->getTranslation('title', $language->code, false)) }}" 
                                           {{ $language->is_default ? 'required' : '' }}>
                                    @error('title.'.$language->code)
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group mt-3">
                                    <label for="subtitle-{{ $language->code }}">Subtitle ({{ $language->name }})</label>
                                    <input type="text" 
                                           name="subtitle[{{ $language->code }}]" 
                                           id="subtitle-{{ $language->code }}" 
                                           class="form-control @error('subtitle.'.$language->code) is-invalid @enderror" 
                                           value="{{ old('subtitle.'.$language->code, $slider->getTranslation('subtitle', $language->code, false)) }}">
                                    @error('subtitle.'.$language->code)
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group mt-3">
                                    <label for="description-{{ $language->code }}">Description ({{ $language->name }})</label>
                                    <textarea name="description[{{ $language->code }}]" 
                                              id="description-{{ $language->code }}" 
                                              class="form-control @error('description.'.$language->code) is-invalid @enderror" 
                                              rows="3">{{ old('description.'.$language->code, $slider->getTranslation('description', $language->code, false)) }}</textarea>
                                    @error('description.'.$language->code)
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="primary_button_text-{{ $language->code }}">Primary Button Text ({{ $language->name }})</label>
                                            <input type="text" 
                                                   name="primary_button_text[{{ $language->code }}]" 
                                                   id="primary_button_text-{{ $language->code }}" 
                                                   class="form-control @error('primary_button_text.'.$language->code) is-invalid @enderror" 
                                                   value="{{ old('primary_button_text.'.$language->code, $slider->getTranslation('primary_button_text', $language->code, false)) }}">
                                            @error('primary_button_text.'.$language->code)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="secondary_button_text-{{ $language->code }}">Secondary Button Text ({{ $language->name }})</label>
                                            <input type="text" 
                                                   name="secondary_button_text[{{ $language->code }}]" 
                                                   id="secondary_button_text-{{ $language->code }}" 
                                                   class="form-control @error('secondary_button_text.'.$language->code) is-invalid @enderror" 
                                                   value="{{ old('secondary_button_text.'.$language->code, $slider->getTranslation('secondary_button_text', $language->code, false)) }}">
                                            @error('secondary_button_text.'.$language->code)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Non-translatable fields -->
            <div class="form-group">
                <label for="image_path">Image Path</label>
                <input type="text" name="image_path" id="image_path" class="form-control @error('image_path') is-invalid @enderror" value="{{ old('image_path', $slider->image_path) }}" required>
                @error('image_path')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <small class="form-text text-muted">Example: images/banner/01.jpg</small>
                
                @if($slider->image_path)
                <div class="mt-2">
                    <img src="{{ asset($slider->image_path) }}" alt="{{ $slider->getTranslation('title', app()->getLocale()) }}" style="max-width: 200px;">
                </div>
                @endif
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="primary_button_url">Primary Button URL</label>
                        <input type="text" name="primary_button_url" id="primary_button_url" class="form-control @error('primary_button_url') is-invalid @enderror" value="{{ old('primary_button_url', $slider->primary_button_url) }}">
                        @error('primary_button_url')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="secondary_button_url">Secondary Button URL</label>
                        <input type="text" name="secondary_button_url" id="secondary_button_url" class="form-control @error('secondary_button_url') is-invalid @enderror" value="{{ old('secondary_button_url', $slider->secondary_button_url) }}">
                        @error('secondary_button_url')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="order">Order</label>
                        <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', $slider->order) }}">
                        @error('order')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="active">Status</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="active" name="active" value="1" {{ old('active', $slider->active) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="active">Active</label>
                        </div>
                        @error('active')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Slider</button>
                <a href="{{ route('sliders.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Activate Bootstrap tabs
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