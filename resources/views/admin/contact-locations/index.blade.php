<!-- admin/contact-locations/index.blade.php -->
@extends('admin.layouts.app')

@section('title', 'Contact Locations')

@section('page_title', 'Contact Locations')

@section('breadcrumb')
<li class="breadcrumb-item active">Contact Locations</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Contact Locations</h3>
        <div class="card-tools">
            <a href="{{ route('contact-locations.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Location
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Title</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th style="width: 150px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($locations as $location)
                <tr>
                    <td>{{ $location->id }}</td>
                    <td>{{ $location->title }}</td>
                    <td>{{ $location->address }}</td>
                    <td>{{ $location->email }}</td>
                    <td>{{ $location->phone }}</td>
                    <td>
                        <a href="{{ route('contact-locations.edit', $location->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('contact-locations.destroy', $location->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection