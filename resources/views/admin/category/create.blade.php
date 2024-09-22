<x-dashboard>
    @section('page_title', 'Create Category')
    
    <form action="{{route('category.store')}}" method="POST" class=" w-75 container text-center mt-5">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter Category Name " >
        </div>
        <button type="submit" class="btn btn-primary mt-3 form-control">ADD</button>
    </form>

</x-dashboard>