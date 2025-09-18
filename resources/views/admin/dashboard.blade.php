@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('page_title', 'Dashboard')

@section('content')
<div class="row">
  <div class="col-lg-3 col-6">
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{ $total_posts }}</h3>
        <p>Blog Posts</p>
      </div>
      <div class="icon">
        <i class="fas fa-blog"></i>
      </div>
      <a href="{{ route('posts.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  
  <div class="col-lg-3 col-6">
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{ $total_services }}</h3>
        <p>Services</p>
      </div>
      <div class="icon">
        <i class="fas fa-cogs"></i>
      </div>
      <a href="{{ route('services.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  
  <div class="col-lg-3 col-6">
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>{{ $total_messages }}</h3>
        <p>Contact Messages</p>
      </div>
      <div class="icon">
        <i class="fas fa-envelope"></i>
      </div>
      <a href="{{ route('admin.contacts') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  
  <div class="col-lg-3 col-6">
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>{{ $unread_messages }}</h3>
        <p>Unread Messages</p>
      </div>
      <div class="icon">
        <i class="fas fa-bell"></i>
      </div>
      <a href="{{ route('admin.contacts') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Latest Messages</h3>
      </div>
      <div class="card-body p-0">
        <table class="table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($latest_messages as $message)
            <tr>
              <td>{{ $message->name }}</td>
              <td>{{ $message->email }}</td>
              <td>{{ $message->created_at->diffForHumans() }}</td>
              <td>
                @if($message->read)
                <span class="badge bg-success">Read</span>
                @else
                <span class="badge bg-warning">Unread</span>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer clearfix">
        <a href="{{ route('admin.contacts') }}" class="btn btn-sm btn-secondary float-right">View All Messages</a>
      </div>
    </div>
  </div>
  
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Latest Blog Posts</h3>
      </div>
      <div class="card-body p-0">
        <table class="table">
          <thead>
            <tr>
              <th>Title</th>
              <th>Category</th>
              <th>Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($latest_posts as $post)
            <tr>
              <td>{{ Str::limit($post->title, 30) }}</td>
              <td>{{ $post->category->name }}</td>
              <td>{{ $post->created_at->diffForHumans() }}</td>
              <td>
                @if($post->active)
                <span class="badge bg-success">Active</span>
                @else
                <span class="badge bg-danger">Inactive</span>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer clearfix">
        <a href="{{ route('posts.index') }}" class="btn btn-sm btn-secondary float-right">View All Posts</a>
      </div>
    </div>
  </div>
</div>
@endsection@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('page_title', 'Dashboard')

@section('content')
<div class="row">
  <div class="col-lg-3 col-6">
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{ $total_posts }}</h3>
        <p>Blog Posts</p>
      </div>
      <div class="icon">
        <i class="fas fa-blog"></i>
      </div>
      <a href="{{ route('posts.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  
  <div class="col-lg-3 col-6">
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{ $total_services }}</h3>
        <p>Services</p>
      </div>
      <div class="icon">
        <i class="fas fa-cogs"></i>
      </div>
      <a href="{{ route('services.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  
  <div class="col-lg-3 col-6">
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>{{ $total_messages }}</h3>
        <p>Contact Messages</p>
      </div>
      <div class="icon">
        <i class="fas fa-envelope"></i>
      </div>
      <a href="{{ route('admin.contacts') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  
  <div class="col-lg-3 col-6">
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>{{ $unread_messages }}</h3>
        <p>Unread Messages</p>
      </div>
      <div class="icon">
        <i class="fas fa-bell"></i>
      </div>
      <a href="{{ route('admin.contacts') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Latest Messages</h3>
      </div>
      <div class="card-body p-0">
        <table class="table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($latest_messages as $message)
            <tr>
              <td>{{ $message->name }}</td>
              <td>{{ $message->email }}</td>
              <td>{{ $message->created_at->diffForHumans() }}</td>
              <td>
                @if($message->read)
                <span class="badge bg-success">Read</span>
                @else
                <span class="badge bg-warning">Unread</span>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer clearfix">
        <a href="{{ route('admin.contacts') }}" class="btn btn-sm btn-secondary float-right">View All Messages</a>
      </div>
    </div>
  </div>
  
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Latest Blog Posts</h3>
      </div>
      <div class="card-body p-0">
        <table class="table">
          <thead>
            <tr>
              <th>Title</th>
              <th>Category</th>
              <th>Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($latest_posts as $post)
            <tr>
              <td>{{ Str::limit($post->title, 30) }}</td>
              <td>{{ $post->category->name }}</td>
              <td>{{ $post->created_at->diffForHumans() }}</td>
              <td>
                @if($post->active)
                <span class="badge bg-success">Active</span>
                @else
                <span class="badge bg-danger">Inactive</span>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer clearfix">
        <a href="{{ route('posts.index') }}" class="btn btn-sm btn-secondary float-right">View All Posts</a>
      </div>
    </div>
  </div>
</div>
@endsection
