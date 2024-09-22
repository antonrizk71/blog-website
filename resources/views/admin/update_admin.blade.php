<x-dashboard>
    @section('page_title','Update Admin')
    <form action="{{route('admins.update',$admin->id)}}" method="POST" enctype="multipart/form-data"
        class=" w-75 container text-center mt-5">
        @csrf
        @method('put')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{$admin->name}}">
            @error('name')
            <div class=" text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="{{$admin->email}}">
            @error('email')
            <div class=" text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Profile picture</label>
            <input type="file" class="form-control" name="image">
        </div>
        @if (Auth::user()->role === 'SuperAdmin')
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="role" id="inlineRadio2" value="user" {{$admin->role == 'user' ? 'checked' : ''}}>
            <label class="form-check-label" for="inlineRadio2">User</label>
        </div>
        <div class="form-check form-check-inline me-5">
            <input class="form-check-input" type="radio" name="role" id="inlineRadio1" value="admin" {{$admin->role == 'admin' ? 'checked' : ''}}>
            <label class="form-check-label" for="inlineRadio1">Admin</label>
        </div>
        @error('role')
        <div class=" text-danger">{{ $message }}</div>
        @enderror
        
        <div class="form-check form-check-inline ms-5">
            <input class="form-check-input" type="radio" name="status" id="inlineRadio3" value="1" {{$admin->status == 1 ? 'checked' : ''}}>
            <label class="form-check-label" for="inlineRadio3">Active</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="status" id="inlineRadio4" value="0" {{$admin->status == 0 ? 'checked' : ''}}>
            <label class="form-check-label" for="inlineRadio4">Passive</label>
        </div>
        @error('status')
        <div class=" text-danger">{{ $message }}</div>
        @enderror
        @endif
        <button type="submit" class="btn btn-primary mt-3 form-control">Update</button>
    </form>

</x-dashboard>
