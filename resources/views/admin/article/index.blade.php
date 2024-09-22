<x-dashboard>
    @section('page_title', 'Articles')


    <div class=" mx-5 d-flex flex-column align-content-center justify-content-around  gap-5 flex-wrap  ">
        <form class=" " role="search" action="{{route('articles.search')}}" method="POST">
            @csrf
            <div>
                <h6>search by</h6>
                <div class="d-md-flex ">
                    {{-- <div class="nav-item dropdown d-flex  gap-2">
                        <input class="form-check-input" type="radio" name="searchby" value="type">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Type
                        </a>
                        <div class="dropdown-menu overflow-hidden" id="dropdownMenu">
                            <input type="submit" class="dropdown-item" name="type" value="pending" />
                            <input type="submit" class="dropdown-item" name="type" value="approved" />
                            <input type="submit" class="dropdown-item" name="type" value="rejected" />
                        </div>
                    </div> --}}

                    <div class="form-check form-check-inline me-5">
                        <input class="form-check-input" type="radio" name="searchby" value="email">
                        <label class="form-check-label" for="inlineRadio1">Email</label>
                    </div>
                    <div class="form-check form-check-inline me-5">
                        <input class="form-check-input" type="radio" name="searchby" value="title" checked>
                        <label class="form-check-label" for="inlineRadio1">Title</label>
                    </div>
                    <div class="form-check form-check-inline me-5">
                        <input class="form-check-input" type="radio" name="searchby" value="date">
                        <label class="form-check-label" for="inlineRadio1">Date</label>
                    </div>
                    <div class="nav-item dropdown d-flex gap-2">
                        <input class="form-check-input" type="radio" name="searchby" value="category">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            category
                        </a>
                        <div class="dropdown-menu overflow-hidden" id="dropdownMenu">
                            @foreach($categories as $category)
                            <input type="submit" class="dropdown-item" name="categoryname"
                                value="{{$category->name}}" />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex mt-3 justify-content-md-between">
                <div class="form-group me-2">
                    <label for="date1">From</label>
                    <input type="date" class="form-control" name="date1" id="date1">
                </div>

                <div class="form-group">
                    <label for="date2">To</label>
                    <input type="date" class="form-control" name="date2" id="date2">
                </div>
            </div>

            <div class="d-flex mt-3">
                <input class="form-control me-2 " type="search" placeholder="Search" aria-label="Search"
                    name="searchterm">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>

        </form>
        @foreach($articles as $article)
        <div class="card mb-3 ">
            <div class=" d-flex ">
                <div class="col-md-4">
                    @if($article->image)
                    <img src="{{ asset('upload_images/' . $article->image) }}" class=" img-fluid rounded-start h-100"
                        alt="admin image">
                    @endif
                </div>

                <div class="card-body">
                    <div class="mt-3 d-flex justify-content-between ">
                        <h5 class="card-title">{{$article->title}}</h5>
                        <div class="d-flex gap-3">
                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; cursor: pointer;">
                                    <i class=" fa-regular fa-trash-can  text-danger "></i>
                                </button>
                            </form>
                            <form action="{{ route('articles.edit', $article->id) }}" method="GET">
                                @csrf
                                <button type="submit" style="background: none; border: none; cursor: pointer;">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                            </form>

                        </div>


                    </div>

                    <p class="card-text">{{$article->content}}</p>
                    <p class="card-text">Type : {{$article->category->name}}</p>
                    <p class="card-text">Likes : {{$article->likes()->count()}}</p>
                    <p class="card-text ">
                        @livewire('article-status', ['articleId' => $article->id])
                    </p>
                    <p class="card-text">Writer : {{$article->admin->name}}</p>
                    <p>
                        {{ \Carbon\Carbon::parse($article->created_at)->format('Y-m-d') }}
                    </p>

                </div>



            </div>
        </div>
        @endforeach
        @if ($articles->count()==0)
        <div class="alert alert-warning mt-5 text-center" role="alert">
            No Articles !
        </div>
        @endif
    </div>
</x-dashboard>