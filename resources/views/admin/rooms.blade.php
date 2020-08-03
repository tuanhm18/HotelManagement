@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Rooms</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Rooms</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <h3 class="text-center">Room List</h3>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <table id="roomTable" class="table table-striped table-bordered" style="width:100%">
                <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary float-right">Add</button>
                <thead>
                    <tr>
                        <th>Room number</th>
                        <th>Status</th>
                        <th>Number of beds</th>
                        <th>Number of rests</th>
                        <th>Room type name</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>

                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
@section('js')
<script>
    $('#rooms').addClass("active");
    $('#roomTable').DataTable( {
        destroy:true,
        ajax: {
           url:  "http://localhost/HotelManagement/api/admin/rooms",
           method: "GET",
        },
        columns: [
            { data: "ROO_ID" },
            { data: "Status" },
            { data: "NumberOfBeds" },
            { data: "NumberOfRests" },
            { data: "RoomName" },
            { data: "Price" },
        ]
    } );
    $(document).ready(function() {

    });
</script>
@endsection