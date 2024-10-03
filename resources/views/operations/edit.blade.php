@extends('layouts.web')

@section('content')
<div class="container mt-5">
    <h1 class="h3 mb-2 text-gray-800">แก้ไขข้อมูลการปฏิบัตร</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">แก้ไขข้อมูล</h6>
        </div>
        <div class="card-body">
   <form action="{{ route('operations.update', $operation) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group row">
        <label for="case" class="col-sm-4 text-right">เคส:</label>
        <div class="col-sm-5">
            <select name="case" id="case" class="form-control" required>
                @foreach ($incidents as $incident)
                    <option value="{{ $incident->id }}" {{ $operation->case == $incident->id ? 'selected' : '' }}>
                        {{ $incident->case_number}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="user_id" class="col-sm-4 text-right">ผู้บันทึก:</label>
        <div class="col-sm-5">
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $operation->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->username }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="action_taken" class="col-sm-4 text-right">ข้อมูลการปฏิบัติการ:</label>
        <div class="col-sm-5">
            <input type="text" name="action_taken" id="action_taken" class="form-control" value="{{ $operation->action_taken }}" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="details" class="col-sm-4 text-right">รายละเอียด:</label>
        <div class="col-sm-5">
            <textarea name="details" id="details" class="form-control">{{ $operation->details }}</textarea>
        </div>
    </div>

    <div class="form-group row">
        <label for="location" class="col-sm-4 text-right">สถานที่:</label>
        <div class="col-sm-5">
            <input type="text" name="location" id="location" class="form-control" value="{{ $operation->location }}" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="operation_date" class="col-sm-4 text-right">วันที่:</label>
        <div class="col-sm-5">
            <input type="datetime-local" name="operation_date" id="operation_date" class="form-control" value="{{ \Carbon\Carbon::parse($operation->operation_date)->format('Y-m-d\TH:i') }}" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="images" class="col-sm-4 text-right">รูปภาพ:</label>
        <div class="col-sm-5">
            <input type="file" name="images[]" id="images" class="form-control" multiple>
        </div>
    </div>
    
    <div class="form-group row">
        <div class="col-sm-12 text-center">
            <button type="submit" class="btn btn-primary" id="btn">อัปเดต</button>
            <a href="{{ route('operations.index') }}" class="btn btn-secondary">ยกเลิก</a>
        </div>
    </div>
</form>

</div>
@endsection
