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
            <h3 class="text-center">Room Type List</h3>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <table id="roomTypeTable" class="table table-striped table-bordered" style="width:100%">
                <button type="button" data-toggle="modal" data-target="#roomTypeModal" class="btn btn-primary float-right">Add</button>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Number Of Beds</th>
                        <th>Number Of Rests</th>
                        <th>Price</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>

                    </tr>
                </tbody>
            </table>
            <div class="modal fade" id="roomTypeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 800px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <input value="0" type="hidden" name="RTYP_ID" id="rtyp_id">
                        <div class="modal-body">
                        <div class="row">
                                <div class="col-6 form-group form-row">
                                    <label for="price" class="col-sm-4 col-form-label required">Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="name" name="name" maxlength="200">
                                    </div>
                                </div>
                                <div class="col-6 form-group form-row">
                                    <label for="price" class="col-sm-4 col-form-label required">Price</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="price" name="price" maxlength="200">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 form-group form-row">
                                    <label for="numberOfBeds" class="col-sm-4 col-form-label required">Number Of Beds</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="numberOfBeds" name="NumberOfBeds" maxlength="200">
                                    </div>
                                </div>
                                <div class="col-6 form-group form-row">
                                    <label for="numberOfRests" class="col-sm-5 col-form-label required">Number Of Rests</label>
                                    <div class="col-sm-7">
                                        <input type="number" class="form-control" id="numberOfRests" name="numberOfRests" maxlength="200">
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
    $('#roomTypeModal').on('show.bs.modal', function() {
        $(this).find("input").val('');
    });

    function edit(id) {
        $('#roomTypeModal').modal('show');
        $.ajax({
            url: "http://localhost/HotelManagement/api/admin/roomtype/" + id,
            type: "GET",
            success: function(response) {
                $('#numberOfBeds').val(response.data.NumberOfBeds);
                $('#numberOfRests').val(response.data.NumberOfRests);
                $('#price').val(response.data.Price);
                $('#rtyp_id').val(response.data.RTYP_ID)
                $('#name').val(response.data.Name);
            }
        })
    }

    function save() {
        var RTYP_ID = $('#rtyp_id').val();
        var numberOfBeds = $('#numberOfBeds').val();
        var numberOfRests = $('#numberOfRests').val();
        var price = $('#price').val();
        var name = $('#name').val();
        if (RTYP_ID == 0) {
            $.ajax({
                url: "http://localhost/HotelManagement/api/admin/roomtype",
                type: "POST",
                data: {
                    Name: name,
                    NumberOfBeds: numberOfBeds,
                    NumberOfRests: numberOfRests,
                    Price: price
                },
                cache: false,
                success: function(response) {
                    swal({
                        icon: "success",
                        title: "Success",
                        text: "Room Type added successfully!"
                    });
                    loadData();
                    $('#roomTypeModal').modal('hide');
                },
                error: function(response) {
                    console.log(response);
                }
            })
        } else {
            $.ajax({
                url: "http://localhost/HotelManagement/api/admin/roomtype",
                type: "PUT",
                data: {
                    Name:name,
                    NumberOfBeds: numberOfBeds,
                    NumberOfRests: numberOfRests,
                    Price: price,
                    RTYP_ID: RTYP_ID
                },
                cache: false,
                success: function(response) {
                    swal({
                        icon: "success",
                        title: "Update Successfully",
                        text: "Room Type updated successfully!"
                    });
                    loadData();
                    $('#roomTypeModal').modal('hide');
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
                        url: "http://localhost/HotelManagement/api/admin/roomtype/" + id,
                        type: "DELETE",
                        cache: false,
                        success: function(response) {
                            swal({
                                icon: "success",
                                title: "Delete Successfully",
                                text: "Room Type deleted successfully!"
                            });
                            loadData();
                            $('#roomTypeModal').modal('hide');
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
    $('#roomtype').addClass("active");

    function loadData() {
        $('#roomTypeTable').DataTable({
            destroy: true,
            ajax: {
                url: "http://localhost/HotelManagement/api/admin/roomtype",
                method: "GET",
            },
            columns: [
                
                {data: "Name"},
                { data: "NumberOfBeds"},
                { data: "NumberOfRests"},
                { data: "Price"},
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<i class="fas fa-edit text-infor pointer editBtn"  onclick="edit(' + data.RTYP_ID + ')"></i>';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<i class="fas fa-trash text-infor pointer deleteBtn" onclick="remove(' + data.RTYP_ID + ')"></i>';
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