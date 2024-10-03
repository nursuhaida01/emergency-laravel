@extends('layouts.backend')

@section('content')

    <h1 class="h3 mb-2 text-gray-800">ข้อมูลการปฏิบัติ</h1>
    @if (session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">ข้อมูลการปฏิบัติ</h6>
            <a href="{{ route('operations.create') }}" class="btn btn-primary" role="button">
                <i class="fas fa-plus"></i> เพิ่มข้อมูล
            </a>
        </div>

        <div class="card-body">
            <div class="row">
                @forelse ($operations as $operation)
                    <div class="col-xl-12 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 ">
                            
                                <div class="row align-items-center">
                                    <div class="col-4 text-center">
                                        @if ($operation->images)
                                            @php
                                                $images = json_decode($operation->images);
                                            @endphp
                                            @if ($images && count($images) > 0)
                                                <img src="{{ asset('images/' . $images[0]) }}" alt="Image"
                                                    class="img-fluid rounded" style="max-width: 150px; height: auto;"
                                                    data-bs-toggle="modal" data-bs-target="#imageModal{{ $operation->id }}">
                                            @endif
                                        @endif
                                                                          </div>
                                    <div class="col-8">
                                        <h5 class="card-title font-weight-bold">
                                            <span class="badge bg-warning text-white">
                                                {{ $operation->incident->case_number ?? 'N/A' }}
                                            </span>
                                           
                                        </h5>
                                        <p class="card-text mb-1"><strong>ข้อมูลการปฏิบัติ:</strong>
                                            {{ $operation->action_taken }}</p>
                                        <p class="card-text mb-1"><strong>รายละเอียด:</strong> {{ $operation->details }}
                                        </p>
                                        <p class="card-text mb-1"><strong>สถานที่:</strong> {{ $operation->location }}</p>
                                        <p class="card-text mb-1"><strong>ผู้บันทึก:</strong>  <span class="text-muted"> {{ $operation->user->username ?? 'N/A' }}</span></p>
                                        <p class="card-text mt-2 mb-0 text-muted">
                                            {{ \Carbon\Carbon::parse($operation->operation_date)->format('d/m/Y') }}</p>
 
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="imageModal{{ $operation->id }}" tabindex="-1"
                        aria-labelledby="imageModalLabel{{ $operation->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="imageModalLabel{{ $operation->id }}">รูปภาพเหตุการณ์</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="carouselExample{{ $operation->id }}" class="carousel slide"
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
                                            data-bs-target="#carouselExample{{ $operation->id }}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselExample{{ $operation->id }}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">ไม่มีข้อมูลการปฏิบัติ</p>
                @endforelse
            </div>
        </div>
    </div>
    
@endsection
