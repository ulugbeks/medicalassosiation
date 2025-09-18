@extends('admin.layouts.app')

@section('title', 'Edit About Section')

@section('page_title', 'Edit About Section')

@section('breadcrumb')
<li class="breadcrumb-item active">About Section</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit About Section Information</h3>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <form action="{{ route('about.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Translatable fields -->
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
                                
                                <!-- Main Section -->
                                <div class="card mb-4">
                                    <div class="card-header bg-primary text-white">
                                        <h4 class="card-title mb-0">Main Section - {{ $language->name }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="title-{{ $language->code }}">Title ({{ $language->name }})</label>
                                                    <input type="text" 
                                                        name="title[{{ $language->code }}]" 
                                                        id="title-{{ $language->code }}" 
                                                        class="form-control @error('title.'.$language->code) is-invalid @enderror" 
                                                        value="{{ old('title.'.$language->code, $about->getTranslation('title', $language->code, false)) }}">
                                                    @error('title.'.$language->code)
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                    <small class="form-text text-muted">You can use HTML for styling, e.g. &lt;span&gt;text&lt;/span&gt;</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="subtitle-{{ $language->code }}">Subtitle ({{ $language->name }})</label>
                                                    <input type="text" 
                                                        name="subtitle[{{ $language->code }}]" 
                                                        id="subtitle-{{ $language->code }}" 
                                                        class="form-control @error('subtitle.'.$language->code) is-invalid @enderror" 
                                                        value="{{ old('subtitle.'.$language->code, $about->getTranslation('subtitle', $language->code, false)) }}">
                                                    @error('subtitle.'.$language->code)
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group mt-3">
                                            <label for="description-{{ $language->code }}">Description ({{ $language->name }})</label>
                                            <textarea name="description[{{ $language->code }}]" 
                                                    id="description-{{ $language->code }}" 
                                                    class="form-control @error('description.'.$language->code) is-invalid @enderror" 
                                                    rows="4">{{ old('description.'.$language->code, $about->getTranslation('description', $language->code, false)) }}</textarea>
                                            @error('description.'.$language->code)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Doctor Information -->
                                <div class="card mb-4">
                                    <div class="card-header bg-warning text-white">
                                        <h4 class="card-title mb-0">Doctor Information - {{ $language->name }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="doctor_name-{{ $language->code }}">Doctor Name ({{ $language->name }})</label>
                                                    <input type="text" 
                                                        name="doctor_name[{{ $language->code }}]" 
                                                        id="doctor_name-{{ $language->code }}" 
                                                        class="form-control @error('doctor_name.'.$language->code) is-invalid @enderror" 
                                                        value="{{ old('doctor_name.'.$language->code, $about->getTranslation('doctor_name', $language->code, false)) }}">
                                                    @error('doctor_name.'.$language->code)
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="doctor_title-{{ $language->code }}">Doctor Title ({{ $language->name }})</label>
                                                    <input type="text" 
                                                        name="doctor_title[{{ $language->code }}]" 
                                                        id="doctor_title-{{ $language->code }}" 
                                                        class="form-control @error('doctor_title.'.$language->code) is-invalid @enderror" 
                                                        value="{{ old('doctor_title.'.$language->code, $about->getTranslation('doctor_title', $language->code, false)) }}">
                                                    @error('doctor_title.'.$language->code)
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Second Section -->
                                <div class="card mb-4">
                                    <div class="card-header bg-info text-white">
                                        <h4 class="card-title mb-0">Second Section - {{ $language->name }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="second_section_subtitle-{{ $language->code }}">Subtitle ({{ $language->name }})</label>
                                                    <input type="text" 
                                                        name="second_section_subtitle[{{ $language->code }}]" 
                                                        id="second_section_subtitle-{{ $language->code }}" 
                                                        class="form-control @error('second_section_subtitle.'.$language->code) is-invalid @enderror" 
                                                        value="{{ old('second_section_subtitle.'.$language->code, $about->getTranslation('second_section_subtitle', $language->code, false) ?? 'Who We Are') }}">
                                                    @error('second_section_subtitle.'.$language->code)
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="second_section_title-{{ $language->code }}">Title ({{ $language->name }})</label>
                                                    <input type="text" 
                                                        name="second_section_title[{{ $language->code }}]" 
                                                        id="second_section_title-{{ $language->code }}" 
                                                        class="form-control @error('second_section_title.'.$language->code) is-invalid @enderror" 
                                                        value="{{ old('second_section_title.'.$language->code, $about->getTranslation('second_section_title', $language->code, false) ?? 'Discover Our Commitment to <span>Research Center</span>') }}">
                                                    @error('second_section_title.'.$language->code)
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                    <small class="form-text text-muted">You can use HTML for styling, e.g. &lt;span&gt;text&lt;/span&gt;</small>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group mt-3">
                                            <label for="second_section_description-{{ $language->code }}">Description ({{ $language->name }})</label>
                                            <textarea name="second_section_description[{{ $language->code }}]" 
                                                    id="second_section_description-{{ $language->code }}" 
                                                    class="form-control @error('second_section_description.'.$language->code) is-invalid @enderror" 
                                                    rows="3">{{ old('second_section_description.'.$language->code, $about->getTranslation('second_section_description', $language->code, false) ?? 'Delivering cutting-edge scientific services with precise testing, research support, and consultation, committed to excellence and advancement in every project.') }}</textarea>
                                            @error('second_section_description.'.$language->code)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <h4 class="mt-4">First Feature</h4>
                                        <div class="form-group">
                                            <label for="second_section_feature1_title-{{ $language->code }}">Title ({{ $language->name }})</label>
                                            <input type="text" 
                                                name="second_section_feature1_title[{{ $language->code }}]" 
                                                id="second_section_feature1_title-{{ $language->code }}" 
                                                class="form-control @error('second_section_feature1_title.'.$language->code) is-invalid @enderror" 
                                                value="{{ old('second_section_feature1_title.'.$language->code, $about->getTranslation('second_section_feature1_title', $language->code, false) ?? 'Medical laboratory Technician') }}">
                                            @error('second_section_feature1_title.'.$language->code)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="second_section_feature1_description-{{ $language->code }}">Description ({{ $language->name }})</label>
                                            <textarea name="second_section_feature1_description[{{ $language->code }}]" 
                                                    id="second_section_feature1_description-{{ $language->code }}" 
                                                    class="form-control @error('second_section_feature1_description.'.$language->code) is-invalid @enderror" 
                                                    rows="2">{{ old('second_section_feature1_description.'.$language->code, $about->getTranslation('second_section_feature1_description', $language->code, false) ?? 'New evidence has been published on the protein dosing patients.') }}</textarea>
                                            @error('second_section_feature1_description.'.$language->code)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <h4 class="mt-4">Second Feature</h4>
                                        <div class="form-group">
                                            <label for="second_section_feature2_title-{{ $language->code }}">Title ({{ $language->name }})</label>
                                            <input type="text" 
                                                name="second_section_feature2_title[{{ $language->code }}]" 
                                                id="second_section_feature2_title-{{ $language->code }}" 
                                                class="form-control @error('second_section_feature2_title.'.$language->code) is-invalid @enderror" 
                                                value="{{ old('second_section_feature2_title.'.$language->code, $about->getTranslation('second_section_feature2_title', $language->code, false) ?? '10+ Quality Research Center') }}">
                                            @error('second_section_feature2_title.'.$language->code)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="second_section_feature2_description-{{ $language->code }}">Description ({{ $language->name }})</label>
                                            <textarea name="second_section_feature2_description[{{ $language->code }}]" 
                                                    id="second_section_feature2_description-{{ $language->code }}" 
                                                    class="form-control @error('second_section_feature2_description.'.$language->code) is-invalid @enderror" 
                                                    rows="2">{{ old('second_section_feature2_description.'.$language->code, $about->getTranslation('second_section_feature2_description', $language->code, false) ?? 'We believe in fostering collaboration, innovation, and a knowledge.') }}</textarea>
                                            @error('second_section_feature2_description.'.$language->code)
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
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <h4 class="card-title mb-0">Images & Other Settings</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="image1">Image 1 Path</label>
                                <input type="text" name="image1" id="image1" class="form-control @error('image1') is-invalid @enderror" value="{{ old('image1', $about->image1) }}">
                                @error('image1')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">Example: images/about/01.jpg</small>
                                @if($about->image1)
                                    <div class="mt-2">
                                        <img src="{{ asset($about->image1) }}" alt="Image 1" style="max-width: 100px;">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="image2">Image 2 Path</label>
                                <input type="text" name="image2" id="image2" class="form-control @error('image2') is-invalid @enderror" value="{{ old('image2', $about->image2) }}">
                                @error('image2')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">Example: images/about/02.jpg</small>
                                @if($about->image2)
                                    <div class="mt-2">
                                        <img src="{{ asset($about->image2) }}" alt="Image 2" style="max-width: 100px;">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="image3">Image 3 Path</label>
                                <input type="text" name="image3" id="image3" class="form-control @error('image3') is-invalid @enderror" value="{{ old('image3', $about->image3) }}">
                                @error('image3')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">Example: images/about/03.jpg</small>
                                @if($about->image3)
                                    <div class="mt-2">
                                        <img src="{{ asset($about->image3) }}" alt="Image 3" style="max-width: 100px;">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="signature_image">Signature Image Path</label>
                                <input type="text" name="signature_image" id="signature_image" class="form-control @error('signature_image') is-invalid @enderror" value="{{ old('signature_image', $about->signature_image) }}">
                                @error('signature_image')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">Example: images/sign.png</small>
                                @if($about->signature_image)
                                    <div class="mt-2">
                                        <img src="{{ asset($about->signature_image) }}" alt="Signature" style="max-width: 100px;">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="doctor_image">Doctor Image Path</label>
                                <input type="text" name="doctor_image" id="doctor_image" class="form-control @error('doctor_image') is-invalid @enderror" value="{{ old('doctor_image', $about->doctor_image) }}">
                                @error('doctor_image')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">Example: images/about-thumb.jpg</small>
                                @if($about->doctor_image)
                                    <div class="mt-2">
                                        <img src="{{ asset($about->doctor_image) }}" alt="Doctor" style="max-width: 100px;">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="second_section_years">Years of Experience</label>
                        <input type="number" name="second_section_years" id="second_section_years" class="form-control @error('second_section_years') is-invalid @enderror" value="{{ old('second_section_years', $about->second_section_years ?? 15) }}">
                        @error('second_section_years')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Features List -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title mb-0">Features List</h4>
                </div>
                <div class="card-body">
                    @php
                        $features = [];
                        if(isset($about->features)) {
                            $features = is_string($about->features) ? json_decode($about->features) : $about->features;
                            if(!is_array($features)) $features = [];
                        }
                    @endphp
                    
                    <div id="features-container">
                        @foreach($features as $index => $feature)
                        <div class="input-group mb-2">
                            <input type="text" name="features[]" class="form-control" value="{{ $feature }}">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-danger remove-feature">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach
                        
                        @if(count($features) == 0)
                        <div class="input-group mb-2">
                            <input type="text" name="features[]" class="form-control" placeholder="Enter feature">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-danger remove-feature">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    <button type="button" class="btn btn-sm btn-info mt-2" id="add-feature">
                        <i class="fas fa-plus"></i> Add Feature
                    </button>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update About Information
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
        });
        
        // Initialize WYSIWYG editors for description fields
        @foreach($languages as $language)
            // Main description
            if (document.getElementById('description-{{ $language->code }}')) {
                $('#description-{{ $language->code }}').summernote({
                    height: 200,
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
            
            // Second section description
            if (document.getElementById('second_section_description-{{ $language->code }}')) {
                $('#second_section_description-{{ $language->code }}').summernote({
                    height: 150,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['link']],
                        ['view', ['fullscreen', 'codeview']]
                    ]
                });
            }
            
            // Feature descriptions
            if (document.getElementById('second_section_feature1_description-{{ $language->code }}')) {
                $('#second_section_feature1_description-{{ $language->code }}').summernote({
                    height: 100,
                    toolbar: [
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['view', ['fullscreen', 'codeview']]
                    ]
                });
            }
            
            if (document.getElementById('second_section_feature2_description-{{ $language->code }}')) {
                $('#second_section_feature2_description-{{ $language->code }}').summernote({
                    height: 100,
                    toolbar: [
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['view', ['fullscreen', 'codeview']]
                    ]
                });
            }
        @endforeach
        
        // Add feature
        document.getElementById('add-feature').addEventListener('click', function() {
            const container = document.getElementById('features-container');
            const newFeatureDiv = document.createElement('div');
            newFeatureDiv.className = 'input-group mb-2';
            newFeatureDiv.innerHTML = `
                <input type="text" name="features[]" class="form-control" placeholder="Enter feature">
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger remove-feature">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            container.appendChild(newFeatureDiv);
            
            // Add event listener to the new remove button
            newFeatureDiv.querySelector('.remove-feature').addEventListener('click', function() {
                container.removeChild(newFeatureDiv);
            });
        });
        
        // Remove feature (for existing buttons)
        document.querySelectorAll('.remove-feature').forEach(button => {
            button.addEventListener('click', function() {
                const inputGroup = this.closest('.input-group');
                if (inputGroup) {
                    inputGroup.remove();
                }
            });
        });
    });
</script>
@endsection