@extends('layouts.app')

@section('content')

    <ul>
        @foreach($posts as $post)

            <li><a href="{{route('posts.show', $post->id)}}">{{$post->title}}</a>&nbsp&nbsp&nbsp<a href="{{route('posts.edit', $post->id)}}">Edit</a>&nbsp&nbsp&nbsp
        
            <form method="post" action="/posts/{{$post->id}}">

            <!-- {!! Form::open() !!} -->
            @csrf
                <input type="hidden" name="_method" value="DELETE">
                <input type="submit" value="Delete">
            </form>
            <img src="/images/{{$post->path}}" alt="">
        </li>

        @endforeach
    </ul>

@endsection