<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="/"><img src="" class="mr-2" alt=""/>{{ env('APP_NAME') }}</a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav navbar-nav-right">
            @guest
            @if (Route::has('login'))
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
            @endif

            @if (Route::has('register'))
              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
            @endif
          @else
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                @if(Auth::user()->usertype == 0) 
                    Manager {{ Auth::user()->name }}
                @endif

                @if(Auth::user()->usertype == 1) 
                     {{ Auth::user()->name }}
                @endif
                        
                @if(Auth::user()->usertype == 2) 
                    Developer {{ Auth::user()->name }}
                @endif
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </div>
            </li>
          @endguest
        </ul>

        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>