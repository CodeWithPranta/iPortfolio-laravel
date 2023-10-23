<!-- ======= Mobile nav toggle button ======= -->
<i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

<!-- ======= Header ======= -->
<header id="header">
  <div class="d-flex flex-column">

    <div class="profile">
      <img src="{{$generalInfo ? asset('storage/'. $generalInfo->avatar) : asset('assets/img/profile-img.jpg')}}" alt="" class="img-fluid rounded-circle">
      <h1 class="text-light"><a href="index.html">Alex Smith</a></h1>
      @php
         if ($generalInfo)
         {
            $socialLinks = json_decode($generalInfo->social_links);
            //dd($socialLink);
         }

      @endphp
      <div class="social-links mt-3 text-center">
        @if ($generalInfo)
            @foreach ($socialLinks as $socialLink)
            <a href="{{$socialLink->url}}" class="{{$socialLink->name}}"><i class="bx bxl-{{$socialLink->name}}"></i></a>
            @endforeach
        @endif
      </div>
    </div>

    <nav id="navbar" class="nav-menu navbar overflow-auto">
      <ul>
        <li><a href="#hero" class="nav-link scrollto active"><i class="bx bx-home"></i> <span>Home</span></a></li>
        <li><a href="#about" class="nav-link scrollto"><i class="bx bx-info-circle"></i> <span>About</span></a></li>
        <li><a href="#resume" class="nav-link scrollto"><i class="bx bx-file-blank"></i> <span>Resume</span></a></li>
        <li><a href="#portfolio" class="nav-link scrollto"><i class="bx bx-book-content"></i> <span>Portfolio</span></a></li>
        <li><a href="#services" class="nav-link scrollto"><i class="bx bx-server"></i> <span>Services</span></a></li>
        <li><a href="#contact" class="nav-link scrollto"><i class="bx bx-envelope"></i> <span>Contact</span></a></li>

        @guest
            @if (Route::has('login'))
              <li><a href="{{route('login')}}" class="nav-link scrollto"><i class="bx bx-user"></i> <span>Login</span></a></li>
            @endif
        @else
        <li class="nav-item dropdown">
            <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <i class="bx bx-user-circle"></i>
                <span>{{Auth::user()->name}}</span>
            </a>

            <div class="dropdown-menu bg-dark dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item logout-button" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    <i class="bx bx-log-out-circle"></i>{{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
        @endguest

      </ul>
    </nav><!-- .nav-menu -->
  </div>
</header><!-- End Header -->
