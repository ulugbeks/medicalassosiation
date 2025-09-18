@extends('admin.layouts.app')

@section('title', 'Edit About Us Page')

@section('page_title', 'Edit About Us Page')

@section('breadcrumb')
<li class="breadcrumb-item active">About Us Page</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit About Us Content</h3>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
         
        <form action="{{ route('aboutus.update') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Language Tabs -->
            <div class="card mb-4">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="languageTabs" role="tablist">
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
                    <div class="tab-content" id="languageContent">
                        @foreach($languages as $index => $language)
                            <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" 
                                 id="{{ $language->code }}-content" 
                                 role="tabpanel" 
                                 aria-labelledby="{{ $language->code }}-tab">
                                
                                <!-- SEO Settings -->
                                <div class="card mb-4">
                                    <div class="card-header bg-success text-white">
                                        <h4 class="card-title mb-0">SEO Settings - {{ $language->name }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="seo_title-{{ $language->code }}">SEO Title ({{ $language->name }})</label>
                                            <input type="text" 
                                                   name="seo_title[{{ $language->code }}]" 
                                                   id="seo_title-{{ $language->code }}" 
                                                   class="form-control @error('seo_title.'.$language->code) is-invalid @enderror" 
                                                   value="{{ old('seo_title.'.$language->code, $about->getTranslation('seo_title', $language->code, false)) }}" 
                                                   placeholder="SEO Title for About Us page">
                                            @error('seo_title.'.$language->code)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            <small class="form-text text-muted">Title used in search engine results (recommended length: 50-60 characters)</small>
                                        </div>
                                        
                                        <div class="form-group mt-3">
                                            <label for="seo_description-{{ $language->code }}">SEO Description ({{ $language->name }})</label>
                                            <textarea name="seo_description[{{ $language->code }}]" 
                                                      id="seo_description-{{ $language->code }}" 
                                                      class="form-control @error('seo_description.'.$language->code) is-invalid @enderror" 
                                                      rows="3" 
                                                      placeholder="SEO Description for About Us page">{{ old('seo_description.'.$language->code, $about->getTranslation('seo_description', $language->code, false)) }}</textarea>
                                            @error('seo_description.'.$language->code)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            <small class="form-text text-muted">Description used in search engine results (recommended length: 150-160 characters)</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Main Section -->
                                <div class="card mb-4">
                                    <div class="card-header bg-primary text-white">
                                        <h4 class="card-title mb-0">Main Section - {{ $language->name }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="subtitle-{{ $language->code }}">Section Subtitle ({{ $language->name }})</label>
                                            <input type="text" 
                                                   name="subtitle[{{ $language->code }}]" 
                                                   id="subtitle-{{ $language->code }}" 
                                                   class="form-control @error('subtitle.'.$language->code) is-invalid @enderror" 
                                                   value="{{ old('subtitle.'.$language->code, $about->getTranslation('subtitle', $language->code, false)) }}" 
                                                   placeholder="e.g. What We Do">
                                            @error('subtitle.'.$language->code)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            <small class="form-text text-muted">This is the smaller text that appears above the main title</small>
                                        </div>
                                        
                                        <div class="form-group mt-3">
                                            <label for="title-{{ $language->code }}">Main Title ({{ $language->name }})</label>
                                            <input type="text" 
                                                   name="title[{{ $language->code }}]" 
                                                   id="title-{{ $language->code }}" 
                                                   class="form-control @error('title.'.$language->code) is-invalid @enderror" 
                                                   value="{{ old('title.'.$language->code, $about->getTranslation('title', $language->code, false)) }}" 
                                                   placeholder="e.g. Strong Values That Bring Great People Together">
                                            @error('title.'.$language->code)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            <small class="form-text text-muted">You can use HTML for styling, e.g. "Strong Values That Bring &lt;span&gt;Great People Together.&lt;/span&gt;"</small>
                                        </div>
                                        
                                        <div class="form-group mt-3">
                                            <label for="description-{{ $language->code }}">Main Description ({{ $language->name }})</label>
                                            <textarea name="description[{{ $language->code }}]" 
                                                      id="description-{{ $language->code }}" 
                                                      class="form-control @error('description.'.$language->code) is-invalid @enderror" 
                                                      rows="6" 
                                                      placeholder="Enter the main section description">{{ old('description.'.$language->code, $about->getTranslation('description', $language->code, false)) }}</textarea>
                                            @error('description.'.$language->code)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Additional Section -->
                                <div class="card mb-4">
                                    <div class="card-header bg-info text-white">
                                        <h4 class="card-title mb-0">Additional Section - {{ $language->name }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="additional_title-{{ $language->code }}">Section Title ({{ $language->name }})</label>
                                            <input type="text" 
                                                   name="additional_title[{{ $language->code }}]" 
                                                   id="additional_title-{{ $language->code }}" 
                                                   class="form-control @error('additional_title.'.$language->code) is-invalid @enderror" 
                                                   value="{{ old('additional_title.'.$language->code, $about->getTranslation('additional_title', $language->code, false)) }}" 
                                                   placeholder="e.g. Our Mission">
                                            @error('additional_title.'.$language->code)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group mt-3">
                                            <label for="additional_description-{{ $language->code }}">Section Description ({{ $language->name }})</label>
                                            <textarea name="additional_description[{{ $language->code }}]" 
                                                      id="additional_description-{{ $language->code }}" 
                                                      class="form-control @error('additional_description.'.$language->code) is-invalid @enderror" 
                                                      rows="6" 
                                                      placeholder="Enter the additional section description">{{ old('additional_description.'.$language->code, $about->getTranslation('additional_description', $language->code, false)) }}</textarea>
                                            @error('additional_description.'.$language->code)
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
            
            <!-- Timeline Section -->
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <h4 class="card-title mb-0">Timeline Section</h4>
                </div>
                <div class="card-body">
                    <p>Timeline items are managed separately. You can add, edit, or remove timeline items from the Timeline Management page.</p>
                    
                    <a href="{{ route('timeline.index') }}" class="btn btn-primary">
                        <i class="fas fa-history"></i> Manage Timeline Items
                    </a>
                    
                    @if(!empty($timelines) && count($timelines) > 0)
                    <div class="mt-4">
                        <h5>Current Timeline Items</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Year</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($timelines as $timeline)
                                    <tr>
                                        <td>{{ $timeline->year }}</td>
                                        <td>{{ $timeline->title }}</td>
                                        <td>{{ Str::limit($timeline->description, 100) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                    <div class="alert alert-info mt-3">
                        No timeline items found. Add some from the Timeline Management page.
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Changes
                </button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Bootstrap tabs
        var triggerTabList = [].slice.call(document.querySelectorAll('#languageTabs button'))
        triggerTabList.forEach(function (triggerEl) {
            var tabTrigger = new bootstrap.Tab(triggerEl)

            triggerEl.addEventListener('click', function (event) {
                event.preventDefault()
                tabTrigger.show()
            })
        })
        
        // Initialize editors for description fields
        @foreach($languages as $language)
            // Initialize editor for description field if needed
            if (document.getElementById('description-{{ $language->code }}')) {
                $('#description-{{ $language->code }}').summernote({
                    height: 300,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture']],
                        ['view', ['fullscreen', 'codeview']]
                    ]
                });
            }
        @endforeach
    });
</script>
@endsection
