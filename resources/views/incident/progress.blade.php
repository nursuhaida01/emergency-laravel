@extends('layouts.backend')

@section('title', 'Progress Page')

@section('content')

    <h1 class="h3 mb-4">สถานะการแจ้งเหตุ</h1>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">การดำเนินการล่าสุด</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                   <thead>
                        <tr>
                            <th>Case No.</th>
                                <th>ภาพเหตุการณ์</th>
                                <th>สถานที่</th>
                                <th>รายละเอียดอาการแจ้งเหตุ</th>
                                <th>วันที่แจ้งเหตุ/สถานะ</th>
                                <th>เพิ่มเติม</th>
                                <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($incidents as $incident)
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
                                <td>{{ $incident->rate }} <br>
                                    <span class="text-danger">{{ $incident->location }}</span>
                                </td>
                                <td>
                                    <span class="badge @if ($incident->help_needed == 'อุบัติเหตุ') bg-danger @elseif($incident->help_needed == 'เจ็บป่วย') bg-warning @else bg-secondary @endif text-white">
                                        แจ้ง {{ $incident->help_needed }}
                                    </span>
                                    <span class="text-muted">ผู้ป่วย {{ $incident->quantity }} คน</span><br>
                                    {{ $incident->description }}
                                </td>
                                <td>{{ $incident->created_at->format('d/m/Y') }} <br>
                                    <span class="fa-solid fa-circle text-success"> {{ $incident->status }}</span>
                                </td>
                                <td>{{ $incident->remarks ?? 'ไม่มีข้อมูลเพิ่มเติม' }}</td>
                                <td>
                                    <form action="{{ route('incident.markAsCompleted', $incident->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            เสร็จสิ้น
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
@endsection
