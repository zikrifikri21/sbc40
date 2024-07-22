@extends('template.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
        </div>
        <a href="{{ route('bc40-browse') }}" class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                {{ __('Browse File') }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $count }} row
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-folder-open fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        @php
            $level = Auth::user()->user_level->id_user_level;
        @endphp
        @if ($level == 13 || $level == 15 || $level == 17 || $level == 18)
            <a href="{{ route('bc40-index') }}" class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Upload File Excel
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <i class="fas fa-long-arrow-alt-right"></i>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-excel fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endif
    </div>
@endsection
