
<div class="container-fluid">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div>
        <ul>
            <li><a href="/">HOME</a></li>
            <li><a href="/services">SERVICES</a></li>
            <li><a href="/about">ABOUT US</a></li>
            <li><a href="/posts">BlOG</a></li>
            

            @guest
                <li>
                    <a  href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li >
                        <a  href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif 
            @else   
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                        
                    <li> <a href="/home">Dashboard </a> </li>
                      <li>  <a  href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                       </li>
                       

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                

                 </li>
                </ul>
                 
        @endguest
        </div>
    </div>

