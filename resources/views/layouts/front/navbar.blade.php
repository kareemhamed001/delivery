<nav class="navbar navbar-expand-lg  navbar-dark bg-primary p-2  w-100 sticky-top" style="transition: 400ms;z-index: 1000">
    <div class=" container-lg container-xl  d-flex justify-content-between">
        <a class="navbar-brand w-auto col-6 d-flex justify-content-start font-monospace font-size-2 font-weight-4"
           href="{{url('home')}}">
            {{__('homePage.logo')}}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse  navbar-collapse col-6 justify-content-end " id="navbarNavDropdown">
            <ul class="navbar-nav font-size-1 font-weight-3">
                <li class="nav-item">
                    <a class="nav-link " href="{{url('home')}}">{{ __('homePage.Home') }} </a>
                </li>
                <li class="nav-item  ">
                    <a class="nav-link " aria-current="page" href="{{url('order')}}">{{ __('homePage.Make order') }} </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="my_orders">{{ __('homePage.My orders') }} </a>
                </li>
                @if( \Illuminate\Support\Facades\Auth::user())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        {{\Illuminate\Support\Facades\Auth::user()->name}}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('homePage.logout') }}
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </a>
                            </li>
                    </ul>
                </li>
                @endif
                @if(! \Illuminate\Support\Facades\Auth::user())
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-danger " href="{{route('login')}}">{{ __('homePage.login') }}</a>
                    </li>
                @endif

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        {{LaravelLocalization::setLocale() }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li >
                                <a class="dropdown-item " rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>

