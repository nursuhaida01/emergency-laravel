@extends('layouts.fontend')

@section('content')
    <div class="container mt-2">
        <div class="row">
            <!-- Main News Content -->
            <div class="col-lg-8">
                <h3 class="mb-4">{{ $resource->title }}</h3>
                <div class="d-flex align-items-center text-muted">

                    <i class="fas fa-calendar-alt" style="color:#1E3A8A; margin-left: 15px; margin-right: 5px;"></i>
                    <!-- ไอคอนปฏิทิน -->
                    {{ \Carbon\Carbon::parse($resource->time)->format('d M Y') }}
                </div>
                <br>
                @if ($resource->image)
                    @php
                        $images = json_decode($resource->image);
                    @endphp
                    @if ($images && count($images) > 0)
                        <!-- Bootstrap Carousel -->
                        <div id="resourceCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($images as $index => $image)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ asset($image) }}" class="d-block w-100" alt="{{ $resource->title }}">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#resourceCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#resourceCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    @endif
                @else
                    <img src="{{ asset('path/to/default/image.jpg') }}" class="card-img-top img-fluid"
                        alt="{{ $resource->title }}">
                @endif
                <div class="card-body">
                    <p class="card-text">{{ $resource->description }}</p>

                </div>
            </div>

            <!-- Related Resources Section -->
            <div class="col-lg-4">
                <h4 class="mb-4">สาระเรียนรู้ที่เกี่ยวข้อง</h4>
                @foreach ($relatedResources as $related)
                    <a href="{{ route('learning-resources.show', $related->id) }}" class="text-decoration-none">
                        <div class="related-news-card mb-3">
                            <div class="row no-gutters">
                                <div class="col-md-4 d-flex align-items-center justify-content-center">
                                    @if ($related->image)
                                        <div class="image-container"
                                            style="max-width: 90px; max-height: 90px; overflow: hidden; border-radius: 10px;">
                                            <img src="{{ asset(json_decode($related->image)[0]) }}" class="img-fluid"
                                                alt="{{ $related->title }}"
                                                style="width: auto; height: 100%; object-fit: cover;">
                                        </div>
                                    @else
                                        <div class="image-container"
                                            style="max-width: 90px; max-height: 90px; overflow: hidden; border-radius: 10px;">
                                            <img src="{{ asset('path/to/default/image.jpg') }}" class="img-fluid"
                                                alt="{{ $related->title }}"
                                                style="width: auto; height: 100%; object-fit: cover;">
                                        </div>
                                    @endif
                                </div>


                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $related->title }}</h5>
                                        <p class="card-text">{{ Str::limit($related->excerpt, 100) }}</p>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                <i class="fas fa-calendar-alt"></i>
                                                {{ $related->created_at->format('d M Y') }}
                                                &nbsp;&nbsp;
                                                <i class="fas fa-eye"></i> {{ number_format($related->view_count) }} ครั้ง
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <style>
        .related-news-card .img-fluid {
            width: 100%;
            /* ความกว้างของรูปภาพเต็มขนาดของคอลัมน์ */
            height: 80px;
            /* กำหนดความสูงของรูปภาพ */
            object-fit: cover;
            /* ครอบคลุมรูปภาพให้เต็มและครอบตัดส่วนที่เกิน */
            display: block;
            /* ทำให้รูปภาพเป็นบล็อกเพื่อให้มีการจัดกึ่งกลาง */
            margin: 0 auto;
            /* จัดกึ่งกลางในแนวนอน */
        }

        .related-news-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            transition: all 0.3s ease;
            background-color: #fff;
            overflow: hidden;
            /* ป้องกันการล้นของการ์ด */
        }

        .related-news-card .row.no-gutters {
            transition: background-color 0.3s ease;
            border-radius: 10px;
            /* เพิ่มการโค้งมนที่แถว */
        }

        .related-news-card:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
            background-color: #5c5cd6;
            /* สีแดงอ่อน */
        }

        .related-news-card .img-fluid {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        .related-news-card .card-body {
            padding: 10px 15px;
        }

        .related-news-card .card-title {
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .related-news-card .card-text {
            font-size: 0.9rem;
            color: #555;
        }

        .related-news-card .text-muted {
            font-size: 0.8rem;
            color: #999;
        }

        .related-news-card i {
            margin-right: 5px;
            color: #888;
        }
    </style>
@endsection
