@extends('layout')
@section('content')
    <div>
        <form action="{{route('bc40-import')}}" method="post">
            <input type="file" name="file" id="file">

            <button type="submit">submit</button>
        </form>
    </div>
@endsection
