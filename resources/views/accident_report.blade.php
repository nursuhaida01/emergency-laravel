@extends('layouts.backend')

@section('title', 'รายงานข้อมูลการแจ้งอุบัติเหตุในแต่ละเดือน')

@section('content')

    <h3 class="fw-bold text-center mb-4">สรุปข้อมูลการแจ้งอุบัติเหตุ</h3>

    <div class="container">
        <!-- Date Range Picker -->
        <form method="GET" action="{{ route('incident.report') }}" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="startDate">วันและเวลา:</label>
                        <input type="datetime-local" id="startDate" name="startDate" class="form-control"
                            value="{{ $startDate ? $startDate->format('Y-m-d\TH:i') : '' }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="endDate">ถึง:</label>
                        <input type="datetime-local" id="endDate" name="endDate" class="form-control"
                            value="{{ $endDate ? $endDate->format('Y-m-d\TH:i') : '' }}">
                    </div>
                </div>
                <div class="col-md-2 align-self-end mb-2">
                    <button type="submit" class="btn btn-success btn-block">ค้นหา</button>
                </div>
            </div>
        </form>
        <div class="col-md-4">
            <div class="card text-center shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="text-muted">จำนวนการรับแจ้งเหตุทั้งหมด</h6>
                    <h1>{{ $totalIncidents }}</h1>
                </div>
            </div>
        </div>
        <!-- Summary Cards -->
        <div class="row justify-content-center mb-4">
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
                <div class="card card-stats card-round mb-4">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                    <i class="fas fa-user-check"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">เสร็จสิ้น</p>
                                    <h4 class="card-title">{{ $completedCounts }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="#" class="open-report-link" data-bs-toggle="modal" data-bs-target="#ReportModal">
                           รายงาน
                            <span class="arrow">&rsaquo;</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round mb-4">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-danger bubble-shadow-small">
                                    <i class="fas fa-times-circle"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">ยกเลิก</p>
                                    <h4 class="card-title">{{ $cancelCount }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="#" class="open-report-link" data-bs-toggle="modal" data-bs-target="#completedModal">
                           รายงาน
                            <span class="arrow">&rsaquo;</span>
                        </a>
                    </div>
                </div>
            </div>
            
            
        </div>
        
        
        <!-- Chart -->
        <div class="row justify-content mb-4">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title text-center">ประเภทการแจ้งอุบัติเหตุ</h5>
                        <div id="map" style="height: 400px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title text-center">ประเภทการแจ้งอุบัติเหตุ</h5>
                        <div class="chart-container" style="position: relative;  width:100%">
                            <canvas id="accidentChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- ลิงก์ไปยัง Leaflet.js -->
<!-- ลิงก์ไปยัง Leaflet.js -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<div class="row justify-content mb-4">
    
</div>

<script>
    function initMap() {
        var mapOptions = {
            zoom: 12,
            center: {lat: 6.5586242, lng: 101.2876468} // Bangkok as center point
        };

        var map = new google.maps.Map(document.getElementById('map'), mapOptions);

        // ข้อมูลจุดที่ดึงจากฐานข้อมูล
        var locations = @json($locations);

        // Loop ข้อมูลเพื่อสร้าง Marker บนแผนที่
        locations.forEach(function(location) {
            var marker = new google.maps.Marker({
                position: {lat: parseFloat(location.latitude), lng: parseFloat(location.longitude)},
                map: map,
                title: location.name
            });
        });
    }

    // เรียกใช้งานแผนที่เมื่อโหลดหน้าเสร็จ
    window.onload = initMap;
</script>

    <!-- Modals -->
    <div class="modal fade" id="ReportModal" tabindex="-1" aria-labelledby="completedReportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="completedReportModalLabel">รายงาน: เหตุการณ์ที่เสร็จสิ้น</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="completedReportsContent">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>หมายเลขเคส</th>
                                    <th>สถานที่</th>
                                    <th>รายละเอียด</th>
                                    <th>สถานะ</th>
                                    <th>วันที่เสร็จสิ้น</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($completedIncidents as $incident)
                                    <tr>
                                        <td>{{ $incident->case_number }}</td>
                                        <td>{{ $incident->location }}</td>
                                        <td>{{ $incident->description }}</td>
                                        <td>{{ $incident->status }}</td>
                                        <td>{{ $incident->updated_at ? $incident->updated_at->format('d/m/Y') : '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="completedModal" tabindex="-1" aria-labelledby="completedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="completedModalLabel">รายงาน: เหตุการณ์ที่ยกเลิก</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="completedContent">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>หมายเลขเคส</th>
                                    <th>สถานที่</th>
                                    <th>รายละเอียด</th>
                                    <th>สถานะ</th>
                                    <th>วันที่</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cancelIncidents as $incident)
                                    <tr>
                                        <td>{{ $incident->case_number }}</td>
                                        <td>{{ $incident->location }}</td>
                                        <td>{{ $incident->remarks }}</td>
                                        <td>{{ $incident->status }}</td>
                                        <td>{{ $incident->updated_at ? $incident->updated_at->format('d/m/Y') : '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('accidentChart').getContext('2d');
    
            // ข้อมูลจาก PHP
            var accidentData = [{{ $illnessCount }}, {{ $accidentCount }}, {{ $otherCount }}];
            var accidentLabels = ['เจ็บป่วย', 'อุบัติเหตุ', 'อื่นๆ'];
    
            var accidentChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: accidentLabels,
                    datasets: [{
                        data: accidentData,
                        backgroundColor: [
                            '#FF6384', // สีสำหรับ 'เจ็บป่วย'
                            '#36A2EB', // สีสำหรับ 'อุบัติเหตุ'
                            '#FFCE56', // สีสำหรับ 'อื่นๆ'
                        ],
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    let value = context.raw || 0;
                                    return label + ': ' + value + ' ครั้ง';
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFubb6q1IngaepC2s5UnqcrXQcIhGdbzA&libraries=places"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .chart-container {
            width: 100%;
            max-width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .card {
            border-radius: 10px;
        }

        h1,
        h6 {
            font-weight: 700;
        }

        h1 {
            font-size: 3rem;
            color: #007bff;
        }

        #incidentChart,
        #pieChart {
            max-height: 300px;
        }
        
    </style>

@endsection
