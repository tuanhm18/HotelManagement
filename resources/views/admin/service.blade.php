@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <h3 class="text-center">Service List</h3>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <table id="serviceTable" class="table table-striped table-bordered" style="width:100%">
                <button type="button" data-toggle="modal" data-target="#serviceModal" class="btn btn-primary float-right">Add</button>
                <thead>
                    <tr>
                        <th>Service number</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>

                    </tr>
                </tbody>
            </table>
            <div class="modal fade" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 800px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <input value="0" type="hidden" name="SER_ID" id="ser_id">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 form-group form-row">
                                    <label for="name" class="col-sm-5 col-form-label required">Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="name" name="Name" maxlength="200">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group form-row">
                                    <label for="price" class="col-sm-5 col-form-label required">Price</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" id="price" name="price" maxlength="200">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" onclick="save()" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
@section('js')
<script>
     $('#serviceModal').on('show.bs.modal', function() {
        $(this).find("input").val('');
    });

    function save() {
        var SER_ID = $('#ser_id').val();
        var name = $('#name').val();
        var price = $('#price').val();
        if (SER_ID == 0) {
            $.ajax({
                url: "http://localhost/HotelManagement/api/admin/services",
                type: "POST",
                data: {
                    Name: name,
                    Price: price
                },
                cache: false,
                success: function(response) {
                    swal({
                        icon: "success",
                        title: "Success",
                        text: "Position added successfully!"
                    });
                    loadData();
                    $('#serviceModal').modal('hide');
                },
                error: function(response) {
                    console.log(response);
                }
            })
        }
    }
    
    $('#services').addClass("active");
    function loadData() {
        $('#serviceTable').DataTable({
            destroy: true,
            ajax: {
                url: "http://localhost/HotelManagement/api/admin/services",
                method: "GET",
            },
            columns: [ 
                { data: "SER_ID" },
                { data: "Name" },
                { data: "Price" },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<i class="fas fa-edit text-infor pointer editBtn"  onclick="edit(' + data.SER_ID + ')"></i>';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<i class="fas fa-trash text-infor pointer deleteBtn" onclick="delete(' + data.SER_ID + ')"></i>';
                    }
                }
            ]
        });
    }
    $(document).ready(function() {
        loadData();
    });
</script>
@endsection