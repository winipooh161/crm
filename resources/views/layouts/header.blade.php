@section('header')
    <header>
        <div class="container">
            <nav class="nav__header">
                <div class="logo__block">
                    <a id="logo-link" class="" href="{{ url('/') }}">
                        <img src="../assets/img/logo.svg" alt="" id="logo-img">
                    </a>
                    
                    <div class="burger">
                        <img src="../assets/img/icon/burger.svg" alt="">
                        <input type="checkbox" id="menu-toggle">
                        <label for="menu-toggle"></label>
                    </div>


                </div>
                
                @guest
                <div class="block__nav">
                    @if (Route::has('login'))
                        <li>
                            <a href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
            
                    @if (Route::has('register'))
                        <li>
                            <a href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                </div>
            @else
                <li>
                    <div class="block____user_info">
                        <img src="{{ $authenticatedUser->avatar ? asset($authenticatedUser->avatar) : asset('baseAdmin/stock/ava/avatar.png') }}"
                        alt="Avatar" class="avatar-image">
            
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ $authenticatedUser->name }}
                        </a>
                        <ul class="dropdown">
                            <li>
                                <a href="#" class="dropdown-toggle" id="burger-toggle1">
                                    <svg width="16" height="9" viewBox="0 0 16 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.89453 7.85156C8.89453 7.29928 8.44682 6.85156 7.89453 6.85156C7.34225 6.85156 6.89453 7.29928 6.89453 7.85156L8.89453 7.85156ZM7.18742 8.70466C7.57795 9.09518 8.21111 9.09518 8.60164 8.70466L14.9656 2.34069C15.3561 1.95017 15.3561 1.31701 14.9656 0.926481C14.5751 0.535957 13.9419 0.535957 13.5514 0.926481L7.89453 6.58334L2.23768 0.926481C1.84715 0.535957 1.21399 0.535957 0.823463 0.926482C0.432939 1.31701 0.432939 1.95017 0.823463 2.3407L7.18742 8.70466ZM6.89453 7.85156L6.89453 7.99755L8.89453 7.99755L8.89453 7.85156L6.89453 7.85156Z" fill="#8E9397"/>
                                    </svg>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf 
                                            <button type="submit">Выход</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </li>
            @endguest
            

            </nav>
        </div>
    </header>
   
@endsection
