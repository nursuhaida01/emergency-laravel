@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div style="margin-left: 200px; padding: 20px;">
        <div id="rcorners2">
            <div class="form-group">
                <div class="col-sm-2"></div>
                <div class="col-sm-10" align="left">
                    <h4>ข้อมูลการแจ้งเหตุ</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr style="background-color: WhiteSmoke;">
                                    <th>No.</th>
                                    <th>ภาพเหตุการณ์</th>
                                    <th>เวลา</th>
                                    <th>สถานที่</th>
                                    <th>ประเภท</th>
                                    <th>รายละเอียด</th>
                                    <th>เบอร์</th>
                                    <th>Edit</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- วนลูปแสดงข้อมูลการแจ้งเหตุ -->
                                @foreach($incidentReports as $report)
                                <tr>
                                    <td>{{ $report->id }}</td>
                                    <td><img src="{{ $report->image_url }}" style="max-width: 100px;"></td>
                                    <td>{{ $report->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $report->location }}</td>
                                    <td>{{ $report->category }}</td>
                                    <td>{{ $report->description }}</td>
                                    <td>{{ $report->contact_number }}</td>
                                    <td><a href="{{ route('reports.edit', $report->id) }}" class="btn btn-primary btn-sm">แก้ไข</a></td>
                                    <!-- เพิ่มปุ่มลบหรืออื่น ๆ ตามต้องการ -->
                                    <td></td>
                                    <td></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- ลิงก์หน้าเพจ -->
            <div class="pagination">
                {{ $incidentReports->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
