@extends('layouts.fontend')

@section('content')
<div class="container mt-5">
    <h1>รายการแจ้งเตือนเหตุการณ์</h1>
    
    @foreach($incidents as $incident)
        <div class="card mb-3 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <span class="badge bg-danger text-white">แจ้ง อุบัติเหตุ</span>
                    <span class="ms-2">{{ $incident->case_number }}</span>
                </div>
                <span class="text-primary">{{ $incident->status }}</span>
            </div>
            <div class="card-body d-flex">
                <div class="col-12 col-md-2">
                    @if ($incident->images)
                        @php
                            $images = json_decode($incident->images);
                        @endphp
                        @if ($images && count($images) > 0)
                            <img src="{{ asset('images/' . $images[0]) }}" alt="Image"
                                class="img-fluid rounded" style="max-width: 100px; height: auto;"
                                data-bs-toggle="modal" data-bs-target="#imageModal{{ $incident->id }}">
                        @endif
                    @endif
                </div>
                <div>
                    <p><strong>รายละเอียด:</strong> {{ $incident->description }}</p>
                    <p><strong>วันที่แจ้งเหตุ:</strong> {{ $incident->created_at->format('d/m/Y') }}</p>
                    <p><strong>ข้อมูลเพิ่มเติม:</strong> {{ $incident->additional_info }}</p>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="imageModal{{ $incident->id }}" tabindex="-1"
            aria-labelledby="imageModalLabel{{ $incident->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel{{ $incident->id }}">รูปภาพเหตุการณ์</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="carouselExample{{ $incident->id }}" class="carousel slide"
                            data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($images as $index => $image)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('images/' . $image) }}" class="d-block w-100"
                                            alt="Image">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExample{{ $incident->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExample{{ $incident->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @if($incidents->isEmpty())
        <div class="card mb-4">
            <div class="card-body">
                <p>ไม่มีเหตุการณ์ที่เสร็จสิ้น</p>
            </div>
        </div>
    @endif

</div>
@endsection
