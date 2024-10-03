<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title', 'Dashboard')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    
    <!-- Custom fonts for this template-->
    <link href="{{ asset('user/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    
    <!-- Custom styles for this template-->
    <link href="{{ asset('user/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('user/css/custom-sidebar.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFubb6q1IngaepC2s5UnqcrXQcIhGdbzA&libraries=places"></script>

    <!-- Custom styles for the sidebar -->
    <style>
        .sidebar-brand-icon {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-icon {
            width: 50px;
            height: auto;
            border-radius: 50%;
        }

        /* เปลี่ยนสีพื้นหลังของ sidebar */
        .sidebar {
            background-color: #000099 !important;
        }

        /* Custom DataTable styles */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.5em 1em;
            background-color: #007bff;
            border: none;
            color: white;
            margin-left: 5px;
            border-radius: 0.25rem;
            transition: background-color 0.3s;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #0056b3;
            color: white;
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 0.25rem;
            padding: 0.5em;
        }

        .dataTables_wrapper .dataTables_length select {
            border-radius: 0.25rem;
            padding: 0.5em;
        }

        table.dataTable {
            width: 100%;
            margin: 0 auto;
            clear: both;
            border-collapse: separate;
            border-spacing: 0;
            font-family: Arial, sans-serif;
            font-size: 14px;
            border: 1px solid #ddd;
        }

        table.dataTable thead th {
            border-bottom: 2px solid #ddd;
            background-color: #f8f9fa;
            color: #333;
            padding: 10px;
        }

        table.dataTable tbody tr {
            background-color: #fff;
            border-bottom: 1px solid #ddd;
        }

        table.dataTable tbody tr:hover {
            background-color: #f1f1f1;
        }

        table.dataTable tbody td {
            padding: 10px;
        }
    </style>
</head>
<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        @include('partials.sidebars')
        <!-- End of Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Topbar -->
                @include('partials.topbars')
                <!-- End of Topbar -->
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('user/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('user/js/sb-admin-2.min.js')}}"></script>
    
    <!-- Page level plugins -->
    <script src="{{ asset('user/vendor/chart.js/Chart.min.js')}}"></script>
    
    <!-- Page level custom scripts -->
    <script src="{{ asset('user/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{ asset('user/js/demo/chart-pie-demo.js')}}"></script>
    
    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true
            });
        });
    </script>
</body>
</html>
