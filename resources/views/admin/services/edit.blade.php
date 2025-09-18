@extends('admin.layouts.app')

@section('title', 'Edit Service')

@section('page_title', 'Edit Service')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('services.index') }}">Services</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Service</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('services.update', $service->id) }}" method="POST">
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
                                           value="{{ old('title.'.$language->code, $service->getTranslation('title', $language->code, false)) }}" 
                                           {{ $language->is_default ? 'required' : '' }}>
                                    @error('title.'.$language->code)
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group mt-3">
                                    <label for="description-{{ $language->code }}">Short Description ({{ $language->name }})</label>
                                    <textarea name="description[{{ $language->code }}]" 
                                              id="description-{{ $language->code }}" 
                                              class="form-control @error('description.'.$language->code) is-invalid @enderror" 
                                              rows="3">{{ old('description.'.$language->code, $service->getTranslation('description', $language->code, false)) }}</textarea>
                                    @error('description.'.$language->code)
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group mt-3">
                                    <label for="content-{{ $language->code }}">Full Content ({{ $language->name }})</label>
                                    <textarea name="content[{{ $language->code }}]" 
                                              id="content-{{ $language->code }}" 
                                              class="form-control content-editor @error('content.'.$language->code) is-invalid @enderror" 
                                              rows="6">{{ old('content.'.$language->code, $service->getTranslation('content', $language->code, false)) }}</textarea>
                                    @error('content.'.$language->code)
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
                <input type="text" name="icon" id="icon" class="form-control @error('icon') is-invalid @enderror" value="{{ old('icon', $service->icon) }}" placeholder="flaticon flaticon-biochemistry">
                @error('icon')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <small class="form-text text-muted">Example: flaticon flaticon-biochemistry</small>
                @if($service->icon)
                <div class="mt-2">
                    <i class="{{ $service->icon }}" style="font-size: 2em;"></i>
                </div>
                @endif
            </div>
            
            <div class="form-group">
                <label for="image">Image Path</label>
                <input type="text" name="image" id="image" class="form-control @error('image') is-invalid @enderror" value="{{ old('image', $service->image) }}" required>
                @error('image')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <small class="form-text text-muted">Example: images/service/01.jpg</small>
                @if($service->image)
                <div class="mt-2">
                    <img src="{{ asset($service->image) }}" alt="{{ $service->title }}" style="max-width: 200px;">
                </div>
                @endif
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="order">Order</label>
                        <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', $service->order) }}">
                        @error('order')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="active">Status</label>
                        <select name="active" id="active" class="form-control @error('active') is-invalid @enderror">
                            <option value="1" {{ old('active', $service->active) == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('active', $service->active) == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('active')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Service</button>
                <a href="{{ route('services.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
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
        
        // Initialize Summernote editors
        $('.content-editor').each(function() {
            $(this).summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'hr']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
        });
    });
</script>
@endsection