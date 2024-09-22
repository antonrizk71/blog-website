<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/icons/font/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('newsicon.ico') }}" type="image/png" sizes="32x32">
</head>



<body class="bg-body-tertiary" >

 @include('sweetalert::alert')
<div class="">
    <nav class="container navbar navbar-expand-lg sticky-top bg-body-tertiary ">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex gap-3 align-items-center ">
                <i class="fa-regular fa-clock fa-2x clock"></i>
                <p class="navbar-brand mb-0">News<span>24</span></p>
            </div>
    
            <button class="navbar-toggler ms-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 mt-1">
                    @if (Auth::user())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    @endif
                   

                    @yield('add_article')
                    @yield('about')
                    @yield('categorynav')
                    @yield('login')
                    @yield('register')
                    @yield('admin')
                    @yield('userprof')
                </ul>
    
                @yield('Search')
            </div>
        </div>
    </nav>
    
    <!-- articles -->

    @yield('Articles')
    
    <div class="d-flex justify-content-center align-items-center  ">
        
            @yield('CreateArticle')
        
    </div>
</div>
    <footer
        class="d-flex  gap-5 flex-wrap justify-content-lg-around justify-content-center px-5  align-items-center py-5   bg-black ">
        <form method="POST" action="{{route('mail.send')}}"  >
            @csrf
            <div class="mb-3 d-flex gap-5">
                <div>
                    <label class="form-label copyright">Name</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div>
                    <label class="form-label copyright">Phone</label>
                    <input type="text" class="form-control" name="phone">
                </div>
                
                
            </div>
            
            <div class="mb-3">
                <label class="form-label copyright">Email</label>
                <input type="email" class="form-control" name="email">
            </div>
            
            <div class="mb-3">
                <label class="form-label copyright">Message</label>
                <textarea name="message" class=" form-control" id="" cols="30" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary form-control">Send</button>
        </form>
        <div class="d-flex flex-column justify-content-center align-content-center mt-5 ">
            <i class="fa-regular fa-clock fa-10x  mb-5 logo"></i>
            <ul class="nav list-unstyled d-flex gap-4 fa-2x ">
                <li><a href="#"><i class="fa-brands fa-twitter twitter"></i></a></li>
                <li><a href="https://www.facebook.com/?locale=ar_AR"><i class="fa-brands fa-facebook facebook"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-facebook-messenger messenger"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-whatsapp whatsapp"></i></a></li>

            </ul>
            <span class="mb-3 mt-4 mb-md-0 copyright">© 2024 News24, Inc</span>
        </div>


    </footer>
</body>
@livewireScripts
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/all.min.js') }}"></script>
<script src="{{ asset('assets/js/jsfile.js') }}"></script>
<script src="js\jsfile.js"></script>


</html>