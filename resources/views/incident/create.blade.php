@extends('layouts.fontend')

@section('title', 'Create Incident Report')

@section('content')

    <div class="container mt-2" >
        <!-- แสดงข้อผิดพลาดที่นี่ -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        
        <!-- Modal -->
        <div class="modal fade" id="callModal" tabindex="-1" aria-labelledby="callModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="callModalLabel">คุณต้องการโทรแจ้ง 1669</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        เบอร์โทรคุณ: 0816609400
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                        <a href="tel:1669" class="btn btn-primary">โทร</a>
                    </div>
                </div>
            </div>
        </div>
        
<br>
        <div class="card shadow mb-4" >
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">เพิ่มการแจ้งอุบัติเหตุ</h6>
            </div>
                <div class="card-body">
                    <form id="incidentForm" action="{{ route('incident.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="images" class="col-sm-4 col-form-label text-end">รูปภาพ:</label>
                            <div class="col-sm-3">
                                <input type="file" class="form-control" id="images" name="images[]" multiple>
                            </div>
                        </div>
                        <br>
                        <div class="mb-3 row">
                            <label for="rate" class="col-sm-4 col-form-label text-end">พิกัด:</label>
                            <div class="col-sm-4">
                                <!-- Group button and input field in the same row -->
                                <div class="d-flex">
                                    <!-- ฟิลด์พิกัด -->
                                    <input type="text" name="rate" class="form-control me-2" id="rate" value="{{ old('rate', $incident->rate ?? '') }}" required readonly>
                                    
                                    <!-- ปุ่มแชร์ตำแหน่ง -->
                                    <button type="button" class="btn btn-info" onclick="getLocation()">ตำแหน่ง</button>
                                </div>
                                
                                <!-- Hidden fields for latitude and longitude -->
                                <input type="hidden" name="latitude" id="latitude">
                                <input type="hidden" name="longitude" id="longitude">
                            </div>
                        </div>
                        

                        <script>
                            function getLocation() {
                                if (navigator.geolocation) {
                                    navigator.geolocation.getCurrentPosition(showPosition, showError);
                                } else {
                                    alert("Geolocation is not supported by this browser.");
                                }
                            }

                            function showPosition(position) {
                                var latitude = position.coords.latitude;
                                var longitude = position.coords.longitude;

                                // Update hidden fields
                                document.getElementById('latitude').value = latitude;
                                document.getElementById('longitude').value = longitude;

                                // Update rate field
                                document.getElementById('rate').value = latitude + ', ' + longitude;

                                // Update map link
                                var mapLink = `https://www.google.com/maps?q=${latitude},${longitude}`;
                                console.log(mapLink); // สำหรับการดีบัก
                            }

                            function showError(error) {
                                switch (error.code) {
                                    case error.PERMISSION_DENIED:
                                        alert("User denied the request for Geolocation.");
                                        break;
                                    case error.POSITION_UNAVAILABLE:
                                        alert("Location information is unavailable.");
                                        break;
                                    case error.TIMEOUT:
                                        alert("The request to get user location timed out.");
                                        break;
                                    case error.UNKNOWN_ERROR:
                                        alert("An unknown error occurred.");
                                        break;
                                }
                            }
                        </script>

                        <div class="form-group row">
                            <label for="location" class="col-sm-4 col-form-label text-end">ตำแหน่ง:</label>
                            <div class="col-sm-3">
                                <div class="position-relative">
                                    <input type="text" class="form-control" id="location" name="location"
                                        value="{{ old('location') }}" required>
                                    <span
                                        class="text-danger position-absolute top-50 end-0 translate-middle-y pe-2">*</span>
                                </div>
                            </div>
                        </div>
                        <br>
                            <div class="form-group row">
                                <label for="help_needed" class="col-sm-4 col-form-label text-end">เกี่ยวกับ:</label>
                                <div class="col-sm-5">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="help-option text-center">
                                        <img src="https://img.icons8.com/ios/50/000000/falling-person.png" alt="เจ็บป่วย">
                                        <label>
                                            <input type="radio" id="help_needed_1" name="help_needed" value="เจ็บป่วย" required>
                                            เจ็บป่วย
                                        </label>
                                    </div>
                                    <div class="help-option text-center">
                                        <img src="https://img.icons8.com/ios/50/000000/car-crash.png" alt="อุบัติเหตุ">
                                        <label>
                                            <input type="radio" id="help_needed_2" name="help_needed" value="อุบัติเหตุ" required>
                                            อุบัติเหตุ
                                        </label>
                                    </div>
                                    
                                    <div class="help-option text-center">
                                        <img src="https://img.icons8.com/ios/50/000000/note.png" alt="อื่นๆ">
                                        <label>
                                            <input type="radio" id="help_needed_3" name="help_needed" value="อื่นๆ" required>
                                            อื่นๆ
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                            <!-- ฟิลด์กรอกข้อมูลที่ซ่อนไว้ -->
                            <div id="other_help_info" class="form-group row d-none">
                                <label for="other_info" class="col-sm-4 col-form-label text-end">โปรดระบุ:</label>
                                <div class="col-sm-4">
                                    <input type="text" id="other_info" name="other_info" class="form-control">
                                </div>
                            </div>
                       
                            <br>
                        <div class="form-group row">
                            <label for="quantity" class="col-sm-4 col-form-label text-end">จำนวน:</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="quantity" name="quantity"
                                    value="{{ old('quantity') }}" >
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="description" class="col-sm-4 col-form-label text-end">รายละเอียด:</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="contact_number" class="col-sm-4 col-form-label text-end">เบอร์ติดต่อ:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="contact_number" name="contact_number"
                                    value="{{ old('contact_number') }}" required>
                            </div>
                        </div>
                       
                        <br>
                        <div class="form-group row">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-danger">แจ้งเหตุ</button>
                                
                            </div>
                        </div>
                    </form>

                </div>
         
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">บันทึกข้อมูลสำเร็จ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ข้อมูลของคุณถูกบันทึกเรียบร้อยแล้ว
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const otherInfoField = document.getElementById('other_help_info');
            const otherRadio = document.getElementById('help_needed_3');

            function toggleOtherInfo() {
                if (otherRadio.checked) {
                    otherInfoField.classList.remove('d-none');
                } else {
                    otherInfoField.classList.add('d-none');
                }
            }

            // เรียกใช้ฟังก์ชันเพื่อซ่อนหรือแสดงฟิลด์ตามตัวเลือกที่เลือกในตอนเริ่มต้น
            toggleOtherInfo();

            // เพิ่ม event listener เพื่อเรียกใช้ฟังก์ชันเมื่อมีการเปลี่ยนแปลง
            document.querySelectorAll('input[name="help_needed"]').forEach(radio => {
                radio.addEventListener('change', toggleOtherInfo);
            });
        });
    </script>

    <script>
        function goBack() {
            window.history.back();
        }

        $(document).ready(function() {
            $('#incidentForm').on('submit', function(event) {
                event.preventDefault();
                var formData = new FormData(this);

                // ลบข้อผิดพลาดเก่าก่อน
                $('#incidentForm').find('.alert-danger').remove();

                $.ajax({
                    url: "{{ route('incident.store') }}",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            var successModal = new bootstrap.Modal(document.getElementById(
                                'successModal'));
                            successModal.show();

                            // Hide the modal after 3 seconds
                            setTimeout(function() {
                                successModal.hide();
                                // Clear the form after the modal is hidden
                                $('#incidentForm')[0].reset();
                            }, 3000);

                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON ? xhr.responseJSON.errors : null;
                        if (errors) {
                            var errorList = '';
                            $.each(errors, function(key, value) {
                                errorList += '<li>' + value + '</li>';
                            });
                            var errorDiv = '<div class="alert alert-danger"><ul>' + errorList +
                                '</ul></div>';
                            $('#incidentForm').prepend(errorDiv);
                        } else {
                            alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' + xhr.responseText);
                        }
                    }
                });
            });
        });
    </script>
<style>
    
   

    .help-option img {
        width: 30px;
        height: 30px;
        display: block;
       
    }

   
</style>
@endsection
