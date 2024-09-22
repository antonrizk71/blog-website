<div class="d-flex justify-content-between ">
    @if ($status== 'pending')
    <span class="status-pending ">{{$status}}</span>
    @elseif($status== 'approved')
    <span class="status-approved ">{{$status}}</span>
    @else
    <span class="status-rejected">{{$status}}</span>
    @endif

    <div class="d-flex gap-2">
        <button wire:click="updateStatus('pending')" class="btn btn-orange"></button>
        <button wire:click="updateStatus('approved')" class="btn btn-success"></button>
        <button wire:click="updateStatus('rejected')" class="btn btn-danger"></button>
    </div>


</div>