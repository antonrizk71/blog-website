@extends('components.layout')

@section('title', 'New Article')

@section('CreateArticle')
<form action="{{route('articles.store')}}" method="POST" enctype="multipart/form-data"
    class=" col-lg-6 col-md-6 col-sm-9 mt-3 bg-white p-5 rounded-2 mb-5">
    @csrf
    <div class="mb-3">
        <label class="form-label text-dark">Title</label>
        <input type="text" class="form-control" name="title" placeholder="Enter Article Title " value="{{old('title')}}">
        @error('title')
        <div class=" text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label text-dark">Content</label>
        <textarea class="form-control" name="content" id="" cols="30" rows="3"
            placeholder="Enter Article Content ">{{old('content')}}</textarea>
        @error('content')
        <div class=" text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label text-dark">Type</label>
        <select class="form-control" name="type">
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        @error('type')
        <div class=" text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label text-dark">picture</label>
        <input type="file" class="form-control" name="image">
        @error('image')
        <div class=" text-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary w-100  mt-2">ADD</button>
    
</form>
@endsection
</section>