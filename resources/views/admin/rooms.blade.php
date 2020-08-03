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
                        <th>Name</th>
                        <th>Position</th>

                    </tr>
                </thead>
                <tbody>

                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>

                    </tr>
                </tfoot>
            </table>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
@section('js')
<script>
    $('#rooms').addClass("active");
    $.ajax({
        type: "GET",
        url: "http://localhost/HotelManagement/api/admin/rooms",
        error: function() {
            console.log("fails");
        },  
        success: function(response) {
            var data = response.data;
            console.log(data);
            $('#roomTable').DataTable({
                columns: [
                    {data: "ROO_ID"},
                    {data: "Status"}
                ]
            });
        },
    });
    $(document).ready(function() {

    });
</script>
@endsection