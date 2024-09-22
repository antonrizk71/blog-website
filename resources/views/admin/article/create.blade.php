
<x-dashboard>
    @section('page_title', 'Add Article')
    <form action="{{route('articles.store')}}" method="POST" enctype="multipart/form-data"
        class="  container text-center mt-5 bg-white p-5 rounded-2">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" placeholder="Enter Article Title ">
            @error('title')
            <div class=" text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea class="form-control" name="content" id="" cols="30" rows="3"
                placeholder="Enter Article Content "></textarea>
            @error('content')
            <div class=" text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Type</label>
            <select class="form-select"  name="type">
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            @error('type')
            <div class=" text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Profile picture</label>
            <input type="file" class="form-control" name="image">
            @error('image')
            <div class=" text-danger">{{ $message }}</div>
            @enderror
        </div>
      
        <div class="form-check form-check-inline me-5">
            <input class="form-check-input" type="radio" name="status"  value="pending">
            <label class="form-check-label" for="inlineRadio1">Pending</label>
        </div>
        <div class="form-check form-check-inline me-5">
            <input class="form-check-input" type="radio" name="status"  value="approved" checked >
            <label class="form-check-label" for="inlineRadio1">Approved</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="status"  value="rejected" >
            <label class="form-check-label" >Rejected</label>
        </div>
      
        @error('status')
        <div class=" text-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary mt-3 form-control">ADD</button>
    </form>

</x-dashboard>