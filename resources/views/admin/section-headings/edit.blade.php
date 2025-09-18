@extends('admin.layouts.app')

@section('title', 'Edit Section Headings')

@section('page_title', 'Edit Section Headings')

@section('breadcrumb')
<li class="breadcrumb-item active">Section Headings</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Home Page Section Headings</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('section-headings.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Portfolio Section -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title mb-0">Portfolio Section</h4>
                </div>
                <div class="card-body">
                    <!-- Translatable fields for portfolio -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" id="portfolio-language-tabs" role="tablist">
                                @foreach($languages as $index => $language)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $index === 0 ? 'active' : '' }}" 
                                                id="portfolio-{{ $language->code }}-tab" 
                                                data-bs-toggle="tab" 
                                                data-bs-target="#portfolio-{{ $language->code }}-content" 
                                                type="button" 
                                                role="tab" 
                                                aria-controls="portfolio-{{ $language->code }}-content" 
                                                aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                            {{ $language->name }}
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="portfolio-language-content">
                                @foreach($languages as $index => $language)
                                    <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" 
                                         id="portfolio-{{ $language->code }}-content" 
                                         role="tabpanel" 
                                         aria-labelledby="portfolio-{{ $language->code }}-tab">
                                        
                                        <div class="form-group">
                                            <label for="portfolio_subtitle-{{ $language->code }}">Subtitle ({{ $language->name }})</label>
                                            <input type="text" 
                                                   name="portfolio_subtitle[{{ $language->code }}]" 
                                                   id="portfolio_subtitle-{{ $language->code }}" 
                                                   class="form-control @error('portfolio_subtitle.'.$language->code) is-invalid @enderror" 
                                                   value="{{ old('portfolio_subtitle.'.$language->code, $portfolio->getTranslation('subtitle', $language->code, false)) }}" 
                                                   placeholder="e.g. Latest Portfolio">
                                            @error('portfolio_subtitle.'.$language->code)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group mt-3">
                                            <label for="portfolio_title-{{ $language->code }}">Title ({{ $language->name }})</label>
                                            <input type="text" 
                                                   name="portfolio_title[{{ $language->code }}]" 
                                                   id="portfolio_title-{{ $language->code }}" 
                                                   class="form-control @error('portfolio_title.'.$language->code) is-invalid @enderror" 
                                                   value="{{ old('portfolio_title.'.$language->code, $portfolio->getTranslation('title', $language->code, false)) }}" 
                                                   placeholder="e.g. We've Done A Lot's, Check">
                                            @error('portfolio_title.'.$language->code)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group mt-3">
                                            <label for="portfolio_title_span-{{ $language->code }}">Title Span (highlighted part) ({{ $language->name }})</label>
                                            <input type="text" 
                                                   name="portfolio_title_span[{{ $language->code }}]" 
                                                   id="portfolio_title_span-{{ $language->code }}" 
                                                   class="form-control @error('portfolio_title_span.'.$language->code) is-invalid @enderror" 
                                                   value="{{ old('portfolio_title_span.'.$language->code, $portfolio->getTranslation('title_span', $language->code, false)) }}" 
                                                   placeholder="e.g. Our Latest Research">
                                            @error('portfolio_title_span.'.$language->code)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            <small class="form-text text-muted">This part will be highlighted with &lt;span&gt; tags</small>
                                        </div>
                                        
                                        <div class="mt-3">
                                            <div class="card bg-light">
                                                <div class="card-body">
                                                    <h6 class="text-muted">Preview:</h6>
                                                    <h6>{{ $portfolio->getTranslation('subtitle', $language->code, false) }}</h6>
                                                    <h2>{{ $portfolio->getTranslation('title', $language->code, false) }} 
                                                        <span class="text-primary">{{ $portfolio->getTranslation('title_span', $language->code, false) }}</span>
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Blog Section -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h4 class="card-title mb-0">Blog Section</h4>
                </div>
                <div class="card-body">
                    <!-- Translatable fields for blog -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" id="blog-language-tabs" role="tablist">
                                @foreach($languages as $index => $language)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $index === 0 ? 'active' : '' }}" 
                                                id="blog-{{ $language->code }}-tab" 
                                                data-bs-toggle="tab" 
                                                data-bs-target="#blog-{{ $language->code }}-content" 
                                                type="button" 
                                                role="tab" 
                                                aria-controls="blog-{{ $language->code }}-content" 
                                                aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                            {{ $language->name }}
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="blog-language-content">
                                @foreach($languages as $index => $language)
                                    <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" 
                                         id="blog-{{ $language->code }}-content" 
                                         role="tabpanel" 
                                         aria-labelledby="blog-{{ $language->code }}-tab">
                                        
                                        <div class="form-group">
                                            <label for="blog_subtitle-{{ $language->code }}">Subtitle ({{ $language->name }})</label>
                                            <input type="text" 
                                                   name="blog_subtitle[{{ $language->code }}]" 
                                                   id="blog_subtitle-{{ $language->code }}" 
                                                   class="form-control @error('blog_subtitle.'.$language->code) is-invalid @enderror" 
                                                   value="{{ old('blog_subtitle.'.$language->code, $blog->getTranslation('subtitle', $language->code, false)) }}" 
                                                   placeholder="e.g. Recent Articles">
                                            @error('blog_subtitle.'.$language->code)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group mt-3">
                                            <label for="blog_title-{{ $language->code }}">Title ({{ $language->name }})</label>
                                            <input type="text" 
                                                   name="blog_title[{{ $language->code }}]" 
                                                   id="blog_title-{{ $language->code }}" 
                                                   class="form-control @error('blog_title.'.$language->code) is-invalid @enderror" 
                                                   value="{{ old('blog_title.'.$language->code, $blog->getTranslation('title', $language->code, false)) }}" 
                                                   placeholder="e.g. Innovation in Focus Stories">
                                            @error('blog_title.'.$language->code)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group mt-3">
                                            <label for="blog_title_span-{{ $language->code }}">Title Span (highlighted part) ({{ $language->name }})</label>
                                            <input type="text" 
                                                   name="blog_title_span[{{ $language->code }}]" 
                                                   id="blog_title_span-{{ $language->code }}" 
                                                   class="form-control @error('blog_title_span.'.$language->code) is-invalid @enderror" 
                                                   value="{{ old('blog_title_span.'.$language->code, $blog->getTranslation('title_span', $language->code, false)) }}" 
                                                   placeholder="e.g. Updated From Lab">
                                            @error('blog_title_span.'.$language->code)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            <small class="form-text text-muted">This part will be highlighted with &lt;span&gt; tags</small>
                                        </div>
                                        
                                        <div class="mt-3">
                                            <div class="card bg-light">
                                                <div class="card-body">
                                                    <h6 class="text-muted">Preview:</h6>
                                                    <h6>{{ $blog->getTranslation('subtitle', $language->code, false) }}</h6>
                                                    <h2>{{ $blog->getTranslation('title', $language->code, false) }} 
                                                        <span class="text-primary">{{ $blog->getTranslation('title_span', $language->code, false) }}</span>
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
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
        // Activate Bootstrap tabs for Portfolio
        var portfolioTabList = [].slice.call(document.querySelectorAll('#portfolio-language-tabs button'))
        portfolioTabList.forEach(function (triggerEl) {
            var tabTrigger = new bootstrap.Tab(triggerEl)

            triggerEl.addEventListener('click', function (event) {
                event.preventDefault()
                tabTrigger.show()
            })
        });
        
        // Activate Bootstrap tabs for Blog
        var blogTabList = [].slice.call(document.querySelectorAll('#blog-language-tabs button'))
        blogTabList.forEach(function (triggerEl) {
            var tabTrigger = new bootstrap.Tab(triggerEl)

            triggerEl.addEventListener('click', function (event) {
                event.preventDefault()
                tabTrigger.show()
            })
        });
    });
</script>
@endsection