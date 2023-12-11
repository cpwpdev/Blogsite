@extends('layout')
 @section('title','Edit Blog Post')
 @section('content')
 <div class="container pt-lg-5">
    <div class="row justify-content-center">
    <div class="col-md-6 ">
 <h1>Edit Blog</h1>
<form method="POST" action="{{ route('posts.update',[$post]) }}" enctype="multipart/form-data"
>
  <div class="form-group mb-3">
    @csrf

    @method('PUT')
    <label for="Title">Title</label>
    <input type="text" class="form-control" id="title" value="{{old('title',$post->title)}}" name="title" placeholder="Title">
    @error('title')
        {{ $message }}
        @enderror
   </div>
  <div class="form-group mb-3">
    <label for="Description">Description</label>
    <textarea name="description" class="form-control"  id="Description" cols="30" rows="10">{{old('title',$post->description)}}</textarea>
     @error('description')
        {{ $message }}
        @enderror
  </div>

  <div class="form-group mb-3">
    @csrf
    <label for="imagepath">Blog Image</label>
    <input type="file" class="form-control" id="imagepath" name="imagepath" placeholder="image">
    <img class="img-responsive" src="{{ url('/uploads/'. $post->imagepath) }}" alt="">
    @error('imagepath')
        {{ $message }}
        @enderror
   </div>
   
  <button type="submit" class="btn btn-primary">Create Now</button>
</form>
@if(session('success')) <div class="alert alert-success" role="alert"> {{session('success')}}  </div> @endif
    </div></div></div>
   
 @endsection