<!-- admin/contacts/show.blade.php -->
@extends('admin.layouts.app')

@section('title', 'View Message')

@section('page_title', 'View Message')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.contacts') }}">Contact Messages</a></li>
<li class="breadcrumb-item active">View Message</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Message Details</h3>
        <div class="card-tools">
            <form action="{{ route('admin.contacts.mark-as-read', $message->id) }}" method="POST" style="display:inline">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-sm {{ $message->read ? 'btn-secondary' : 'btn-success' }}">
                    {{ $message->read ? 'Mark as Unread' : 'Mark as Read' }}
                </button>
            </form>
            <form action="{{ route('admin.contacts.destroy', $message->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this message?')">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5>Sender Information</h5>
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 150px;">Name</th>
                        <td>{{ $message->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>
                            <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
                        </td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>
                            <a href="tel:{{ $message->phone }}">{{ $message->phone }}</a>
                        </td>
                    </tr>
                    <tr>
                        <th>Date Sent</th>
                        <td>{{ $message->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Service</th>
                        <td>{{ $message->service ? $message->service->title : 'Not specified' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge {{ $message->read ? 'bg-success' : 'bg-warning' }}">
                                {{ $message->read ? 'Read' : 'Unread' }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h5>Message</h5>
                <div class="p-3 bg-light rounded" style="min-height: 200px;">
                    {{ $message->message }}
                </div>
            </div>
        </div>
        
        <div class="mt-4">
            <a href="{{ route('admin.contacts') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Messages
            </a>
            <a href="mailto:{{ $message->email }}" class="btn btn-primary">
                <i class="fas fa-reply"></i> Reply via Email
            </a>
        </div>
    </div>
</div>
@endsection