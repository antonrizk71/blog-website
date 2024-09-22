@extends('components.layout')

@section('title', 'Read More')


@section('Articles')
<section class="container  d-lg-flex align-content-center justify-content-center flex-wrap gap-5">


    <div class="card   my-5  col-lg-4 col-md-10 ">
        @if($art->image)
        <img src="{{ asset('upload_images/' . $art->image) }}" class="card-img-top" alt="...">
        @endif
        <div class="card-body">
            <h5 class="card-title">{{$art->title}}</h5>
            <p class="card-text">{{$art->content}}</p>
        </div>
        <ul class="list-group list-group-flush">
            {{-- <li class="list-group-item">Created At : {{$art->created_at}}</li> --}}
            <li class="list-group-item d-flex justify-content-between align-items-center ">
                <div class="d-flex gap-1">
                    @if($art->admin->image)
                    <img src="{{ asset('upload_images/' . $art->admin->image) }}" alt="User Image"
                        class="user_image rounded-circle">
                    @endif
                    <a class="text-decoration-none"
                        href="{{route('user.articles',$art->admin->id)}}">{{$art->admin->name}}</a>
                </div>
                <p class="" style="font-size: 0.7rem; margin-top: 1.5em;">
                    {{ \Carbon\Carbon::parse($art->created_at)->format('Y-m-d') }}
                </p>
            </li>
            <li class="list-group-item">Writer : {{$art->admin->name}}</li>
            <li class="list-group-item d-flex justify-content-around align-items-center">

                @livewire('love-article', ['id' => $art->id])
                <div class="d-flex gap-2 ">
                    <a href="{{ route('articles.show',  $art->id) }}"><i class="fa-regular fa-comment fa-2x "></i></a>
                    <p class="mt-1">{{$art->comments->count()}}</p>
                </div>
            </li>
        </ul>
    </div>

    @livewire('comments',['art'=>$art])
    @livewire('get-likes',['id' => $art->id])
</section>

@endsection