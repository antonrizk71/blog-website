<x-dashboard>
  @section('page_title', 'Categories')
  <form action="{{route('category.create')}}" method="GET" class=" w-75 container text-center mt-5">
    @csrf
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope=" col ">Name</th>
          <th scope=" col "></th>
          <th scope=" col "></th>
        </tr>
      </thead>
      <tbody>
        @foreach($categories as $category)
        <tr>
          <th scope="row">{{$category->id}}</th>
          <td>{{$category->name}}</td>
          <td>
            <form action="{{ route('category.destroy', $category->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" style="background: none; border: none; cursor: pointer;">
                <i class=" fa-regular fa-trash-can  text-danger "></i>
            </form>

          </td>
          <td>
            <form action="{{ route('category.edit', $category->id) }}" method="GET">
              @csrf
              <button type="submit" style="background: none; border: none; cursor: pointer;">
                <i class="fa-regular fa-pen-to-square"></i>
              </button>
            </form>


          </td>
        </tr>
        @endforeach
        @if ($categories->count()==0)
        <div class="alert alert-warning mt-5" role="alert">
          No Categories !
        </div>
        @endif
      </tbody>
    </table>
    <button type="submit" class="btn btn-primary mt-3 form-control">ADD</button>
  </form>

</x-dashboard>