@extends('template.app')
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('bc40-import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex justify-content-between gap-2">
                                    <div class="file btn btn-md btn-primary">
                                        <span>
                                            Select file
                                        </span>
                                        <i class="fas fa-upload"></i>
                                        <input type="file" accept=".xlsx" class="file-upload" name="file" />
                                    </div>
                                    <div>
                                        <button class="btn btn-md btn-primary" type="submit">Upload</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12 mt-3">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">{!! session('error') !!}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            @if ($errors->any())
                <div class="card shadow mb-4">
                    <a href="#collapse" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapse">
                        <h6 class="m-0 font-weight-bold text-primary">Lihat Kesalahan Baris</h6>
                    </a>
                    <div class="collapse" id="collapse" style="">
                        <div class="card-body">
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger" role="alert">
                                    <ul class="list-unstyled mb-0">
                                        <li>{!! $error !!}</li>
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
