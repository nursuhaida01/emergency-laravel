@extends('layouts')

@section('content')

<div class="container-fluid">
    <div style="margin-left: 200px; padding: 20px;">
        <div id="rcorners2">   
  
            <h4 class="alert-heading">ภารกิจเสร็จสิ้น!</h4>
            <p>ภารกิจของคุณได้ดำเนินการเสร็จสิ้นเรียบร้อยแล้ว.</p>
            <hr>
            <p class="mb-0">รายละเอียดของการแจ้งเหตุ:</p>
            <ul>
                <li><strong>หมายเลขเหตุการณ์:</strong> {{ $incident->id }}</li>
                <li><strong>สถานที่:</strong> {{ $incident->location }}</li>
                <li><strong>ความช่วยเหลือที่ต้องการ:</strong> {{ $incident->help_needed }}</li>
                <li><strong>จำนวนผู้ป่วย:</strong> {{ $incident->quantity }}</li>
                <li><strong>รายละเอียด:</strong> {{ $incident->description }}</li>
                <li><strong>หมายเลขติดต่อ:</strong> {{ $incident->contact_number }}</li>
            </ul>
            <p>คุณสามารถ <a href="">กลับไปยังหน้าหลัก</a> หรือทำการดำเนินการอื่น ๆ ได้.</p>
        </div>
    </div>
</body>
</html>

<script>
    function initMap() {
        // สร้างแผนที่ Google Maps
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 8
        });

        // ตั้งค่า autocomplete สำหรับ input ที่เลือก
        var input = document.getElementById('location');
        var autocomplete = new google.maps.places.Autocomplete(input);

        // ฟังการเปลี่ยนแปลงตำแหน่งที่เลือก
        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                // ถ้าไม่มีข้อมูลของตำแหน่งที่เลือก
                window.alert("No details available for input: '" + place.name + "'");
                return;
            }

            // ถ้ามีตำแหน่งทางภูมิศาสตร์
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }

            // อัพเดตค่า input ด้วยตำแหน่งที่เลือก
            document.getElementById('location').value = place.formatted_address;
        });
    }

    // เรียกใช้ initMap เมื่อล็อดหน้า
    window.onload = initMap;
</script>

<script>
    document.getElementById('contactForm').addEventListener('submit', function(event) {
        event.preventDefault(); // ป้องกันการส่งฟอร์มแบบดั้งเดิม

        var form = this;
        var actionUrl = form.action;

        // ใช้ Fetch API เพื่อส่งข้อมูลฟอร์ม
        fetch(actionUrl, {
            method: 'POST',
            body: new FormData(form),
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content')
            }
        }).then(function(response) {
            if (response.ok) {
                // แสดง success modal
                $('#successModal').modal('show');

                // หลังจากแสดง modal ซักพัก ให้เปลี่ยนหน้า
                setTimeout(function() {
                    window.location.href = '{{ route('contacts.index') }}';
                }, 2000); // ปรับเวลาตามต้องการ
            } else {
                // จัดการข้อผิดพลาดในการส่งฟอร์ม
                console.error('Form submission failed.');
            }
        }).catch(function(error) {
            console.error('Error:', error);
        });
    });
</script>

//รายการเสร็จสิ้น
<div class="card-body">
    <div class="container-fluid">
        <table id="dataTable" class="table table-bordered table-striped">
           <thead>
                <tr>
                    <th>Case No.</th>
                    <th>รูปภาพ</th>
                    <th>รายละเอียด</th>
                    <th>วันที่แจ้งเหตุ/สถานะ</th>
                    <th>ข้อมูลเพิ่มเติม</th>
                    <th>วันที่เสร็จสิ้น</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($completedIncidents as $incident)
                    <tr>
                        <td>{{ $incident->case_number }}</td>
                        <td>
                            @if ($incident->images)
                                @php
                                    $images = json_decode($incident->images);
                                @endphp
                                @if($images && count($images) > 0)
                                    <img src="{{ asset('images/' . $images[0]) }}" alt="Image" class="img-fluid" style="max-width: 90px;">
                                @endif
                            @endif
                        </td>
                        
                        <td>
                            <span class="badge @if ($incident->help_needed == 'อุบัติเหตุ') bg-danger @elseif($incident->help_needed == 'เจ็บป่วย') bg-warning @else bg-secondary @endif text-white">
                                แจ้ง {{ $incident->help_needed }}
                            </span>
                            <span class="text-muted">ผู้ป่วย {{ $incident->quantity }} คน</span><br>
                            {{ $incident->description }}
                        </td>
                        <td>{{ $incident->created_at->format('d/m/Y') }} <br>
                            <span class="fa-solid fa-circle text-primary"> {{ $incident->status }}</span>
                        </td>
                        <td>{{ $incident->remarks ?? 'ไม่มีข้อมูลเพิ่มเติม' }}</td>
                       
                        <td>{{ $incident->updated_at->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">ไม่มีเหตุการณ์ที่เสร็จสิ้น</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="container-fluid">
    <div style="margin-left: 200px; padding: 20px;">
        <div id="rcorners2">
            <div class="form-group">
                <div class="col-sm-2"></div>
                <div class="col-sm-8" align="left">
                    <h4>Learning Resources</h4>
                    <a href="{{ route('learning-resources.create') }}" class="btn btn-primary">Add New Resource</a>
                    <br><br>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr style="background-color: WhiteSmoke;">
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($learningResources as $resource)
                                    <tr>
                                        <td>{{ $resource->id }}</td>
                                        <td>{{ $resource->title }}</td>
                                        <td>{{ $resource->description }}</td>
                                        <td>
                                            @if ($resource->image)
                                                <img src="{{ asset('images/' . basename($resource->image)) }}" alt="Resource Image" style="max-width: 100px;">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('learning-resources.edit', $resource->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('learning-resources.destroy', $resource->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>