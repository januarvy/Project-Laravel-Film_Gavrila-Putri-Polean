<div class="header">
  <div class="container">
    <div class="w3layouts_logo">
      <a href="{{ route('home') }}"><h1>One<span>Movies</span></h1></a>
    </div>
    <div class="w3_search">
      <form action="{{ route('movies.search') }}" method="get">
        <input type="text" name="q" placeholder="♡. Search ur favo movies!" value="{{ request('q') }}" aria-label="Search ur favorite movies" required>
        <input type="submit" value="Go">
      </form>
    </div>
    <div class="w3l_sign_in_register">
      <ul>
        @auth
          <li><i class="fa fa-user" aria-hidden="true"></i> {{ auth()->user()->name }}</li>
          <li>
            <form action="{{ route('logout') }}" method="post" style="display:inline;">
              @csrf
              <button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; padding:0; font:inherit;">Logout</button>
            </form>
          </li>
        @endauth
        @guest
          <li><a href="#" data-toggle="modal" data-target="#myModal">Login</a></li>
        @endguest
      </ul>
    </div>
    <div class="clearfix"> </div>
  </div>
</div>