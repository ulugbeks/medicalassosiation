@extends('admin.layouts.app')

@section('title', "Incomplete {$modelName} Translations for {$language->name}")

@section('page_title', "Incomplete {$modelName} Translations")

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('languages.index') }}">Languages</a></li>
<li class="breadcrumb-item"><a href="{{ route('languages.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Incomplete {{ $modelName }}</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $modelName }} needing translation for {{ $language->name }}</h3>
        <div class="card-tools">
            <a href="{{ route('languages.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </div>
    <div class="card-body">
        @if(count($items) > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Item</th>
                            <th>Missing Fields</th>
                            <th style="width: 150px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <strong>{{ $item->getTranslation(isset($fields[0]) ? $fields[0] : 'title', $defaultLanguage->code, false) }}</strong>
                                </td>
                                <td>
                                    <ul class="list-unstyled">
                                        @foreach($fields as $field)
                                            @php
                                                $hasTranslation = !empty($item->getTranslation($field, $language->code, false));
                                            @endphp
                                            <li>
                                                <span class="badge {{ $hasTranslation ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $field }}
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <a href="{{ route($routePrefix.'.edit', $item->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> All {{ $modelName }} have been translated for {{ $language->name }}.
            </div>
        @endif
    </div>
</div>
@endsection