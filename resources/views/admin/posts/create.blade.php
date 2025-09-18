@extends('admin.layouts.app')

@section('title', 'Create Blog Post')

@section('page_title', 'Create Blog Post')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Blog Posts</a></li>
<li class="breadcrumb-item active">Create</li>
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create New Post</h3>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <!-- Tabbed language sections for title, excerpt, and content -->
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
                                            <label for="title-{{ $language->code }}">Post Title ({{ $language->name }})</label>
                                            <input type="text" 
                                                   name="title[{{ $language->code }}]" 
                                                   id="title-{{ $language->code }}" 
                                                   class="form-control @error('title.'.$language->code) is-invalid @enderror" 
                                                   value="{{ old('title.'.$language->code) }}" 
                                                   {{ $language->is_default ? 'required' : '' }}>
                                            @error('title.'.$language->code)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group mt-3">
                                            <label for="excerpt-{{ $language->code }}">Excerpt ({{ $language->name }})</label>
                                            <textarea 
                                                name="excerpt[{{ $language->code }}]" 
                                                id="excerpt-{{ $language->code }}" 
                                                class="form-control @error('excerpt.'.$language->code) is-invalid @enderror" 
                                                rows="3">{{ old('excerpt.'.$language->code) }}</textarea>
                                            @error('excerpt.'.$language->code)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            <small class="text-muted">A short summary of the post (optional)</small>
                                        </div>
                                        
                                        <div class="form-group mt-3">
                                            <label for="content-{{ $language->code }}">Content ({{ $language->name }})</label>
                                            <textarea 
                                                name="content[{{ $language->code }}]" 
                                                id="content-{{ $language->code }}" 
                                                class="summernote form-control @error('content.'.$language->code) is-invalid @enderror" 
                                                rows="10">{{ old('content.'.$language->code) }}</textarea>
                                            @error('content.'.$language->code)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <!-- SEO Fields by language -->
                                        <div class="card mt-4">
                                            <div class="card-header">
                                                <h4>SEO Settings ({{ $language->name }})</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="seo_title-{{ $language->code }}">SEO Title ({{ $language->name }})</label>
                                                    <input type="text" 
                                                           name="seo_title[{{ $language->code }}]" 
                                                           id="seo_title-{{ $language->code }}" 
                                                           class="form-control @error('seo_title.'.$language->code) is-invalid @enderror" 
                                                           value="{{ old('seo_title.'.$language->code) }}">
                                                    @error('seo_title.'.$language->code)
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                    <small class="form-text text-muted">Title used in search engine results (recommended length: 50-60 characters). If left empty, the post title will be used.</small>
                                                    <div id="seo-title-char-count-{{ $language->code }}" class="text-muted mt-1">
                                                        Character count: <span>0</span>/60
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group mt-3">
                                                    <label for="seo_description-{{ $language->code }}">SEO Description ({{ $language->name }})</label>
                                                    <textarea 
                                                        name="seo_description[{{ $language->code }}]" 
                                                        id="seo_description-{{ $language->code }}" 
                                                        class="form-control @error('seo_description.'.$language->code) is-invalid @enderror" 
                                                        rows="3">{{ old('seo_description.'.$language->code) }}</textarea>
                                                    @error('seo_description.'.$language->code)
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                    <small class="form-text text-muted">Description used in search engine results (recommended length: 150-160 characters). If left empty, the post excerpt will be used.</small>
                                                    <div id="seo-description-char-count-{{ $language->code }}" class="text-muted mt-1">
                                                        Character count: <span>0</span>/160
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group mt-3">
                                                    <label for="author_name-{{ $language->code }}">Author Name ({{ $language->name }})</label>
                                                    <input type="text" 
                                                           name="author_name[{{ $language->code }}]" 
                                                           id="author_name-{{ $language->code }}" 
                                                           class="form-control @error('author_name.'.$language->code) is-invalid @enderror" 
                                                           value="{{ old('author_name.'.$language->code) }}">
                                                    @error('author_name.'.$language->code)
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
                </div>
                
                <div class="col-md-4">
                    <div class="form-group" style="display: none;">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->getTranslation('name', app()->getLocale(), false) }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="author_link">Author Link</label>
                        <input type="text" name="author_link" id="author_link" 
                               class="form-control @error('author_link') is-invalid @enderror" 
                               value="{{ old('author_link') }}" placeholder="https://...">
                        @error('author_link')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="text-muted">Optional - add a link to the author's profile</small>
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="featured_image">Featured Image</label>
                        
                        <!-- Current image display (if any) -->
                        <div id="image-preview" class="mb-2"></div>
                        
                        <!-- File upload control -->
                        <div class="input-group">
                            <input type="file" id="image" class="form-control" accept="image/*">
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                        
                        <!-- Hidden input to store the image path -->
                        <input type="hidden" name="featured_image" id="featured_image" 
                               class="form-control mt-2 @error('featured_image') is-invalid @enderror" 
                               value="{{ old('featured_image') }}">
                        
                        @error('featured_image')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="form-text text-muted">Upload an image for your blog post</small>
                    </div>
                    
                    <div class="form-group mt-3">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="active" name="active" value="1" {{ old('active') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="active">Active</label>
                        </div>
                        <small class="text-muted">Enable to publish the post</small>
                    </div>
                    
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-save"></i> Save Post
                        </button>
                        <a href="{{ route('posts.index') }}" class="btn btn-secondary btn-block mt-2">
                            <i class="fas fa-arrow-left"></i> Cancel
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Summernote editor for each language tab
        @foreach($languages as $language)
            $('#content-{{ $language->code }}').summernote({
                height: 400,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ]
            });
        @endforeach
        
        // Handle image upload
        $('#image').on('change', function() {
            var formData = new FormData();
            formData.append('image', this.files[0]);
            
            $.ajax({
                url: '{{ route("image.upload.direct") }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        // Update the hidden input with the image URL
                        $('#featured_image').val(response.url);
                        
                        // Show image preview
                        $('#image-preview').html('<img src="' + response.url + '" alt="Uploaded Image" style="max-height: 150px;">');
                    }
                },
                error: function(error) {
                    console.error('Upload error:', error);
                    alert('Image upload failed. Please try again.');
                }
            });
        });
        
        // Activate Bootstrap tabs
        var triggerTabList = [].slice.call(document.querySelectorAll('#language-tabs button'))
        triggerTabList.forEach(function (triggerEl) {
            var tabTrigger = new bootstrap.Tab(triggerEl)

            triggerEl.addEventListener('click', function (event) {
                event.preventDefault()
                tabTrigger.show()
            })
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // SEO character counters for each language
        @foreach($languages as $language)
            const seoTitle_{{ $language->code }} = document.getElementById('seo_title-{{ $language->code }}');
            const seoDescription_{{ $language->code }} = document.getElementById('seo_description-{{ $language->code }}');
            const titleCharCount_{{ $language->code }} = document.querySelector('#seo-title-char-count-{{ $language->code }} span');
            const descriptionCharCount_{{ $language->code }} = document.querySelector('#seo-description-char-count-{{ $language->code }} span');
            
            if (seoTitle_{{ $language->code }} && titleCharCount_{{ $language->code }}) {
                seoTitle_{{ $language->code }}.addEventListener('input', function() {
                    titleCharCount_{{ $language->code }}.textContent = this.value.length;
                    if (this.value.length > 60) {
                        titleCharCount_{{ $language->code }}.classList.add('text-danger');
                    } else {
                        titleCharCount_{{ $language->code }}.classList.remove('text-danger');
                    }
                });
            }
            
            if (seoDescription_{{ $language->code }} && descriptionCharCount_{{ $language->code }}) {
                seoDescription_{{ $language->code }}.addEventListener('input', function() {
                    descriptionCharCount_{{ $language->code }}.textContent = this.value.length;
                    if (this.value.length > 160) {
                        descriptionCharCount_{{ $language->code }}.classList.add('text-danger');
                    } else {
                        descriptionCharCount_{{ $language->code }}.classList.remove('text-danger');
                    }
                });
            }
        @endforeach
    });
</script>
@endsection