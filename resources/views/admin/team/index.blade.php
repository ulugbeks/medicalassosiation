<!-- admin/team/index.blade.php -->
@extends('admin.layouts.app')

@section('title', 'Team Members')

@section('page_title', 'Team Members')

@section('breadcrumb')
<li class="breadcrumb-item active">Team Members</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Team Members</h3>
        <div class="card-tools">
            <a href="{{ route('team.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Member
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th style="width: 150px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($members as $member)
                <tr>
                    <td>{{ $member->id }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->title }}</td>
                    <td>
                        <img src="{{ asset($member->image) }}" alt="{{ $member->name }}" style="max-width: 100px;">
                    </td>
                    <td>{{ $member->order }}</td>
                    <td>
                        <span class="badge {{ $member->active ? 'bg-success' : 'bg-danger' }}">
                            {{ $member->active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('team.edit', $member->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('team.destroy', $member->id) }}" method="POST" style="display:inline">
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