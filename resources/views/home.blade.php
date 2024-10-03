<!-- resources/views/home.blade.php -->
@extends('layouts.backend')

@section('content')
 
<div class="row">
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
              <div class="icon-big text-center icon-primary bubble-shadow-small">
                <i class="fas fa-users"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">เหตุการณ์ใหม่ (รอรับเคส)</p>
                <h4 class="card-title">{{ $newIncidentsCount }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
                <div class="icon-big text-center icon-success bubble-shadow-small">
                  <i class="fas fa-spinner fa-spin"></i>
                </div>
              </div>
              
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">กำลังดำเนินการ</p>
                <h4 class="card-title">{{ $inProgressCount }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
                <div class="icon-big text-center icon-info bubble-shadow-small">
                  <i class="fas fa-user-check"></i>
                </div>
              </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">ดำเนินการเสร็จสิ้น</p>
                <h4 class="card-title"> {{ $completedIncidentsCount }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
      

    </div>
    </div>
@endsection
