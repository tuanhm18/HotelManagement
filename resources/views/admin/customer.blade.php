@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Customers</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Customers</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <h3 class="text-center">Customer List</h3>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <table id="customerTable" class="table table-striped table-bordered" style="width:100%">
                <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary float-right">Add</button>
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>FirstName</th>
                        <th>LastName</th>
                        <th>IdentityNumber</th>
                        <th>Phone</th>
                        <th>Email</th>
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
    $('#customers').addClass("active");
    $('#customerTable').DataTable( {
        destroy:true,
        ajax: {
           url:  "http://localhost/HotelManagement/api/admin/customers",
           method: "GET",
        },
        columns: [
            { data: "CUS_ID" },
            { data: "FirstName" },
            { data: "LastName" },
            { data: "IdentityNumber" },
            { data: "Email" },
            { data: "Phone" }
        ]
    } );
    $(document).ready(function() {

    });
</script>
@endsection