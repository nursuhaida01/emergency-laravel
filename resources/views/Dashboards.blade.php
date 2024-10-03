@extends('layouts.fontend')

@section('content')
 <!-- Carousel Start -->
 <div class="container-fluid carousel-header px-0">
    <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselId" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <img src="{{ asset('images/abs.jpg') }}" class="img-fluid" alt="Image">
                <div class="carousel-caption">
                    <div class="p-3" style="max-width: 900px;">
                        <h4 class="text-primary text-uppercase mb-3">
                            ยินดีต้อนรับเข้าสู่ระบบ</h4>
                            <h4 class="text-primary display-4">
                            @if ($user)
                                <span class="username">คุณ {{ $user->username }}</span>
                            @endif
                        </h4>
                        
                        <h1 class="display-1 text-capitalize text-dark mb-3">บริการแจ้งอุบัติเหตุ</h1>
                        <p class="mx-md-5 fs-4 px-4 mb-5 text-dark">มูลนิธิแม่กอเหนี่ยวจังหวัดยะลา</p>
                        <div class="d-flex align-items-center justify-content-center">
                            <a class="btn btn-light btn-light-outline-0 rounded-pill py-3 px-5 me-4" href="tel:1669">โทร</a>

                            @auth
                            <a class="btn btn-primary btn-primary-outline-0 rounded-pill py-3 px-5" href="{{ route('incident.create') }}">
                                แจ้งอุบัติเหตุ
                            </a>
                            @else
                            <a class="btn btn-primary btn-primary-outline-0 rounded-pill py-3 px-5" href="{{ route('user.login') }}">
                                แจ้งอุบัติเหตุ (โปรดล็อกอิน)
                            </a>
                            @endauth
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/logo.jpg') }}" class="img-fluid" alt="Image">
                <div class="carousel-caption">
                    <div class="p-3" style="max-width: 900px;">
                        <h4 class="text-primary text-uppercase mb-3">
                            ยินดีต้อนรับเข้าสู่ระบบ</h4>
                            <h4 class="text-primary display-4">
                            @if ($user)
                                <span class="username">คุณ {{ $user->username }}</span>
                            @endif
                        </h4>
                        <h1 class="display-1 text-capitalize text-dark mb-3">บริการแจ้งอุบัติเหตุ</h1>
                        <p class="mx-md-5 fs-4 px-4 mb-5 text-dark">มูลนิธิแม่กอเหนี่ยวจังหวัดยะลา</p>
                         <div class="d-flex align-items-center justify-content-center">
                            <a class="btn btn-light btn-light-outline-0 rounded-pill py-3 px-5 me-4" href="tel:1669">โทร</a>

                            @auth
                            <a class="btn btn-primary btn-primary-outline-0 rounded-pill py-3 px-5" href="{{ route('incident.create') }}">
                                แจ้งอุบัติเหตุ
                            </a>
                            @else
                            <a class="btn btn-primary btn-primary-outline-0 rounded-pill py-3 px-5" href="{{ route('user.login') }}">
                                แจ้งอุบัติเหตุ (โปรดล็อกอิน)
                            </a>
                            @endauth
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/accident.jpg') }}" class="img-fluid" alt="Image">
                <div class="carousel-caption">
                    <div class="p-3" style="max-width: 900px;">
                        <h4 class="text-primary text-uppercase mb-3">
                            ยินดีต้อนรับเข้าสู่ระบบ</h4>
                            <h6 class="text-primary display-4">
                            @if ($user)
                                <span class="username">คุณ {{ $user->username }}</span>
                            @endif
                        </h6>
                        <h1 class="display-1 text-capitalize text-dark mb-3">บริการแจ้งอุบัติเหตุ</h1>
                        <p class="mx-md-5 fs-4 px-4 mb-5 text-dark">มูลนิธิแม่กอเหนี่ยวจังหวัดยะลา</p>
                        <div class="d-flex align-items-center justify-content-center">
                            <a class="btn btn-light btn-light-outline-0 rounded-pill py-3 px-5 me-4" href="tel:1669">โทร</a>

                            @auth
                            <a class="btn btn-primary btn-primary-outline-0 rounded-pill py-3 px-5" href="{{ route('incident.create') }}">
                                แจ้งอุบัติเหตุ
                            </a>
                            @else
                            <a class="btn btn-primary btn-primary-outline-0 rounded-pill py-3 px-5" href="{{ route('user.login') }}">
                                แจ้งอุบัติเหตุ (โปรดล็อกอิน)
                            </a>
                            @endauth
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Carousel End -->

    <!-- Services Start -->
 <div class="container-fluid services py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 800px;">
            <p class="fs-4 text-uppercase text-center text-primary">บริการ</p>
            <h1 class="display-3">ข่าวสาร & การเกิดอุบัติเหตุ</h1>
        </div>
        <div class="row g-4">
            @foreach($latestNews as $news)
            <div class="col-lg-6">
                <div class="services-item bg-light border-4 border-end border-primary rounded p-4">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <div class="services-content text-end">
                                <h3>{{ $news->title }}</h3>
                                <p>{{ Str::limit($news->content, 50, '...') }}</p>
                                <p>{{ \Carbon\Carbon::parse($news->created_at)->translatedFormat('d M y') }}</p>

                                <a href="#" class="btn btn-primary btn-primary-outline-0 rounded-pill py-2 px-4" data-bs-toggle="modal" data-bs-target="#newsModal{{ $news->id }}">รายละเอียด</a>

                            </div>
                        </div>
                        <div class="col-4">
                            <div class="services-img d-flex align-items-center justify-content-center rounded">
                                @php
                                $images = json_decode($news->image);
                            @endphp
                            @if($images && count($images) > 0)
                                <img src="{{ asset($images[0]) }}" class="img-fluid rounded" alt="{{ $news->title }}">
                            @endif
                              
                            </div>
                         
                        
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
<div class="modal fade" id="newsModal{{ $news->id }}" tabindex="-1" role="dialog" aria-labelledby="newsModalLabel{{ $news->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newsModalLabel{{ $news->id }}">รายละเอียด</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h3>{{ $news->title }}</h3>
          @if($images && count($images) > 0)
              <img src="{{ asset($images[0]) }}" class="img-fluid" alt="{{ $news->title }}">
          @endif
          <p>{{ $news->content }}</p>
        </div>
       
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        </div>
      </div>
    </div>
  </div>
  
         
            
            @endforeach

            <div class="col-12">
                <div class="services-btn text-center">
                    <a href="{{ route('news.index') }}" class="btn btn-primary btn-primary-outline-0 rounded-pill py-3 px-5">เพิ่มเติม</a>
                </div>
            </div>
     
          
        </div>
    </div>
</div>
<!-- Services End -->

@endsection
