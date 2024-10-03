@extends('layouts.web')

@section('content')

    <h1 class="h3 mb-2 text-gray-800">ข้อมูลการปฏิบัติการ</h1>
    
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">เพิ่มข้อมูล</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('operations.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
            
                <div class="form-group row">
                    <label for="case" class="col-sm-4 text-right">เคส:</label>
                    <div class="col-sm-5">
                        <select name="case" id="case" class="form-control" required>
                            @foreach ($incident as $incident)
                                <option value="{{ $incident->id }}">{{ $incident->case_number }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            
                <div class="form-group row">
                    <label for="user_id" class="col-sm-4 text-right">ผู้บันทึก:</label>
                    <div class="col-sm-5">
                        <!-- แสดงชื่อ member ที่ล็อกอินอยู่ในฟิลด์ input -->
                        <input type="text" class="form-control" value="{{ Auth::guard('member')->user()->username }}" readonly>
                        
                        <!-- เก็บ user_id ของ member ที่ล็อกอินอยู่ในฟิลด์ hidden -->
                        <input type="hidden" name="user_id" value="{{ Auth::guard('member')->id() }}">
                    </div>
                </div>
                
                
                <div class="form-group row">
                    <label for="action_taken" class="col-sm-4 text-right">ข้อมูลการปฏิบัติการ:</label>
                    <div class="col-sm-5">
                        <input type="text" name="action_taken" id="action_taken" class="form-control" required>
                    </div>
                </div>
            
                <div class="form-group row">
                    <label for="details" class="col-sm-4 text-right">รายละเอียด:</label>
                    <div class="col-sm-5">
                        <textarea name="details" id="details" class="form-control"></textarea>
                    </div>
                </div>
            
                <div class="form-group row">
                    <label for="location" class="col-sm-4 text-right">สถานที่:</label>
                    <div class="col-sm-5">
                        <input type="text" name="location" id="location" class="form-control" required>
                    </div>
                </div>
            
                <div class="form-group row">
                    <label for="operation_date" class="col-sm-4 text-right">วันที่:</label>
                    <div class="col-sm-5">
                        <input type="datetime-local" name="operation_date" id="operation_date" class="form-control" required>
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
                        <button type="submit" class="btn btn-primary" id="btn">บันทึก</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">ยกเลิก</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
