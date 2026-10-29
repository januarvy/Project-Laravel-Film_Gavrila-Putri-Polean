<div class="modal video-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        Sign In & Sign Up
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
      </div>
      <section>
        <div class="modal-body">
          @if ($errors->any() || session('success'))
            <div class="alert {{ $errors->any() ? 'alert-danger' : 'alert-success' }}" style="padding:10px 15px; margin-bottom:10px;">
              @if ($errors->any())
                <ul style="margin:0; padding-left:20px;">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              @else
                {{ session('success') }}
              @endif
            </div>
          @endif
          <div class="w3_login_module">
            <div class="module form-module">
              <div class="toggle"><i class="fa fa-times fa-pencil"></i>
              <div class="tooltip">Click Me</div>
              </div>
              <div class="form">
              <h3>Login to your account</h3>
              <form action="{{ route('login') }}" method="post">
                @csrf
                <input type="email" name="email" placeholder="Email Address" required="" value="{{ old('email') }}">
                <input type="password" name="password" placeholder="Password" required="">
                <input type="submit" value="Login">
              </form>
              </div>
              <div class="form">
              <h3>Create an account</h3>
              <form action="{{ route('register') }}" method="post">
                @csrf
                <input type="text" name="name" placeholder="Username" required="" value="{{ old('name') }}">
                <input type="password" name="password" placeholder="Password" required="">
                <input type="email" name="email" placeholder="Email Address" required="" value="{{ old('email') }}">
                <input type="text" name="phone" placeholder="Phone Number" required="" value="{{ old('phone') }}">
                <input type="submit" value="Register">
              </form>
              </div>
              <div class="cta"><a href="#">Forgot your password?</a></div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<script>
  $('.toggle').click(function(){
    // Switches the Icon
    $(this).children('i').toggleClass('fa-pencil');
    // Switches the forms  
    $('.form').animate({
    height: "toggle",
    'padding-top': 'toggle',
    'padding-bottom': 'toggle',
    opacity: "toggle"
    }, "slow");
  });
</script>
