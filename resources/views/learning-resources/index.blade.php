@extends('layouts.fontend')

@section('content')
    <div class="container mt-5">
        <h1 class="text-orange mb-4">เกร็ดความรู้สาระเรียนรู้</h1>
        <div class="col-lg-6 mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="input-group search-box">
                    <form action="{{ route('learning-resources.index') }}" method="GET" class="input-group search-box">
                        <input type="text" name="search" class="form-control border-orange" placeholder="ค้นหา…" value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-orange" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="dropdown mx-2">
                    <button class="btn btn-outline-orange dropdown-toggle" type="button" id="dropdownCategory"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        สาระเรียนรู้
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownCategory">
                        <a class="dropdown-item" href="{{ route('learning-resources.index', ['category' => 'health']) }}">สุขภาพทั่วไป</a>
                        <a class="dropdown-item" href="{{ route('learning-resources.index', ['category' => 'accident']) }}">อุบัติเหตุ</a>
                        <a class="dropdown-item" href="{{ route('learning-resources.index', ['category' => 'illness']) }}">เจ็บป่วย</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            @foreach ($learningResources as $resource)
            <div class="col-md-4 mb-4">
                <div class="card hover-card">
                    <a href="{{ route('learning-resources.show', $resource->id) }}">
                        @php
                            $images = json_decode($resource->image);
                        @endphp
                        @if($images && count($images) > 0)
                            <img src="{{ asset($images[0]) }}" class="card-img-top img-fluid" alt="{{ $resource->title }}">
                        @else
                            <img src="{{ asset('path/to/default/image.jpg') }}" class="card-img-top img-fluid" alt="{{ $resource->title }}">
                        @endif
                        <div class="badge bg-success position-absolute top-0 start-0 mt-2 ms-2">สาระเรียนรู้</div>
                        <div class="card-body">
                            <h5 class="card-title text-orange">{{ $resource->title }}</h5>
                            <p class="card-text">{{ Str::limit($resource->description, 50, '...') }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">{{ $resource->created_at->format('d M, Y') }}</small>
                                <small class="text-muted">{{ number_format( $resource->view_count) }} ครั้ง</small>

                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <style>
        .card {
            transition: all 0.3s ease;
        }

        .hover-card:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

       
        .border-orange {
            border-color: #000099 !important;
        }

        .btn-outline-orange {
            border-color: #000099;
            color: #000099;
        }

        .btn-outline-orange:hover {
            background-color: #000099;
            color: white;
        }

        .search-box .form-control {
            border-top-left-radius: 2px;
            border-bottom-left-radius: 20px;
        }

        .search-box .btn {
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
        }
    </style>
@endsection
