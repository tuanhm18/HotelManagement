@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Positions</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Positions</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <h3 class="text-center">Position List</h3>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <table id="positionTable" class="table table-striped table-bordered" style="width:100%">
                <button type="button" data-toggle="modal" data-target="#positionModal" class="btn btn-primary float-right">Add</button>
                <thead>
                    <tr>
                        <th></th>
                        <th>Position ID</th>
                        <th>Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    </tr>
                </tbody>
            </table>
            <div class="modal fade" id="positionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 800px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <input value="0" type="hidden" name="POS_ID" id="pos_id">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 form-group form-row">
                                    <label for="name" class="col-sm-4 col-form-label required">Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="name" name="Name" style="text-transform: capitalize" maxlength="200">
                                    </div>
                                    <div id="validateMessage" class="text-danger col-8 offset-md-4 mt-1"></div>
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
    $('#positionModal').on('hidden.bs.modal', function() {
        $(this).find("input").val('');
        $('#validateMessage').text("");
    });

    function edit(id) {
        $.ajax({
            url: "http://localhost/HotelManagement/api/admin/positions/" + id,
            type: "GET",
            success: function(response) {
                $('#pos_id').val(response.data.POS_ID);
                $('#name').val(response.data.Name);
                $('#positionModal').modal('show');
            }
        })
    }

    function save() {
        var POS_ID = $('#pos_id').val();
        var name = $('#name').val();
        // Bắt đầu kiểm tra dữ liệu đúng hay sai
        $.ajax({    
            url: "http://localhost/HotelManagement/api/admin/positions-validate",
            type: "POST",
            data: {
                Name: name
            },
            success: function(response) {
                if (response.error == 1) { //Dữ liệu nhập sai
                    console.log(response);
                    $('#validateMessage').text(response.message);
                } else {                 // Dữ liệu nhập đúng
                    if (POS_ID == 0) {
                        $.ajax({
                            url: "http://localhost/HotelManagement/api/admin/positions",
                            type: "POST",
                            data: {
                                Name: name
                            },
                            cache: false,
                            success: function(response) {
                                swal({
                                    icon: "success",
                                    title: "Added Successfully",
                                    text: "Position added successfully!"
                                });
                                loadData();
                                $('#positionModal').modal('hide');
                            },
                            error: function(response) {
                                console.log(response);
                            }
                        })
                    } else {
                        $.ajax({
                            url: "http://localhost/HotelManagement/api/admin/positions",
                            type: "PUT",
                            data: {
                                POS_ID: POS_ID,
                                Name: name
                            },
                            success: function(response) {
                                swal({
                                    icon: "success",
                                    title: "Update Successfully",
                                    text: "Position updated successfully!"
                                });
                                loadData();
                                $('#positionModal').modal('hide');
                            },
                            error: function(response) {
                                console.log(response);
                            }
                        })
                    }
                }
            }
        });
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
                        url: "http://localhost/HotelManagement/api/admin/positions/" + id,
                        type: "DELETE",
                        success: function(response) {
                            swal({
                                icon: "success",
                                title: "Delete Successfully",
                                text: "Position deleted successfully!"
                            });
                            loadData();
                            $('#positionModal').modal('hide');
                        }
                    })
                } else {
                    swal("Your imaginary file is safe!");
                }
            });

    }
    $('#positions').addClass("active");

    function loadData() {
        var table = $('#positionTable').DataTable({
            destroy: true,
            ajax: {
                url: "http://localhost/HotelManagement/api/admin/positions",
                method: "GET",
            },
            order: [
                [1, 'asc']
            ],
            columns: [{
                    data: null
                },
                {
                    data: "POS_ID"
                },
                {
                    data: "Name"
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<i class="fas fa-edit text-infor pointer editBtn"  onclick="edit(' + data.POS_ID + ')"></i>';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<i class="fas fa-trash text-infor pointer deleteBtn" onclick="remove(' + data.POS_ID + ')"></i>';
                    }
                }
            ]
        });
        table.on('order.dt search.dt', function() {
            table.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
    }
    $(document).ready(function() {
        loadData();
    });
</script>
@endsection