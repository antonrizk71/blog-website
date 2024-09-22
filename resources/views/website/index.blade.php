@extends('components.layout')

@section('title', 'Welcome Page')
{{-- @section('about')
<li class="nav-item">
    <a class="nav-link" href="#about">About Us</a>
</li>
@endsection --}}
@section('login')
<li class="nav-item">
    <a class="nav-link" aria-current="page" href="{{route('login')}}">Login</a>
</li>
@endsection

@section('register')
<li class="nav-item">
    <a class="nav-link" aria-current="page" href="{{route('register')}}">Register</a>
</li>
@section('Articles')
<section class="  my-5 d-flex  justify-content-center flex-wrap  " id="about">
    <div class="card text-bg-dark">
        <img src="{{asset('assets\images\news_background.jpg')}}" class="card-img" alt="...">
        <div class="card-img-overlay d-flex mt-5 justify-content-center">
           <div class="mt-5 ">
            <h1 class="mt-5">Welcome!</h1>
           </div>
        </div>
    </div>
    <div class=" my-5 w-75">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="mb-4 ">About Us</h2>
                <p class="lead">Welcome to <strong class=" text-primary"> News24</strong>, your trusted source for the latest and most
                    relevant news from around the world.</p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6">
                <h3>Our Vision</h3>
                <p>At <strong class=" text-primary">News24</strong>, we believe that informed citizens are the cornerstone of a strong
                    democracy. We are committed to upholding the highest standards of journalism, ensuring that our
                    reporting is fair, balanced, and fact-based.</p>
            </div>
            <div class="col-md-6">
                <h3>What We Cover</h3>
                <p>We cover a wide range of topics, including
                <ul>
                    @foreach($categories as $category)
                    <li><strong class=" text-primary">{{$category->name}}</strong> </li>
                    @endforeach
                </ul>
                Our team of experienced
                journalists and writers work tirelessly to bring you the stories that impact your life.</p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <h3>Why Choose Us?</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong class=" text-primary">Accuracy:</strong> We pride ourselves on our commitment to
                        factual reporting. Every story is thoroughly researched and verified by our team of editors
                        before it reaches you.</li>
                    <li class="list-group-item"><strong class=" text-primary">Speed:</strong> We understand the importance of staying current.
                        Our newsroom is dedicated to bringing you the latest updates as soon as they happen.</li>
                    <li class="list-group-item"><strong class=" text-primary">Diversity of Perspectives:</strong> We believe in the importance
                        of diverse viewpoints. Our content reflects a wide range of opinions and voices, offering you a
                        well-rounded perspective on the issues.</li>
                    <li class="list-group-item"><strong class=" text-primary">User Experience:</strong> Our website is designed with you in
                        mind. With a clean, easy-to-navigate layout, finding the news you care about is simple and
                        intuitive.</li>
                </ul>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 text-center">
                <h3>Join Our Community</h3>
                <p>We invite you to become a part of our growing community of informed readers. Subscribe to our
                    newsletter, follow us on social media, and engage with our content by sharing your thoughts and
                    opinions. Your voice matters, and we are here to listen.</p>
                <form action="{{route('register')}}" method="get">
                    <button class="btn btn-primary mt-3">Subscribe Now</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
@endsection