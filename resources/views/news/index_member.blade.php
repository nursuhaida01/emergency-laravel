@extends('layouts.fontend')

@section('content')
    <div class="container mt-5">
        <h1>ข่าวสารสำหรับสมาชิก</h1>
        <table id="newsTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>หัวข้อข่าว</th>
                    <th>วันที่เผยแพร่</th>
                    <th>รายละเอียด</th>
                </tr>
            </thead>
            <tbody>
                @foreach($newsItems as $news)
                <tr>
                    <td>{{ $news->title }}</td>
                    <td>{{ $news->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newsModal{{ $news->id }}">รายละเอียด</a>

                        <!-- Modal แสดงรายละเอียดข่าว -->
                        <div class="modal fade" id="newsModal{{ $news->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ $news->title }}</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">{{ $news->content }}</div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
