@extends('components.layout')
@if ($user->id!=Auth::user()->id)
@section('title', $user->name.' Articles')
@endif
@section('title', 'Your Articles')
@section('add_article')
<li class="nav-item">
    <a class="nav-link" aria-current="page" href="{{route('articles.add')}}">New</a>
</li>
@endsection

@section('categorynav')
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        category
    </a>
    <ul class="dropdown-menu overflow-hidden" id="dropdownMenu">
        @foreach($categories as $category)
        <form action="{{ route('user.category', [$user->id,$category->id]) }}" method="GET">
            <button type="submit" class="dropdown-item">{{$category->name}}</button>
        </form>
        @endforeach
    </ul>
</li>
@endsection
@section('userprof')
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
        <form action="{{ route('user.articles', Auth::user()->id) }}" method="GET">
            <button type="submit" class="dropdown-item">Articles</button>
        </form>
    </ul>
</li>
@endsection

@if(Auth::user()->role==='admin')
@section('admin')
<li class="nav-item">
    <a class="nav-link" aria-current="page" href="{{route('admins.index')}}">Admin</a>
</li>
@endsection
@endif

@section('Search')
<form class="d-flex mt-4" role="search" action="{{route('UserArticle.search')}}" method="POST">
    @csrf
    <input class="form-control me-2 " type="search" placeholder="Search" aria-label="Search" name="search">
    <button class="btn btn-primary" type="submit">Search</button>
</form>
@endsection


@section('Articles')


<section class="container my-5 gap-5 d-flex  justify-content-center flex-wrap ">
    @if ($user->id!=Auth::user()->id)
    <div class="me-md-5 mb-3 card text-center d-flex flex-column justify-content-center align-items-center sticky-profile " style="height: 20em; width: 17em;">
        @if($user->image)
        <img src="{{ asset('upload_images/' . $user->image) }}" alt="User Image"
        class="card-img-top rounded-circle my-3" style="height: 8em; width: 8em;">
        @endif
     
        <ul class="list-group list-group-flush">
          <li class="list-group-item">{{$user->name}}</li>
          <li class="list-group-item">{{$user->email}}</li>
          <li class="list-group-item">{{$user->role}}</li>
          <li class="list-group-item">{{ $user->status == 1 ? 'Active' : 'Blocked' }}</li>
        </ul>
      </div>  
    @endif
    <div class=" ms-md-5 col-lg-4 col-md-6 col-sm-12">
    @foreach($articles as $art)
    <div class="card mb-5">
      
            @if($art->image)
            <img src="{{ asset('upload_images/' . $art->image) }}" class="card-img-top " style="height:12em;" alt="...">
            @endif
            <div class="card-body">
                <div class="mt-3 d-flex justify-content-between ">
                    <h5 class="card-title">{{$art->title}}</h5>
                    <div class="d-flex gap-3">
                        @if($art->admin_id==Auth::user()->id)
                        <form action="{{ route('articles.destroy', $art->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; cursor: pointer;">
                                <i class=" fa-regular fa-trash-can  text-danger "></i>
                            </button>
                        </form>
                        <div>
                            <button type="submit" style="background: none; border: none; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#myModal{{$art->id}}">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                        </div>
                        @endif
                        <div class="modal" id="myModal{{$art->id}}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title text-primary">Update Article</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('articles.update',$art->id)}}" method="POST" enctype="multipart/form-data"
                                        class=" w-75 container  mt-5">
                                        @csrf
                                        @method('put')
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" class="form-control" name="title" value="{{$art->title}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Content</label>
                                            <textarea class="form-control" name="content" id="" cols="30" rows="3"
                                                >{{$art->content}}</textarea>
                                         
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Type</label>
                                            <select class="form-control"  name="type">
                                                @foreach($categories as $category)
                                                <option value="{{$category->id}}" {{$art->type==$category->id? 'selected':''}} >{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                           
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Profile picture</label>
                                            <input type="file" class="form-control" name="image">
                                        </div>
                                        <button type="submit" class="btn btn-primary form-control mb-3 ">Save</button>
                                    </form>
                                
                                </div>
                                {{-- <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>
                                
                                </div> --}}
                              </div>
                            </div>
                          </div>
                    </div>


                </div>

               
                <p class="card-text">{{$art->content}}</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    Status : 
                    <span class="status 
                        @if ($art->status == 'pending') 
                            status-pending 
                        @elseif($art->status == 'approved') 
                            status-approved 
                        @else 
                            status-rejected 
                        @endif">
                        {{ $art->status }}
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center ">
                    <p class="card-text">Type : {{$art->category->name}}</p>
                </li>
            
                {{-- <li class="list-group-item">Created At : {{$art->created_at}}</li> --}}
                <li class="list-group-item px-3 d-flex justify-content-between align-items-center ">
                    <div class="d-flex gap-1">
                        @if($art->admin->image)
                        <img src="{{ asset('upload_images/' . $art->admin->image) }}" alt="User Image"
                            class="user_image rounded-circle">
                        @endif
                        {{$art->admin->name}}
                    </div>
                    <p class="" style="font-size: 0.7rem; margin-top: 1.5em;">
                        {{ \Carbon\Carbon::parse($art->created_at)->format('Y-m-d') }}
                    </p>
                </li>
                {{-- <li class="list-group-item">Writer : {{$art->admin->name}}</li> --}}


                <li class="list-group-item d-flex justify-content-around align-items-center">

                    @livewire('love-article', ['id' => $art->id])
                    <div class="d-flex gap-2 ">
                        <a href="{{ route('articles.show',  $art->id) }}"><i
                                class="fa-regular fa-comment fa-2x mt-2"></i></a>
                        <p class="mt-3">{{$art->comments->count()}}</p>
                    </div>
                </li>




            </ul>
        </div>
        @endforeach
    </div>
        @if ($articles->count()==0)
        <div class="alert alert-warning mt-5" role="alert" style="height:1.5em;">
            No Articles !
        </div>
        @endif


</section>


@endsection