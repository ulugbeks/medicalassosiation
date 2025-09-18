@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Edit Page') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('static-pages.index') }}">{{ __('Static Pages') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Edit') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Edit Page') }}: {{ t($staticPage, 'title', 'en') }}</h3>
                        </div>
                        <form id="static-page-form" action="{{ route('static-pages.update', $staticPage) }}" method="POST" data-ajax="true" data-auto-save="true">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="slug">{{ __('Slug') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $staticPage->slug) }}" required>
                                            <small class="form-text text-muted">{{ __('URL-friendly identifier') }} (e.g., terms-conditions)</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="order">{{ __('Order') }}</label>
                                            <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $staticPage->order) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-check" style="margin-top: 32px;">
                                                <input type="hidden" name="active" value="0">
                                                <input type="checkbox" class="form-check-input" id="active" name="active" value="1" {{ old('active', $staticPage->active) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="active">{{ __('Active') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Language Tabs -->
                                <div class="card">
                                    <div class="card-header p-0 pt-1">
                                        <ul class="nav nav-tabs" id="language-tabs" role="tablist">
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
                                                        <label for="title_{{ $language->code }}">{{ __('Title') }} ({{ $language->name }}) <span class="text-danger">*</span></label>
                                                        <input type="text" 
                                                               class="form-control" 
                                                               id="title_{{ $language->code }}" 
                                                               name="title[{{ $language->code }}]" 
                                                               value="{{ old('title.'.$language->code, t($staticPage, 'title', $language->code)) }}" 
                                                               required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="content_{{ $language->code }}">{{ __('Content') }} ({{ $language->name }}) <span class="text-danger">*</span></label>
                                                        <textarea class="form-control rich-editor" 
                                                                  id="content_{{ $language->code }}" 
                                                                  name="content[{{ $language->code }}]" 
                                                                  rows="15" 
                                                                  required>{{ old('content.'.$language->code, t($staticPage, 'content', $language->code)) }}</textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="seo_title_{{ $language->code }}">{{ __('SEO Title') }} ({{ $language->name }})</label>
                                                        <input type="text" 
                                                               class="form-control" 
                                                               id="seo_title_{{ $language->code }}" 
                                                               name="seo_title[{{ $language->code }}]" 
                                                               value="{{ old('seo_title.'.$language->code, t($staticPage, 'seo_title', $language->code)) }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="seo_description_{{ $language->code }}">{{ __('SEO Description') }} ({{ $language->name }})</label>
                                                        <textarea class="form-control" 
                                                                  id="seo_description_{{ $language->code }}" 
                                                                  name="seo_description[{{ $language->code }}]" 
                                                                  rows="3">{{ old('seo_description.'.$language->code, t($staticPage, 'seo_description', $language->code)) }}</textarea>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success" id="save-btn">
                                    <i class="fas fa-save"></i> <span class="btn-text">{{ __('Save Changes') }}</span>
                                </button>
                                <a href="{{ route('static-pages.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<!-- TinyMCE -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    // Initialize TinyMCE
    tinymce.init({
        selector: '.rich-editor',
        height: 400,
        menubar: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; }',
        branding: false,
        promotion: false,
        setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
        }
    });
</script>
@endpush