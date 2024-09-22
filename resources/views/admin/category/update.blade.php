<x-dashboard>
    @section('page_title', 'Update Category')
    <form action="{{route('category.update',$id)}}" method="POST" class=" w-50 container text-center mt-5">
        @csrf
        @method('put')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{$category->name}}">
        </div>
        <button type="submit" class="btn btn-primary mt-3 form-control">Update</button>

        
    </form>
    <form action="{{ route('category.destroy', $category->id) }}" method="POST" class=" w-50 container text-center ">
        @csrf
        @method('DELETE')
        <button type="submit" class=" btn btn-danger mt-3 form-control">Delete</button>
    </form>
</x-dashboard>