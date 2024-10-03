@extends('layouts.fontend')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold ">รายละเอียดการแจ้งอุบัติเหตุ (เคส)</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>เคสหมายเลข:</strong> {{ $incident->case_number }}</p>
                    <p><strong>สถานะ:</strong> 
                        @if($incident->status == 'แจ้งเหตุใหม่')
                            รอรับเคส
                        @else
                            {{ $incident->status }}
                        @endif
                    </p>
                    <p><strong>ตำแหน่ง:</strong> {{ $incident->location }}</p>
                    <p><strong>วันที่แจ้งเหตุ:</strong> {{ $incident->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>รายละเอียด:</strong> {{ $incident->description }}</p>
                    <p><strong>ช่วยเหลือที่ต้องการ:</strong> {{ $incident->help_needed }}</p>
                    <p><strong>จำนวนผู้ป่วย:</strong> {{ $incident->quantity }}</p>
                    <p><strong>ติดต่อ:</strong> {{ $incident->contact_number }}</p>
                   
                </div>
            </div>

            @if($incident->images)
                <p><strong>รูปภาพ:</strong></p>
                @php
                    $images = json_decode($incident->images, true);
                @endphp
                <div class="row">
                    @foreach ($images as $image)
                        <div class="col-md-4">
                            <img src="{{ asset('images/' . $image) }}" class="img-fluid rounded mb-3" alt="Incident Image">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

@endsection
