@extends('layouts.app')

@section('content')

    <form method="post" action="/posts"  enctype="multipart/form-data">
        @csrf
        <input type="text" name="title" placeholder="Enter title">

        <input type="file" class="form-control-file" name="file" id="exampleInputFile">
        <input type="submit" name="submit">
        <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
    </form>

    @foreach($errors->all() as $error)
        {{$error}}
    @endforeach

@endsection