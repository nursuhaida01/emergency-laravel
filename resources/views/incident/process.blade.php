@extends('layouts.backend')

@section('content')

        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">ข้อมูลการแจ้งอุบัติเหตุ</h4>
                    
                </div>
            </div>
       
            <div class="card-body">
                <div class="table-responsive" style="overflow-x: hidden;">
                    <div class="row g-4">
                        <!-- Column 1: Incident Info -->
                        <div class="col-md-4">
                            <p><strong>ข้อมูลผู้ป่วย:</strong> <span class="badge @if ($incident->help_needed == 'อุบัติเหตุ') bg-danger @elseif($incident->help_needed == 'เจ็บป่วย') bg-warning @else bg-secondary @endif text-white">
                                แจ้ง {{ $incident->help_needed }}
                            </span></p>
                            <p><strong>วันที่แจ้งเหตุ:</strong> 04/11/2020, 17:45</p>
                           
                            <p><strong>สถานที่เกิดเหตุ:</strong> {{ $incident->location }}</p>
                            
                        </div>
            
                        <!-- Column 2: Symptoms -->
                        <div class="col-md-4">
                            <p><strong>รายละเอียดเบื้องต้นของผู้ป่วย:</strong></p>
                            <p><strong>รายละเอียด:</strong> {{ $incident->description }}</p>
                            <p><strong>จำนวนผู้ป่วย:</strong> 1 คน</p>
                        </div>
            
                        <!-- Column 3: Contact Info -->
                        <div class="col-md-4">
                            <p><strong>ผู้ติดต่อ:</strong></p>
                            <p><strong>ชื่อผู้แจ้ง:</strong> {{ $incident->user->username ?? 'ไม่ระบุ' }}</p>
                            <p><strong>เบอร์ติดต่อ:</strong> {{ $incident->contact_number }}</p>
                            
                        </div>
                    </div>
            
                    <!-- Map Section -->
                    <div id="map" style="width: 100%; height: 400px; margin-top: 20px; "></div>
            
                    <!-- Image Section -->
                    <h5 class="mt-4">รูปภาพประกอบ</h5>
                    <div class="row">
                        @if($incident->images)
                            @foreach(json_decode($incident->images) as $image)
                                <div class="col-md-4">
                                    <img src="{{ asset('images/' . $image) }}" class="img-fluid" alt="รูปภาพเหตุการณ์">
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted">ไม่มีรูปภาพ</p>
                        @endif
                    </div>
                </div>
            </div>
            
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('incident.process', $incident->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="status">สถานะ</label><br>
                        
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="status1" name="status" value="กำลังดำเนินการ" {{ $incident->status == 'กำลังดำเนินการ' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="status1">กำลังดำเนินการ</label>
                        </div>
                        
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="status2" name="status" value="ยกเลิก" {{ $incident->status == 'ยกเลิก' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="status2">ยกเลิก</label>
                        </div>
                    </div>
                    

                    <div class="form-group">
                        <label for="remarks">รายละเอียด</label>
                        <textarea id="remarks" name="remarks" class="form-control" rows="3">{{ old('remarks', $incident->remarks) }}</textarea>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">การดำเนินการ</button>
                        <a href="{{ route('incident.index') }}" class="btn btn-secondary">กลับ</a>
                    </div>
                    
                </form>
            </div>
        </div>
           
       
      
  
</section>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFubb6q1IngaepC2s5UnqcrXQcIhGdbzA&libraries=places"></script>
<script>
   function initMap() {
    const incidentLocation = {
        lat: parseFloat("{{ $incident->latitude }}"),
        lng: parseFloat("{{ $incident->longitude }}")
    };

    const map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: incidentLocation,
    });

    const marker = new google.maps.Marker({
        position: incidentLocation,
        map: map,
    });

    const directionsService = new google.maps.DirectionsService();
    const directionsRenderer = new google.maps.DirectionsRenderer({
        map: map
    });

    const startLocation = {
        lat: 6.5591358,
        lng: 101.2874417
    };

    directionsService.route({
        origin: startLocation,
        destination: incidentLocation,
        travelMode: google.maps.TravelMode.DRIVING
    }, function(response, status) {
        if (status === google.maps.DirectionsStatus.OK) {
            directionsRenderer.setDirections(response);

            // ดึงข้อมูลระยะเวลาในการเดินทางจาก response
            const travelTime = response.routes[0].legs[0].duration.text;

            // สร้าง InfoWindow สำหรับแสดงเวลาในการเดินทาง
            const infoWindow = new google.maps.InfoWindow({
                content: `<div style="color: black;"><strong>ระยะเวลาในการเดินทาง:</strong> ${travelTime}</div>`,
                position: incidentLocation
            });

            // แสดง InfoWindow บนแผนที่
            infoWindow.open(map);
        } else {
            alert('Directions request failed due to ' + status);
        }
    });
}

window.onload = initMap;

</script>
<style>
body {
    overflow-x: hidden; /* ซ่อนแถบเลื่อนแนวนอน */
}

.container {
    max-width: 100vw; /* ป้องกันการล้นหน้าจอ */
    overflow-x: hidden; /* ซ่อนแถบเลื่อนแนวนอนในคอนเทนเนอร์ */
}
.img-fluid {
    width: 100%; /* ปรับขนาดให้รูปภาพเต็มคอลัมน์ */
    height: auto;
}


</style>
@endsection
