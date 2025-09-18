@extends('admin.layouts.app')

@section('title', 'Appointment Form Settings')

@section('page_title', 'Appointment Form Settings')

@section('breadcrumb')
<li class="breadcrumb-item active">Appointment Form Settings</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Appointment Form Settings</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('appointment.update') }}" method="POST">
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
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title-{{ $language->code }}">Title ({{ $language->name }})</label>
                                            <input type="text" 
                                                   name="title[{{ $language->code }}]" 
                                                   id="title-{{ $language->code }}" 
                                                   class="form-control @error('title.'.$language->code) is-invalid @enderror" 
                                                   value="{{ old('title.'.$language->code, $settings->getTranslation('title', $language->code, false)) }}">
                                            @error('title.'.$language->code)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="subtitle-{{ $language->code }}">Subtitle ({{ $language->name }})</label>
                                            <input type="text" 
                                                   name="subtitle[{{ $language->code }}]" 
                                                   id="subtitle-{{ $language->code }}" 
                                                   class="form-control @error('subtitle.'.$language->code) is-invalid @enderror" 
                                                   value="{{ old('subtitle.'.$language->code, $settings->getTranslation('subtitle', $language->code, false)) }}">
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
                                              rows="3">{{ old('description.'.$language->code, $settings->getTranslation('description', $language->code, false)) }}</textarea>
                                    @error('description.'.$language->code)
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group mt-3">
                                    <label for="button_text-{{ $language->code }}">Button Text ({{ $language->name }})</label>
                                    <input type="text" 
                                           name="button_text[{{ $language->code }}]" 
                                           id="button_text-{{ $language->code }}" 
                                           class="form-control @error('button_text.'.$language->code) is-invalid @enderror" 
                                           value="{{ old('button_text.'.$language->code, $settings->getTranslation('button_text', $language->code, false)) }}">
                                    @error('button_text.'.$language->code)
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Non-translatable fields -->
            <h4 class="mt-4 mb-3">Working Hours</h4>
            
            <div id="working-hours-container">
                @php
                    $working_hours = $settings->working_hours ?? [
                        'Mon - Tues' => '09:00AM - 6:00PM',
                        'Wed - Thu' => '09:00AM - 6:00PM',
                        'Fri - Sat' => '09:00AM - 6:00PM',
                        'Emergency' => '24/7 Hours 7 Days'
                    ];
                @endphp
                
                @foreach($working_hours as $day => $hours)
                <div class="row mb-2 working-hour-item">
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="text" name="working_hours[days][]" class="form-control" value="{{ $day }}" placeholder="Day(s)">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="text" name="working_hours[hours][]" class="form-control" value="{{ $hours }}" placeholder="Hours">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger remove-hours"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                @endforeach
            </div>
            
            <button type="button" class="btn btn-info mb-4" id="add-working-hours">
                <i class="fas fa-plus"></i> Add Working Hours
            </button>
            
            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="active" name="active" value="1" {{ $settings->active ? 'checked' : '' }}>
                    <label class="custom-control-label" for="active">Active</label>
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
        
        // Add working hours
        document.getElementById('add-working-hours').addEventListener('click', function() {
            const container = document.getElementById('working-hours-container');
            const newHoursRow = document.createElement('div');
            newHoursRow.className = 'row mb-2 working-hour-item';
            newHoursRow.innerHTML = `
                <div class="col-md-5">
                    <div class="form-group">
                        <input type="text" name="working_hours[days][]" class="form-control" placeholder="Day(s)">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <input type="text" name="working_hours[hours][]" class="form-control" placeholder="Hours">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger remove-hours"><i class="fas fa-times"></i></button>
                </div>
            `;
            container.appendChild(newHoursRow);
            
            // Add event listener to new remove button
            newHoursRow.querySelector('.remove-hours').addEventListener('click', function() {
                container.removeChild(newHoursRow);
            });
        });
        
        // Remove working hours (for existing buttons)
        document.querySelectorAll('.remove-hours').forEach(button => {
            button.addEventListener('click', function() {
                const hourItem = this.closest('.working-hour-item');
                if (hourItem) {
                    hourItem.remove();
                }
            });
        });
    });
</script>
@endsection