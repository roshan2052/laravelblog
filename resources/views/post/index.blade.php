@extends('layouts.app')

@section('content')

<b><h1 style="color:red">Posts </h1></b><hr>

 @if (session('status'))
 <div class="alert alert-success" role="alert" id="successMessage">
    {{ session('status') }}
</div>
@endif

@if(count($pos)>0)
 @foreach($pos as $post)

   <div class="well">
   	<div class="row">
   		<div class="col-md-4 col-sm-4">
   			<img style="width:100%;height:200px" src="/storage/cover_images/{{$post->cover_image}}">
   		</div>

   		<div class="col-md-8 col-sm-8">
		 	<h1> <a href="/posts/{{ $post->id }}"> {{ $post->title }} </a></h1>

	        <small> written on {{ $post->created_at }} by {{$post->user->name}} </small> 
   		</div>
    </div>
   </div>
   <hr><hr>

   

 @endforeach 
@else
   <p> No post found </p>
@endif

@endsection