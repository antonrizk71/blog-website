<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title')</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/icons/font/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">


</head>



<body>
    @include('sweetalert::alert')




    <div class="main-container d-flex ">
        <div class="sidebar" id="side_nav">
            <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
                <h1 class="fs-4"><span class="bg-white text-dark rounded shadow px-2 me-2"><i
                            class="fa-regular fa-clock  clock "></i></span> <span class="text-white">News24</span></h1>
              
            </div>

            <ul class="list-unstyled px-2">
                <li class="{{Route::is('admins.index') ? 'active' : '' }}"><a href="{{route('admins.index')}}"
                        class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-house"></i> Dashboard</a>
                </li>


                {{-- Category --}}
                <li class="text-decoration-none px-3 py-2 d-block text-primary">Category</li>
                <li class="{{Route::is('category.create') ? 'active' : '' }}"><a href="{{route('category.create')}}"
                        class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                        <span><i class="fa-regular fa-square-plus"></i></i> Add</span>
                    </a>
                </li>
                <li class="{{Route::is('category.index') ? 'active' : '' }}"><a href="{{route('category.index')}}"
                        class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                        <span><i class="fal fa-comment"></i> Categories</span>
                    </a>
                </li>

                {{-- articles --}}
                <li class="text-decoration-none px-3 py-2 d-block text-primary">Articles</li>
                <li class="{{Route::is('articles.create') ? 'active' : '' }}">
                    <a href="{{ route('articles.create') }}"
                        class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                        <span><i class="fa-regular fa-square-plus"></i> Add</span>
                    </a>
                </li>
                <li class="{{Route::is('articles.index') ? 'active' : '' }}">
                    <a href="{{ route('articles.index') }}"
                        class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                        <span>Articles</span>
                    </a>
                </li>
                <li class="{{Route::is('pending') ? 'active' : '' }}">
                    <a href="{{ route('pending') }}"
                        class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                        <span>Pending</span>
                    </a>
                </li>
                <li class="{{Route::is('approved') ? 'active' : '' }}">
                    <a href="{{ route('approved') }}"
                        class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                        <span>Approved</span>
                    </a>
                </li>
                <li class="{{Route::is('rejected') ? 'active' : '' }}">
                    <a href="{{ route('rejected') }}"
                        class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                        <span>Rejected</span>
                    </a>
                </li>
                </li>

                {{-- Admins --}}
                <li class="text-decoration-none px-3 py-2 d-block text-primary">Admins</li>

                @if (Auth::user()->role === 'SuperAdmin')
                <li class="{{Route::is('admins.create') ? 'active' : '' }}">
                    <a href="{{ route('admins.create') }}"
                        class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                        <span><i class="fa-regular fa-square-plus"></i> Add</span>
                    </a>
                </li>
                @endif

                <li class="{{Route::is('admins.showall') ? 'active' : '' }}">
                    <a href="{{ route('admins.showall') }}"
                        class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                        <span>Admins</span>
                    </a>
                </li>

                <li class="{{Route::is('users.showall') ? 'active' : '' }}">
                    <a href="{{ route('users.showall') }}"
                        class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                        <span>Users</span>
                    </a>
                </li>
                <li class="{{Route::is('allusers.showall') ? 'active' : '' }}">
                    <a href="{{ route('allusers.showall') }}"
                        class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                        <span>All Users</span>
                    </a>
                </li>

            </ul>



        </div>
        <div class="content">
            <nav class="navbar navbar-expand-md navbar-light bg-light">
                <div class="container-fluid d-flex justify-content-md-end ">
                    <div class="d-flex justify-content-between d-md-none d-block">
                        <button class="btn  open-btn me-2 "><i class="fa-solid fa-bars"></i></button>
                        
                    </div>

                    <div>
                        <ul class=" list-unstyled  pt-2 ">
                            <li class="nav-item dropdown ">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                    @if(Auth::user()->image)
                                    <img src="{{ asset('upload_images/' . Auth::user()->image) }}" alt="User Image"
                                        class="user_image rounded-circle">
                                    @endif
                            
                                </a>
                                <ul class="dropdown-menu overflow-hidden">
                                    <li><a class="dropdown-item" href="{{route('profile.edit')}}">Profile</a></li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <li><input type="submit" value="logout" class="dropdown-item"></li>
                                    </form>
                                  
                                </ul>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>

            <div class="dashboard-content  px-3  m-md-5">
                <h2 class=" fs-5 text-primary mt-3"> @yield('page_title')</h2>
                {{$slot}}
            </div>
        </div>
    </div>

</body>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/all.min.js') }}"></script>
<script src="{{ asset('assets\js\jsfile.js') }}"></script>




</html>