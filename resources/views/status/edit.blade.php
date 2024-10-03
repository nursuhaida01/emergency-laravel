@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Update Status</h2>
    <form action="{{ route('status.update', $incident->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control">
                <option value="ออกจากฐาน" {{ $incident->status == 'ออกจากฐาน' ? 'selected' : '' }}>ออกจากฐาน</option>
                <option value="ถึงที่เกิดเหตุ" {{ $incident->status == 'ถึงที่เกิดเหตุ' ? 'selected' : '' }}>ถึงที่เกิดเหตุ</option>
                <option value="นำส่ง/ออกจากจุดเกิดเหตุ" {{ $incident->status == 'นำส่ง/ออกจากจุดเกิดเหตุ' ? 'selected' : '' }}>นำส่ง/ออกจากจุดเกิดเหตุ</option>
                <option value="ถึง รพ." {{ $incident->status == 'ถึง รพ.' ? 'selected' : '' }}>ถึง รพ.</option>
                <option value="เสร็จสิ้น" {{ $incident->status == 'เสร็จสิ้น' ? 'selected' : '' }}>เสร็จสิ้น</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
