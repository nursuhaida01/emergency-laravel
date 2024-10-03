@extends('layouts.web')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ลบผู้ใช้งานระบบ</div>

                <div class="card-body">
                    <p>คุณแน่ใจหรือไม่ที่จะลบผู้ใช้งานระบบนี้?</p>

                    <form action="{{ route('news.destroy', $member->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('คุณแน่ใจหรือไม่ที่จะลบ?')">ลบ</button>
                                <a href="{{ route('news.index') }}" class="btn btn-secondary">ยกเลิก</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
