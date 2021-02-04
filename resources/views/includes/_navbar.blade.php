
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                
                    
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('announcements.create') }}">
                    {{ __('ui.create_announcement') }}
                    </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.home') }}">Admin Home</a>
                    </li>

                    <li class="nav-item dropdown">
                    
                        <a id="categoriesDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-prev> Categorie <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="categoriesDropdown">
                        @foreach($categories as $category)
                            <a class="nav-link" href="{{ route('home.announcements.category', 
                                [
                                    $category->name,
                                    $category->id
                                ]) }}">{{ $category->name }}</a>
                                @endforeach
                        </div>
                    </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item">
                            @include('includes._locale', [ 'lang' => 'en', 'nation' => 'gb'])
                        </li>

                        <li class="nav-item">
                            @include('includes._locale', [ 'lang' => 'it', 'nation' => 'it'])
                        </li>

                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('users.profile', (Auth::id()) ) }}">
                                        {{ __('Profile') }}
                                    </a>
                                    @if (Auth::user()->is_admin)
                                            <a class="nav-link" href="{{ route('admin.home') }}">Admin Home <span class="badge badge-pill badge-warning">
                                            {{ \App\Announcement::toBeRevisionedCount() }}</span>
                                            <a>
                                            <a class="nav-link" href="{{ route('admin.rejected') }}">Rejected Announcement<span class="badge badge-pill badge-warning">
                                            {{ \App\Announcement::RejectedCount() }}</span>
                                            <a>
                                    @endif

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>