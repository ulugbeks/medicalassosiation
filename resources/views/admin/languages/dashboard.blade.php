@extends('admin.layouts.app')

@section('title', 'Translation Dashboard')

@section('page_title', 'Translation Dashboard')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('languages.index') }}">Languages</a></li>
<li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Translation Progress</h3>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="mb-0 mr-3">Overall Progress</h4>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Language</th>
                                <th>Progress</th>
                                <th>Status</th>
                                <th style="width: 150px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($languages as $language)
                                @php
                                    $stats = $translationStats['Total'][$language->code];
                                    $progressClass = $stats['percentage'] == 100 ? 'bg-success' : 
                                                    ($stats['percentage'] >= 70 ? 'bg-info' : 
                                                    ($stats['percentage'] >= 30 ? 'bg-warning' : 'bg-danger'));
                                @endphp
                                <tr>
                                    <td>
                                        <strong>{{ $language->name }}</strong>
                                        @if($language->is_default)
                                            <span class="badge bg-primary">Default</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar {{ $progressClass }}" 
                                                 role="progressbar" 
                                                 style="width: {{ $stats['percentage'] }}%" 
                                                 aria-valuenow="{{ $stats['percentage'] }}" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                                {{ $stats['percentage'] }}%
                                            </div>
                                        </div>
                                        <small>{{ $stats['translated'] }} / {{ $stats['total'] }} fields</small>
                                    </td>
                                    <td>
                                        @if($stats['percentage'] == 100)
                                            <span class="badge bg-success">Complete</span>
                                        @elseif($stats['percentage'] >= 70)
                                            <span class="badge bg-info">Almost Complete</span>
                                        @elseif($stats['percentage'] >= 30)
                                            <span class="badge bg-warning">In Progress</span>
                                        @else
                                            <span class="badge bg-danger">Needs Attention</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(!$language->is_default)
                                            <a href="{{ route('languages.copy-from-default', $language->code) }}" 
                                              class="btn btn-sm btn-info"
                                              onclick="return confirm('This will copy all missing translations from the default language. Continue?')">
                                                <i class="fas fa-copy"></i> Copy Missing
                                            </a>
                                        @else
                                            <span class="text-muted">Default Language</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Section</th>
                        @foreach($languages as $language)
                            <th>
                                {{ $language->name }} 
                                @if($language->is_default)
                                    <span class="badge bg-primary">Default</span>
                                @endif
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($translationStats as $section => $stats)
                        @if($section != 'Total')
                            <tr>
                                <td>{{ $section }}</td>
                                @foreach($languages as $language)
                                    @php
                                        $progressClass = $stats[$language->code]['percentage'] == 100 ? 'bg-success' : 
                                                        ($stats[$language->code]['percentage'] >= 70 ? 'bg-info' : 
                                                        ($stats[$language->code]['percentage'] >= 30 ? 'bg-warning' : 'bg-danger'));
                                    @endphp
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar {{ $progressClass }}" 
                                                 role="progressbar" 
                                                 style="width: {{ $stats[$language->code]['percentage'] }}%" 
                                                 aria-valuenow="{{ $stats[$language->code]['percentage'] }}" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                                {{ $stats[$language->code]['percentage'] }}%
                                            </div>
                                        </div>
                                        <small>{{ $stats[$language->code]['translated'] }} / {{ $stats[$language->code]['total'] }}</small>
                                    </td>
                                @endforeach
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Untranslated Items Quick Access -->
@if(count($languages) > 1)
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Quick Access to Untranslated Items</h3>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($languages as $language)
                    @if(!$language->is_default)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-header bg-secondary text-white">
                                    <h5 class="card-title mb-0">{{ $language->name }}</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        @if(isset($untranslatedCounts[$language->code]['Sliders']) && $untranslatedCounts[$language->code]['Sliders'] > 0)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Sliders
                                                <span class="badge bg-primary rounded-pill">{{ $untranslatedCounts[$language->code]['Sliders'] }}</span>
                                                <a href="{{ route('languages.incomplete', ['model' => 'sliders', 'language' => $language->code]) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                            </li>
                                        @endif
                                        
                                        @if(isset($untranslatedCounts[$language->code]['Posts']) && $untranslatedCounts[$language->code]['Posts'] > 0)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Blog Posts
                                                <span class="badge bg-primary rounded-pill">{{ $untranslatedCounts[$language->code]['Posts'] }}</span>
                                                <a href="{{ route('languages.incomplete', ['model' => 'posts', 'language' => $language->code]) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                            </li>
                                        @endif
                                        
                                        @if(isset($untranslatedCounts[$language->code]['Categories']) && $untranslatedCounts[$language->code]['Categories'] > 0)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Categories
                                                <span class="badge bg-primary rounded-pill">{{ $untranslatedCounts[$language->code]['Categories'] }}</span>
                                                <a href="{{ route('languages.incomplete', ['model' => 'categories', 'language' => $language->code]) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                            </li>
                                        @endif
                                        
                                        @if(isset($untranslatedCounts[$language->code]['Services']) && $untranslatedCounts[$language->code]['Services'] > 0)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Services
                                                <span class="badge bg-primary rounded-pill">{{ $untranslatedCounts[$language->code]['Services'] }}</span>
                                                <a href="{{ route('languages.incomplete', ['model' => 'services', 'language' => $language->code]) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endif
@endsection