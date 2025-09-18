@extends('admin.layouts.app')

@section('title', 'Contact Page SEO')

@section('page_title', 'Contact Page SEO')

@section('breadcrumb')
<li class="breadcrumb-item active">Contact Page SEO</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Contact Page SEO Settings</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('contact-page-seo.update') }}" method="POST">
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
                                    <label for="seo_title-{{ $language->code }}">SEO Title ({{ $language->name }})</label>
                                    <input type="text" 
                                           name="seo_title[{{ $language->code }}]" 
                                           id="seo_title-{{ $language->code }}" 
                                           class="form-control @error('seo_title.'.$language->code) is-invalid @enderror" 
                                           value="{{ old('seo_title.'.$language->code, $seo->getTranslation('seo_title', $language->code, false)) }}">
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
                                              rows="3">{{ old('seo_description.'.$language->code, $seo->getTranslation('seo_description', $language->code, false)) }}</textarea>
                                    @error('seo_description.'.$language->code)
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    <small class="form-text text-muted">Description used in search engine results (recommended length: 150-160 characters)</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Save SEO Settings</button>
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
        });
    });
</script>
@endsection