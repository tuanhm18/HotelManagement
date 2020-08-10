@extends('admin.layout.layout')
@section('css')
<style>
    .toggle.btn {
        width: 100% !important;
    }
</style>
@endsection
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
                <button type="button" data-toggle="modal" data-target="#roomModal" class="btn btn-primary float-right">Add</button>
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
            <div class="modal fade" id="roomModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 800px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <input value="0" type="hidden" name="ROO_ID" id="roo_id">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6 form-group form-row">
                                    <label for="numberOfBeds" class="col-sm-4 col-form-label required">Room number</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="numberOfBeds" name="numberOfBeds" maxlength="200">
                                    </div>
                                </div>
                                <div class="col-6 form-group form-row">
                                    <!-- Material checked -->
                                    <label for="numberOfBeds" class="col-sm-4 col-form-label required">Status</label>
                                    <div class="col-sm-8 chekbox-status">
                                    <input type="checkbox" checked data-toggle="toggle" id="status" data-on="Being used" data-off="Available" data-onstyle="danger" data-offstyle="success">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Room type</label>
                                    </div>
                                    <select class="custom-select" id="inputGroupSelect01">
                                    </select>
                                </div>
                                <div class="col-6 form-group form-row">
                                    <label for="price" class="col-sm-4 col-form-label required">Price</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="price" name="price" maxlength="200">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

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
    function loadRoomType() {
        $.ajax({

        })
    }
    $('#roomModal').on('show.bs.modal', function() {
        $(this).find("input").val('');
    });

    function edit(id) {
        $('#roomModal').modal('show');
        $.ajax({
            url: "http://localhost/HotelManagement/api/admin/rooms/" + id,
            type: "GET",
            success: function(response) {
                $('#name').val(response.data.Name);
                $('#price').val(response.data.Price);
                $('#ser_id').val(response.data.SER_ID);
            }
        })
    }

    function save() {
        var ROO_ID = $('#roo_id').val();
        var status = document.getElementById('status').checked ? 1 : 0;
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
        } else {
            $.ajax({
                url: "http://localhost/HotelManagement/api/admin/services",
                type: "PUT",
                data: {
                    Name: name,
                    Price: price,
                    SER_ID: SER_ID
                },
                cache: false,
                success: function(response) {
                    swal({
                        icon: "success",
                        title: "Update Successfully",
                        text: "Servie updated successfully!"
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

    function remove(id) {
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "http://localhost/HotelManagement/api/admin/services/" + id,
                        type: "DELETE",
                        cache: false,
                        success: function(response) {
                            swal({
                                icon: "success",
                                title: "Delete Successfully",
                                text: "Service deleted successfully!"
                            });
                            loadData();
                            $('#serviceModal').modal('hide');
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    })
                } else {
                    swal("Your imaginary file is safe!");
                }
            });
    }

    function loadData() {
        $('#serviceTable').DataTable({
            destroy: true,
            ajax: {
                url: "http://localhost/HotelManagement/api/admin/services",
                method: "GET",
            },
            columns: [{
                    data: "SER_ID"
                },
                {
                    data: "Name"
                },
                {
                    data: "Price"
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<i class="fas fa-edit text-infor pointer editBtn"  onclick="edit(' + data.SER_ID + ')"></i>';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<i class="fas fa-trash text-infor pointer deleteBtn" onclick="remove(' + data.SER_ID + ')"></i>';
                    }
                }
            ]
        });
    }
    $(document).ready(function() {
        loadData();

    });



















    $('#rooms').addClass("active");
    $('#roomTable').DataTable({
        destroy: true,
        ajax: {
            url: "http://localhost/HotelManagement/api/admin/rooms",
            method: "GET",
        },
        columns: [{
                data: "ROO_ID"
            },
            {
                data: "Status"
            },
            {
                data: "NumberOfBeds"
            },
            {
                data: "NumberOfRests"
            },
            {
                data: "RoomName"
            },
            {
                data: "Price"
            },
        ]
    });
    $(document).ready(function() {

    });
</script>
@endsection