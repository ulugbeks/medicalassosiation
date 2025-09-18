@extends('admin.layouts.app')

@section('title', 'Site Settings')

@section('page_title', 'Site Settings')

@section('breadcrumb')
<li class="breadcrumb-item active">Site Settings</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">General Site Settings</h3>
    </div>
    <div class="card-body">
        <!-- @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif -->
        
        <form action="{{ route('settings.update') }}" method="POST">
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
                                
                                <!-- Site Info Section -->
                                <h4>Site Information ({{ $language->name }})</h4>
                                
                                <div class="form-group">
                                    <label for="site_name-{{ $language->code }}">Site Name ({{ $language->name }})</label>
                                    <input type="text" 
                                           name="site_name[{{ $language->code }}]" 
                                           id="site_name-{{ $language->code }}" 
                                           class="form-control @error('site_name.'.$language->code) is-invalid @enderror" 
                                           value="{{ old('site_name.'.$language->code, $settings->getTranslation('site_name', $language->code, false)) }}" 
                                           {{ $language->is_default ? 'required' : '' }}>
                                    @error('site_name.'.$language->code)
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group mt-3">
                                    <label for="site_title-{{ $language->code }}">Site Title ({{ $language->name }})</label>
                                    <input type="text" 
                                           name="site_title[{{ $language->code }}]" 
                                           id="site_title-{{ $language->code }}" 
                                           class="form-control @error('site_title.'.$language->code) is-invalid @enderror" 
                                           value="{{ old('site_title.'.$language->code, $settings->getTranslation('site_title', $language->code, false)) }}">
                                    @error('site_title.'.$language->code)
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- SEO Section -->
                                <h4 class="mt-4">SEO Settings ({{ $language->name }})</h4>
                                
                                <div class="form-group">
                                    <label for="meta_title-{{ $language->code }}">Meta Title ({{ $language->name }})</label>
                                    <input type="text" 
                                           name="meta_title[{{ $language->code }}]" 
                                           id="meta_title-{{ $language->code }}" 
                                           class="form-control @error('meta_title.'.$language->code) is-invalid @enderror" 
                                           value="{{ old('meta_title.'.$language->code, $settings->getTranslation('meta_title', $language->code, false)) }}">
                                    @error('meta_title.'.$language->code)
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group mt-3">
                                    <label for="meta_description-{{ $language->code }}">Meta Description ({{ $language->name }})</label>
                                    <textarea name="meta_description[{{ $language->code }}]" 
                                              id="meta_description-{{ $language->code }}" 
                                              class="form-control @error('meta_description.'.$language->code) is-invalid @enderror" 
                                              rows="3">{{ old('meta_description.'.$language->code, $settings->getTranslation('meta_description', $language->code, false)) }}</textarea>
                                    @error('meta_description.'.$language->code)
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group mt-3">
                                    <label for="meta_keywords-{{ $language->code }}">Meta Keywords ({{ $language->name }})</label>
                                    <input type="text" 
                                           name="meta_keywords[{{ $language->code }}]" 
                                           id="meta_keywords-{{ $language->code }}" 
                                           class="form-control @error('meta_keywords.'.$language->code) is-invalid @enderror" 
                                           value="{{ old('meta_keywords.'.$language->code, $settings->getTranslation('meta_keywords', $language->code, false)) }}">
                                    @error('meta_keywords.'.$language->code)
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- Contact Section -->
                                <h4 class="mt-4">Contact Information ({{ $language->name }})</h4>
                                
                                <div class="form-group">
                                    <label for="address-{{ $language->code }}">Address ({{ $language->name }})</label>
                                    <input type="text" 
                                           name="address[{{ $language->code }}]" 
                                           id="address-{{ $language->code }}" 
                                           class="form-control @error('address.'.$language->code) is-invalid @enderror" 
                                           value="{{ old('address.'.$language->code, $settings->getTranslation('address', $language->code, false)) }}">
                                    @error('address.'.$language->code)
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group mt-3">
                                    <label for="working_hours-{{ $language->code }}">Working Hours ({{ $language->name }})</label>
                                    <input type="text" 
                                           name="working_hours[{{ $language->code }}]" 
                                           id="working_hours-{{ $language->code }}" 
                                           class="form-control @error('working_hours.'.$language->code) is-invalid @enderror" 
                                           value="{{ old('working_hours.'.$language->code, $settings->getTranslation('working_hours', $language->code, false)) }}">
                                    @error('working_hours.'.$language->code)
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- Footer Section -->
                                <h4 class="mt-4">Footer Information ({{ $language->name }})</h4>
                                
                                <div class="form-group">
                                    <label for="footer_cta_title-{{ $language->code }}">Footer CTA Title ({{ $language->name }})</label>
                                    <input type="text" 
                                           name="footer_cta_title[{{ $language->code }}]" 
                                           id="footer_cta_title-{{ $language->code }}" 
                                           class="form-control @error('footer_cta_title.'.$language->code) is-invalid @enderror" 
                                           value="{{ old('footer_cta_title.'.$language->code, $settings->getTranslation('footer_cta_title', $language->code, false)) }}">
                                    @error('footer_cta_title.'.$language->code)
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group mt-3">
                                    <label for="newsletter_text-{{ $language->code }}">Newsletter Text ({{ $language->name }})</label>
                                    <textarea name="newsletter_text[{{ $language->code }}]" 
                                              id="newsletter_text-{{ $language->code }}" 
                                              class="form-control @error('newsletter_text.'.$language->code) is-invalid @enderror" 
                                              rows="3">{{ old('newsletter_text.'.$language->code, $settings->getTranslation('newsletter_text', $language->code, false)) }}</textarea>
                                    @error('newsletter_text.'.$language->code)
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Non-translatable fields -->
            <div class="card">
                <div class="card-header">
                    <h4>Site Description (Non-translatable)</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="site_description">Site Description</label>
                        <textarea name="site_description" id="site_description" class="form-control @error('site_description') is-invalid @enderror" rows="3">{{ old('site_description', $settings->site_description) }}</textarea>
                        @error('site_description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="form-text text-muted">This is a non-translatable field. Enter a general description about your site.</small>
                    </div>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header">
                    <h4>Contact Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $settings->email) }}">
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $settings->phone) }}">
                                @error('phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header">
                    <h4>Social Media Links</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="facebook">Facebook</label>
                                <input type="text" name="facebook" id="facebook" class="form-control @error('facebook') is-invalid @enderror" value="{{ old('facebook', $settings->facebook) }}">
                                @error('facebook')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="twitter">Twitter</label>
                                <input type="text" name="twitter" id="twitter" class="form-control @error('twitter') is-invalid @enderror" value="{{ old('twitter', $settings->twitter) }}">
                                @error('twitter')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="linkedin">LinkedIn</label>
                                <input type="text" name="linkedin" id="linkedin" class="form-control @error('linkedin') is-invalid @enderror" value="{{ old('linkedin', $settings->linkedin) }}">
                                @error('linkedin')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="whatsapp">WhatsApp</label>
                                <input type="text" name="whatsapp" id="whatsapp" class="form-control @error('whatsapp') is-invalid @enderror" value="{{ old('whatsapp', $settings->whatsapp) }}">
                                @error('whatsapp')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="form-text text-muted">Enter your WhatsApp number with country code, e.g. +12345678901</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header">
                    <h4>Map Settings</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="map_url">Google Maps Embed URL</label>
                        <input type="text" name="map_url" id="map_url" class="form-control @error('map_url') is-invalid @enderror" value="{{ old('map_url', $settings->map_url) }}">
                        @error('map_url')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="form-text text-muted">
                            Enter the full Google Maps embed URL. You can get this from Google Maps by clicking "Share" and then "Embed a map".
                        </small>
                    </div>
                    
                    @if($settings->map_url)
                    <div class="mt-3" style="display: none;">
                        <label>Current Map Preview:</label>
                        <div class="embed-responsive embed-responsive-16by9" style="height: 300px;">
                            <iframe class="embed-responsive-item" src="{{ $settings->map_url }}" style="border:0; width: 100%; height: 300px;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Save Settings</button>
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