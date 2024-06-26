@extends('layout')
@section('content')
    <div>
        <form action="{{route('auth-login')}}" method="post">
            @csrf
            <input type="email" name="email" id="email">
            <input type="password" name="password" id="password">

            <button type="submit">submit</button>
        </form>
    </div>
@endsection
