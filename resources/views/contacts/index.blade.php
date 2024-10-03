@extends('layouts.backend')

@section('title', 'Contact ')
@section('content')
   
       
            <div class="page-header">
                <h3 class="fw-bold mb-3">DataTables.Net</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Tables</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Datatables</a>
                    </li>
                </ul>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Basic</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">

                            <div class="d-flex justify-content-center">
                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover "
                                        style="width: 100%;" role="grid" aria-describedby="add-row_info">
                                        <thead>
                                            <tr role="row">
                                                <th>ชื่อ</th>
                                                <th>อีเมล</th>
                                                <th>เบอร์</th>
                                                <th>รายละเอียด</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($contacts as $contact)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">{{ $contact->name }}</td>
                                                    <td>{{ $contact->email }}</td>
                                                    <td>{{ $contact->phone }}</td>
                                                    <td>{{ $contact->message }}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
       

       


    @endsection
