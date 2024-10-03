<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">เหตุการณ์ที่เสร็จสิ้นแล้ว</h6>
    </div>
    <div class="card-body">
        <div class="row">
            @forelse ($completedIncidents as $incident)
                <div class="col-xl-12 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 " style="max-high: 30px; margin: 0 auto;">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-3 text-center">
                                    @if ($incident->images)
                                        @php
                                            $images = json_decode($incident->images);
                                        @endphp
                                        @if ($images && count($images) > 0)
                                            <img src="{{ asset('images/' . $images[0]) }}" alt="Image"
                                                class="img-fluid rounded" style="max-width: 150px; height: auto;""
                                                data-bs-toggle="modal" data-bs-target="#imageModal{{ $incident->id }}">
                                        @endif
                                    @endif

                                </div>
                                <div class="col-8">
                                    <h5 class="blog-post-title ">
                                        <span
                                            class="badge @if ($incident->help_needed == 'อุบัติเหตุ') bg-danger @elseif($incident->help_needed == 'เจ็บป่วย') bg-warning @else bg-secondary @endif text-white">
                                            แจ้ง {{ $incident->help_needed }}
                                        </span>
                                        <span class="text-muted"> {{ $incident->case_number }}</span>
                                    </h5>
                                    <p class="card-text mb-1"><strong>รายละเอียด:</strong> {{ $incident->description }}
                                        <span class="text-muted">ผู้ป่วย {{ $incident->quantity }} คน</span>
                                    </p>
                                    <p class="card-text mb-1"><strong>วันที่แจ้งเหตุ:</strong>
                                        {{ $incident->created_at->format('d/m/Y') }}</p>
                                    <p class="card-text mb-1"><strong>ข้อมูลเพิ่มเติม:</strong>
                                        {{ $incident->remarks ?? 'ไม่มีข้อมูลเพิ่มเติม' }}</p>
                                   
                                    <p class="card-text">
                                        <i class="fa-solid fa-circle"
                                            style="color: 
                                                  @if ($incident->status == 'เสร็จสิ้น') blue 
                                                  @elseif ($incident->status == 'ยกเลิก') red @endif">
                                        </i>
                                        <span
                                            class="
                                                  @if ($incident->status == 'เสร็จสิ้น') text-primary 
                                                  @elseif ($incident->status == 'ยกเลิก') text-danger @endif">
                                            {{ $incident->status }}
                                        </span>
                                    </p>

                                </div>
                            </div>
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
                
            @empty
                <p class="text-center">ไม่มีเหตุการณ์ที่เสร็จสิ้น</p>
            @endforelse
        </div>
    </div>
</div>


@endsection
