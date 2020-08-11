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
                                    <label for="name" class="col-sm-5 col-form-label required">Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="name" name="Name" maxlength="200">
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
    $('#positionModal').on('hidden.bs.modal', function() {
        $(this).find("input").val('');
    });

<<<<<<< HEAD
=======
    function remove(id) {
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
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
                            swal("Your data file has been deleted!", {
                                icon: "success",
                            });
                            loadData();
                        },
                        error: function(response) {
                            swal("Your data is being used! Cannot remove it right now!", {
                                icon: "warning",
                            });
                        }
                    })
                } else {
                    swal("Your imaginary file is safe!");
                }
            });

    }

>>>>>>> 37a64be612f764b6f08c2fb3aae0d140316cfc75
    function edit(id) {
        $.ajax({
            url: "http://localhost/HotelManagement/api/admin/positions/" + id,
            type: "GET",
            success: function(response) {
<<<<<<< HEAD
                $('#pos_id').val(response.data.POS_ID);
                $('#name').val(response.data.Name);
                $('#positionModal').modal('show');
            }
        })
=======
                $("#pos_id").val(response.data.POS_ID);
                $("#name").val(response.data.Name);
                $("#positionModal").modal("show");
            }
        })
        $("#positionModal").modal('show');
>>>>>>> 37a64be612f764b6f08c2fb3aae0d140316cfc75
    }

    function save() {
        var POS_ID = $('#pos_id').val();
        var name = $('#name').val();
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
<<<<<<< HEAD
                success: function(response) {
                    swal({
                        icon: "success",
                        title: "Update Successfully",
=======
                cache: false,
                success: function(response) {
                    swal({
                        icon: "success",
                        title: "Updated Successfully",
>>>>>>> 37a64be612f764b6f08c2fb3aae0d140316cfc75
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
<<<<<<< HEAD

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
=======
>>>>>>> 37a64be612f764b6f08c2fb3aae0d140316cfc75
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
            columns: [
                {data: null},
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