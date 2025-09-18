<!-- admin/contacts/index.blade.php -->
@extends('admin.layouts.app')

@section('title', 'Contact Messages')

@section('page_title', 'Contact Messages')

@section('breadcrumb')
<li class="breadcrumb-item active">Contact Messages</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Messages</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Service</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th style="width: 100px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                <tr class="{{ $message->read ? '' : 'table-warning' }}">
                    <td>{{ $message->id }}</td>
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ $message->phone }}</td>
                    <td>{{ $message->service ? $message->service->title : '-' }}</td>
                    <td>{{ Str::limit($message->message, 50) }}</td>
                    <td>{{ $message->created_at->format('d M Y H:i') }}</td>
                    <td>
                        <span class="badge {{ $message->read ? 'bg-success' : 'bg-warning' }}">
                            {{ $message->read ? 'Read' : 'Unread' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.contacts.show', $message->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <form action="{{ route('admin.contacts.destroy', $message->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this message?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="mt-4">
            {{ $messages->links() }}
        </div>
    </div>
</div>
@endsection