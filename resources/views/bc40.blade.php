@extends('template.app')
@section('content')
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="list-unstyled mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bc40-import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="file btn btn-md btn-primary">
            <span>
                Select file
            </span>
            <i class="fas fa-upload"></i>
            <input type="file" class="file-upload" name="file" />
        </div>
        <button class="btn btn-md btn-primary" type="submit">Upload</button>
    </form>
@endsection
