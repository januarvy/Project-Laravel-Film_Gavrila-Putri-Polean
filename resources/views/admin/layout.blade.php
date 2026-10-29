<!--
author: W3layouts
Dashboard admin dengan template yang sama seperti sisi publik.
-->
<!DOCTYPE html>
<html lang="en">

@include('templates.component.head')

<body>
<!-- header -->
@include('templates.component.header')
<!-- //header -->
<!-- bootstrap-pop-up -->
@include('templates.component.login')
<!-- //bootstrap-pop-up -->
<!-- nav -->
@include('templates.component.navbar')
<!-- //nav -->
<!-- menu admin -->
<div class="admin_nav">
  <div class="container" style="margin-bottom:20px;">
    <nav class="navbar navbar-inverse" style="margin-bottom:0;">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#admin-menu">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <span class="navbar-brand" style="color:#fff;">Admin Dashboard</span>
      </div>
      <div class="collapse navbar-collapse" id="admin-menu">
        <ul class="nav navbar-nav">
          <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="{{ request()->routeIs('admin.films.*') ? 'active' : '' }}"><a href="{{ route('admin.films.index') }}">Films</a></li>
          <li class="{{ request()->routeIs('admin.genres.*') ? 'active' : '' }}"><a href="{{ route('admin.genres.index') }}">Genres</a></li>
          <li class="{{ request()->routeIs('admin.casts.*') ? 'active' : '' }}"><a href="{{ route('admin.casts.index') }}">Casts</a></li>
          <li class="{{ request()->routeIs('admin.perans.*') ? 'active' : '' }}"><a href="{{ route('admin.perans.index') }}">Roles</a></li>
          <li class="{{ request()->routeIs('admin.kritiks.*') ? 'active' : '' }}"><a href="{{ route('admin.kritiks.index') }}">Reviews</a></li>
          <li class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}"><a href="{{ route('admin.users.index') }}">Users</a></li>
        </ul>
        <form class="navbar-form navbar-right" action="{{ route('logout') }}" method="post">
          @csrf
          <button type="submit" class="btn btn-danger btn-sm">Logout</button>
        </form>
        <p class="navbar-text navbar-right" style="margin-right:10px;">
          <i class="fa fa-user" aria-hidden="true"></i> {{ auth()->user()->name }}
        </p>
      </div>
    </nav>
  </div>
</div>
<!-- //menu admin -->
@if (session('success'))
  <div class="container">
    <div class="alert alert-success">{{ session('success') }}</div>
  </div>
@endif
@if ($errors->any())
  <div class="container">
    <div class="alert alert-danger">
      <ul style="margin:0; padding-left:20px;">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  </div>
@endif
<!-- /w3l-medile-movies-grids -->
<div class="general_movies_grids" style="padding-bottom:30px;">
  <div class="container">
    @yield('content')
  </div>
</div>
<!-- footer -->
@include('templates/component/footer')
<!-- //footer -->
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('template/js/bootstrap.min.js') }}"></script>
<!-- //Bootstrap Core JavaScript -->
</body>
</html>
