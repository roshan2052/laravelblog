@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="/posts/create" class="btn btn-primary">Create Post </a><br><br>
                   
                    @if(count($posts) > 0)
                     <h3> your blogs post </h3> 
                     <table class="table table-stripped">
                        <tr>
                            <th>Title </th>
                            <th> </th>
                            <th> </th>
                        </tr>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->title}}</td>
                                <td>
                                    <a href="/posts/{{$post->id}}/edit" class="btn btn-success">    EDIT&nbsp&nbsp </a>
                                </td>
                                <td>
                                    {!! Form::open(['action' => ['PostController@destroy', $post->id], 'method'=>'POST','class'=>'pull-right']) !!}

                                    {{form::hidden('_method','DELETE')}}
                                    {{form::submit('DELETE',['class'=>'btn btn-danger'])}}

                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    @else
                       <h2 style="color:red">YOU HAVE NO POSTS </h2>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
