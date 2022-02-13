<header class="p-3 bg-dark text-white">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <div class="col-md-6">
      <a href="{{ url('/') }}" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        <img src="{{ url('assets/img/bus-online-ticket.png') }}" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
      </a>
      </div>
      <div class="col-md-6" style="float: right;text-align: right;">
      <!-- <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="#" class="nav-link px-2 text-secondary">Home</a></li>
        <li><a href="#" class="nav-link px-2 text-white">Features</a></li>
        <li><a href="#" class="nav-link px-2 text-white">Pricing</a></li>
        <li><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
        <li><a href="#" class="nav-link px-2 text-white">About</a></li>
      </ul> -->


      @auth
        {{auth()->user()->name}}
        <div class="text-end">
          <a href="{{ route('reservation.show') }}" class="btn btn-outline-light me-2">Reservation</a>
          <a href="{{ route('logout.perform') }}" class="btn btn-outline-light me-2">Dashboard</a>
          <a href="{{ route('logout.perform') }}" class="btn btn-outline-light me-2">Logout</a>
        </div>
      @endauth

      @guest
        <div class="text-end">
          <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Login</a>
          <a href="{{ route('register.perform') }}" class="btn btn-warning">Register</a>
        </div>
      @endguest

      </div>
    </div>
  </div>
</header>