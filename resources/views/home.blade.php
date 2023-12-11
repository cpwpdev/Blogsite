 @extends('layout')
 @section('title','Home')
 @section('content')
 <div class="container">
 <br>
<h1>Home</h1>
<br>
<br><br><br>
<h2>Our Latest Blog</h2>
@foreach($posts as $post)

    <div class="row">
        <div class="col-md-4"><img class="img-responsive" src="{{ url('/uploads/'. $post->imagepath) }}" alt=""></div>
        <div class="col-md-8">
            <h3>{{ $post->title }}</h3>
        {{ $post->description }}
        @auth
        <br>
        <a href="{{ route('posts.edit',[$post]) }}">EDIT </a>
        
        <form method="POST" action="{{ route('posts.destroy',[$post]) }}">
        @csrf
            @method('DELETE')
            <button type="submit">DELETE</button>
        </form>
        @endauth
    
    </div>
    </div>
    
@endforeach
</div>
 @endsection