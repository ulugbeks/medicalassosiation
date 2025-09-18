<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Admin Panel') | {{ config('app.name') }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('home') }}" class="nav-link" target="_blank">View Site</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-link nav-link">
            <i class="fas fa-sign-out-alt"></i> Logout
          </button>
        </form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          
          <!-- Home Page Sections Toggle Menu -->
          <li class="nav-item {{ request()->routeIs('sliders.*') || request()->routeIs('features.*') || request()->routeIs('about.edit') || request()->routeIs('services.*') || request()->routeIs('team.*') || request()->routeIs('portfolio.*') || request()->routeIs('appointment.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs('sliders.*') || request()->routeIs('features.*') || request()->routeIs('about.edit') || request()->routeIs('services.*') || request()->routeIs('team.*') || request()->routeIs('portfolio.*') || request()->routeIs('appointment.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home Page
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('home-page-seo.edit') }}" class="nav-link {{ request()->routeIs('home-page-seo.*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SEO Settings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('sliders.index') }}" class="nav-link {{ request()->routeIs('sliders.*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sliders</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{ route('features.index') }}" class="nav-link {{ request()->routeIs('features.*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Features</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{ route('about.edit') }}" class="nav-link {{ request()->routeIs('about.edit') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>About Us Section</p>
                </a>
              </li>
              
              <!-- <li class="nav-item">
                <a href="{{ route('services.index') }}" class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Services</p>
                </a>
              </li> -->
              
              <!-- <li class="nav-item">
                <a href="{{ route('team.index') }}" class="nav-link {{ request()->routeIs('team.*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Team Members</p>
                </a>
              </li> -->
              <li class="nav-item">
                <a href="{{ route('appointment.edit') }}" class="nav-link {{ request()->routeIs('appointment.*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Appointment Form</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{ route('portfolio.index') }}" class="nav-link {{ request()->routeIs('portfolio.*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Portfolio</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('section-headings.edit') }}" class="nav-link {{ request()->routeIs('section-headings.*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Section Headings</p>
                </a>
              </li>
            </ul>
          </li>
          
          <!-- About Us Page Item -->
          <li class="nav-item">
            <a href="{{ route('aboutus.edit') }}" class="nav-link {{ request()->routeIs('aboutus.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-info-circle"></i>
              <p>About Us Page</p>
            </a>
          </li>
          
          <!-- Blog Menu Toggle -->
          <li class="nav-item {{ request()->routeIs('posts.*') || request()->routeIs('categories.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs('posts.*') || request()->routeIs('categories.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-blog"></i>
              <p>
                Blog
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('posts.index') }}" class="nav-link {{ request()->routeIs('posts.*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Posts</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>
            </ul>
          </li>
          
          <!-- Timeline Management (Hidden) -->
          <li class="nav-item" style="display: none;">
            <a href="{{ route('timeline.index') }}" class="nav-link {{ request()->routeIs('timeline.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-history"></i>
              <p>Timeline</p>
            </a>
          </li>
          
          <!-- Contact Menu Toggle -->
          <li class="nav-item {{ request()->routeIs('admin.contacts') || request()->routeIs('contact-locations.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs('admin.contacts') || request()->routeIs('contact-locations.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
                Contact
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('contact-page-seo.edit') }}" class="nav-link {{ request()->routeIs('contact-page-seo.*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SEO Settings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.contacts') }}" class="nav-link {{ request()->routeIs('admin.contacts') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Messages</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('contact-locations.index') }}" class="nav-link {{ request()->routeIs('contact-locations.*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Locations</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Language Management Menu Toggle -->
          <li class="nav-item {{ request()->routeIs('languages.*') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ request()->routeIs('languages.*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-language"></i>
                  <p>
                      Languages
                      <i class="right fas fa-angle-left"></i>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('languages.index') }}" class="nav-link {{ request()->routeIs('languages.index') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Manage Languages</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('languages.dashboard') }}" class="nav-link {{ request()->routeIs('languages.dashboard') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Translation Dashboard</p>
                      </a>
                  </li>
              </ul>
          </li>
          
          <!-- Settings -->
          <li class="nav-item">
            <a href="{{ route('settings.edit') }}" class="nav-link {{ request()->routeIs('settings.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-cog"></i>
              <p>Settings</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@yield('page_title', 'Dashboard')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              @yield('breadcrumb')
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @yield('content')
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; {{ date('Y') }}.</strong>
    All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>
<!-- Custom JS -->
@yield('js')

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#description, #additional_description').summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });
    });
</script>
@endsection
</body>
</html>