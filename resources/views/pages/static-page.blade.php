@extends('layouts.app')

@section('title', t($page, 'seo_title') ?: t($page, 'title'))

@section('meta')
    <meta name="description" content="{{ t($page, 'seo_description') ?: '' }}">
@endsection

@section('content')
<div class="page-wrapper">
    <!-- Page Banner Start -->
    <section class="page-banner">
        <div class="page-banner-bg" style="background-image: url('{{ asset('images/page-banner-bg.jpg') }}');">
            <div class="page-banner-overlay"></div>
            <div class="container">
                <div class="page-banner-content text-center">
                    <h1 class="page-banner-title">{{ t($page, 'title') }}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ t($page, 'title') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Page Banner End -->

    <!-- Static Page Content Start -->
    <section class="static-page py-120">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="static-page-content">
                        <div class="content-wrapper">
                            {!! clean_html(t($page, 'content')) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Static Page Content End -->
</div>
@endsection

@push('styles')
<style>
.static-page-content {
    background: #ffffff;
    border-radius: 10px;
    padding: 40px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.content-wrapper {
    font-size: 16px;
    line-height: 1.8;
    color: #555;
}

.content-wrapper h1,
.content-wrapper h2,
.content-wrapper h3,
.content-wrapper h4,
.content-wrapper h5,
.content-wrapper h6 {
    color: #2c3e50;
    margin-top: 30px;
    margin-bottom: 15px;
}

.content-wrapper p {
    margin-bottom: 20px;
}

.content-wrapper ul,
.content-wrapper ol {
    margin-bottom: 20px;
    padding-left: 30px;
}

.content-wrapper li {
    margin-bottom: 8px;
}

.content-wrapper blockquote {
    border-left: 4px solid #3498db;
    padding-left: 20px;
    margin: 20px 0;
    font-style: italic;
    background-color: #f8f9fa;
    padding: 15px 20px;
    border-radius: 4px;
}

.content-wrapper a {
    color: #3498db;
    text-decoration: none;
}

.content-wrapper a:hover {
    color: #2980b9;
    text-decoration: underline;
}

.content-wrapper strong,
.content-wrapper b {
    font-weight: 600;
    color: #2c3e50;
}

.content-wrapper em,
.content-wrapper i {
    font-style: italic;
}

.content-wrapper table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}

.content-wrapper table th,
.content-wrapper table td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
}

.content-wrapper table th {
    background-color: #f8f9fa;
    font-weight: 600;
}
</style>
@endpush