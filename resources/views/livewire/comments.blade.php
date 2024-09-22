<div class="card container mt-5 mb-5  col-lg-4 col-md-10  ">
    <div class="card-body custom-scrollbar overflow-auto " style="height: 10em;">
        @foreach($art->comments as $comment)
        <div class="card m-4">
            <div class=" m-2 d-flex  justify-content-between align-content-center">
                <div class="col-md-8 d-flex align-content-center ">
                    <div>
                        @if($comment->user->image)
                        <img src="{{ asset('upload_images/' . $comment->user->image) }}"
                            class="img-fluid rounded-circle  px-2 user_image  ">
                        @endif
                    </div>
                    <div>
                        <h6 class="card-title"> {{$comment->user->name}}</h6>
                        <div wire:poll.60s>
                            <span class="comment_time" style="font-size: 0.5rem;">
                                @if ($comment->created_at->diffInMinutes() < 1)
                                    just now
                                @else
                                    From {{ $comment->created_at->diffForHumans() }}
                                @endif
                            </span>
                        </div>
                        

                    </div>
                </div>
                <div class="">
                    <div class="d-flex gap-2 align-content-center justify-content-center">
                        @if($comment->user->id==Auth::user()->id)
                        <button wire:click='destroy({{$comment->id}})' type="submit"
                            class=" fa-regular fa-trash-can  text-danger">
                        </button>
                        <button wire:click='update({{$comment->id}})' type="submit"
                            class="fa-regular fa-pen-to-square">
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <p class="card-text w-75 ms-3 "> {{$comment->comment}}</p>
            </div>
        </div>
        @endforeach
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <form wire:submit.prevent="store" method="POST">
                @csrf
                <div class="d-flex gap-2 align-content-center justify-content-center">
                    <button type="submit" style="background: none; border: none; cursor: pointer;">
                        <i class="fa-solid fa-paper-plane fa-2x text-primary"></i>
                    </button>
                    <input type="text" wire:model="comment"  class="form-control w-75" placeholder="Write Your Comment!">
                </div>

            </form>
        </li>
    </ul>
</div>