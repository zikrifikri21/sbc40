@extends('template.app')
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-danger rounded-circle" id="reset-button"
                                style="display: none;color: #fff;">
                                <i class="fas fa-times"></i>
                            </button>
                            <div id="border" class="d-flex justify-content-center bg-light mb-3">
                                <img src="" alt="Excel Thumbnail" id="file-thumbnail" style="display: none;"
                                    width="100px">
                            </div>
                            <form action="{{ route('bc40-import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex justify-content-between gap-2">
                                    <div class="file btn btn-md btn-primary">
                                        <span>
                                            Select file
                                        </span>
                                        <i class="fas fa-upload"></i>
                                        <input type="file" accept=".xlsx" class="file-upload" name="file"
                                            id="file-input" />
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
    <script>
        document.getElementById('file-input').addEventListener('change', function() {
            var file = this.files[0];
            var thumbnail = document.getElementById('file-thumbnail');
            var resetButton = document.getElementById('reset-button');
            var border = document.getElementById('border');

            if (file) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    thumbnail.src = "{{ asset('excel-logo.png') }}";
                    thumbnail.style.display = 'inline-block';
                    resetButton.style.display = 'inline-block';
                    border.classList.add('border');
                };
                reader.readAsDataURL(file);
            } else {
                thumbnail.src = "";
                thumbnail.style.display = 'none';
                resetButton.style.display = 'none';
            }
        });

        document.getElementById('reset-button').addEventListener('click', function() {
            var fileInput = document.getElementById('file-input');
            fileInput.value = '';
            document.getElementById('file-thumbnail').src = '';
            document.getElementById('file-thumbnail').style.display = 'none';
            this.style.display = 'none';
        });
    </script>
@endsection
