@extends('admin.layouts.app')

@section('title', 'Edit Contact Location')

@section('page_title', 'Edit Contact Location')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('contact-locations.index') }}">Contact Locations</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Contact Location</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('contact-locations.update', $contactLocation->id) }}" method="POST">
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
                                    <label for="title-{{ $language->code }}">{{ __('Title') }} ({{ $language->name }})</label>
                                    <input type="text" 
                                           name="title[{{ $language->code }}]" 
                                           id="title-{{ $language->code }}" 
                                           class="form-control @error('title.'.$language->code) is-invalid @enderror" 
                                           value="{{ old('title.'.$language->code, $contactLocation->getTranslation('title', $language->code, false)) }}" 
                                           {{ $language->is_default ? 'required' : '' }}>
                                    @error('title.'.$language->code)
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group mt-3">
                                    <label for="address-{{ $language->code }}">{{ __('Address') }} ({{ $language->name }})</label>
                                    <input type="text" 
                                           name="address[{{ $language->code }}]" 
                                           id="address-{{ $language->code }}" 
                                           class="form-control @error('address.'.$language->code) is-invalid @enderror" 
                                           value="{{ old('address.'.$language->code, $contactLocation->getTranslation('address', $language->code, false)) }}" 
                                           {{ $language->is_default ? 'required' : '' }}>
                                    @error('address.'.$language->code)
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
                <label for="email">{{ __('Email') }}</label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $contactLocation->email) }}" required>
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group mt-3">
                <label for="phone">{{ __('Phone') }}</label>
                <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $contactLocation->phone) }}" required>
                @error('phone')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">{{ __('Update Location') }}</button>
                <a href="{{ route('contact-locations.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
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