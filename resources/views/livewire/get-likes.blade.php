
<div class="card container col-lg-2 col-md-10 mt-5 mb-5 card-body custom-scrollbar overflow-auto  " wire:poll.1s="get_likes">
    <div style="height: 10em">
{{-- @dd($article); --}}
        @foreach($article->likes as $like)
        <div class="d-flex gap-3 ">

            <div class="col-md-2">
                @if($like->user->image)
                <img src="{{ asset('upload_images/' . $like->user->image) }}"
                    class="img-fluid rounded-circle p-2 user_image">
                @endif
            </div>

            <div class="col-md-8 d-flex mt-2">
                <p class="mb-0">{{$like->user->name}}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
