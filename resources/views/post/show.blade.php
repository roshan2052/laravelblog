@extends('layouts.app')

@section('content')

<a href="/posts" class="btn btn-success">GO back </a><br><br>

	<h1> {{ $post->title}} </h1>
	<img style="width:100%;height:400px" src="/storage/cover_images/{{$post->cover_image}}"><br><br>
	<h2> {!!$post->body!!} </h2>
	<small> Written on {{ $post->created_at }} by {{$post->user->name}} </small>
 <hr>
@if(!auth::guest())
 @if(auth::user()->id==$post->user_id)
 <table>
 <tr>
 	<td><a href='/posts/{{$post->id}}/edit' class="btn btn-primary">EDIT &nbsp&nbsp&nbsp&nbsp&nbsp </a>
 	</td>
 	<td> &nbsp&nbsp</td>

	 <td> 
	 {!! Form::open(['action' => ['PostController@destroy', $post->id], 'method'=>'POST','class'=>'pull-right']) !!}
	 {{form::hidden('_method','DELETE')}}
	 {{form::submit('DELETE',['class'=>'btn btn-danger'])}}
	{!! Form::close() !!}
	</td>
</tr>
</table>
@endif
@endif


@endsection
