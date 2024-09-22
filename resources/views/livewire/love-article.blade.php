<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="d-flex gap-2 ">
            <button wire:click='handelclick' type="submit" style="background: none; border: none; cursor: pointer;">
                @if($article->likes()->where('user_id', auth()->user()->id)->exists())
                <i class="fa-solid fa-heart fa-2x" style="color: red;"></i>
                @else
                <i class="fa-regular fa-heart fa-2x"></i>
                @endif
            </button>
        <p class="mt-3"> {{$article->likes->count()}}</p>
    </div>
</div>
