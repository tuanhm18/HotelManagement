@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">EMPLOYEE</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <h3 class="text-center">Employee List</h3>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <table id="employeeTable" class="table table-striped table-bordered" style="width:100%">
                <button type="button" data-toggle="modal" data-target="#employeeModal" class="btn btn-primary float-right">Add</button>
                <thead>
                    <tr>
                        <th>Employee number</th>
                        <th>Name</th>
                        <th>Identity Number</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Position</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>

                    </tr>
                </tbody>
            </table>
            <div class="modal fade" id="employeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 800px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <input value="0" type="hidden" name="EMP_ID" id="emp_id">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6 form-group form-row">
                                    <label for="name" class="col-sm-5 col-form-label required">Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="name" name="Name" maxlength="200">
                                    </div>
                                </div>
                                <div class="col-6 form-group form-row">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Position</label>
                                    </div>
                                    <select class="custom-select" id="positionSelector">
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6 form-group form-row">
                                    <label for="identityNumber" class="col-sm-5 col-form-label required">Identity Number</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="identityNumber" name="identityNumber" maxlength="200">
                                    </div>
                                    <div id="validateMessage" class="text-danger col-8 offset-md-4 mt-1"></div>
                                </div>
                                <div class="col-6 form-group form-row">
                                    <label for="phone" class="col-sm-5 col-form-label required">Phone</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" id="phone" name="phonr" maxlength="200">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group form-row">
                                    <label for="address" class="col-sm-5 col-form-label required">Address</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="address" name="address" maxlength="200">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group form-row">
                                    <label for="email" class="col-sm-5 col-form-label required">Email</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="email" name="email" maxlength="200">
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
    function loadPosition() {
        $.ajax({
            url: "http://localhost/HotelManagement/api/admin/positions",
            type: 'GET',
            success: function(response) {
                console.log(response);
                response.data.forEach(element => {
                    $('#positionSelector').append("<option value='" + element.POS_ID + "'>" + element.Name + "</option>");
                });
            },
            error: function(response) {
                console.log(response);
            }
        })
    }

    $('#employeeModal').on('show.bs.modal', function() {
        $(this).find("input").val('');
        $('#validateMessage').text("");
    });

    function edit(id) {
        $('#employeeModal').modal('show');
        $.ajax({
            url: "http://localhost/HotelManagement/api/admin/employees/" + id,
            type: "GET",
            success: function(response) {
                $('#emp_id').val(response.data.EMP_ID);
                $('#name').val(response.data.Name);
                $('#identityNumber').val(response.data.IdentityNumber);
                $('#phone').val(response.data.Phone);
                $('#address').val(response.data.Address);
                $('#email').val(response.data.Email);
                $("#positionSelector").val(response.data.POS_ID);
            }
        })
    }

    function save() {
        var EMP_ID = $('#emp_id').val();
        var name = $('#name').val();
        var identityNumber = $('#identityNumber').val();
        var phone = $('#phone').val();
        var address = $('#address').val();
        var email = $('#email').val();
        var position = $('#positionSelector').val();

        $.ajax({
            url: "http://localhost/HotelManagement/api/admin/employees-validate",
            type: "POST",
            data: {
                IdentityNumber: identityNumber,
                EMP_ID: EMP_ID
            },
            success: function(response) {
                if (response.error == 1) { //Dữ liệu nhập sai
                    console.log(response);
                    $('#validateMessage').text(response.message);
                } else {
                    console.log(identityNumber);
                    if (EMP_ID == 0) {
                        $.ajax({
                            url: "http://localhost/HotelManagement/api/admin/employees",
                            type: "POST",
                            data: {
                                EMP_ID: EMP_ID,
                                Name: name,
                                IdentityNumber: identityNumber,
                                Phone: phone,
                                Address: address,
                                Email: email,
                                POS_ID: position
                            },
                            cache: false,
                            success: function(response) {
                                swal({
                                    icon: "success",
                                    title: "Success",
                                    text: "Added successfully!"
                                });
                                loadData();
                                $('#employeeModal').modal('hide');
                            },
                            error: function(response) {
                                console.log(response);
                            }
                        })
                    } else {
                        $.ajax({
                            url: "http://localhost/HotelManagement/api/admin/employees",
                            type: "PUT",
                            data: {
                                EMP_ID: EMP_ID,
                                Name: name,
                                IdentityNumber: identityNumber,
                                Phone: phone,
                                Address: address,
                                Email: email,
                                POS_ID: position
                            },
                            cache: false,
                            success: function(response) {
                                swal({
                                    icon: "success",
                                    title: "Update Successfully",
                                    text: "Updated successfully!"
                                });
                                loadData();
                                $('#employeeModal').modal('hide');
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
                        url: "http://localhost/HotelManagement/api/admin/employees/" + id,
                        type: "DELETE",
                        cache: false,
                        success: function(response) {
                            swal({
                                icon: "success",
                                title: "Delete Successfully",
                                text: "Deleted successfully!"
                            });
                            loadData();
                            $('#employeeModal').modal('hide');
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
    $('#employees').addClass("active");

    function loadData() {
        $('#employeeTable').DataTable({
            destroy: true,
            ajax: {
                url: "http://localhost/HotelManagement/api/admin/employees",
                method: "GET",
            },
            columns: [{
                    data: "EMP_ID"
                },
                {
                    data: "Name"
                },
                {
                    data: "IdentityNumber"
                },
                {
                    data: "Phone"
                },
                {
                    data: "Address"
                },
                {
                    data: "Email"
                },
                {
                    data: "Position"
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<i class="fas fa-edit text-infor pointer editBtn"  onclick="edit(' + data.EMP_ID + ')"></i>';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<i class="fas fa-trash text-infor pointer deleteBtn" onclick="remove(' + data.EMP_ID + ')"></i>';
                    }
                }
            ]
        });
        loadPosition();
    }
    $(document).ready(function() {
        loadData();
    });
</script>
@endsection