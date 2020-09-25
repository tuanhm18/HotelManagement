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
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="oldIden" id="oldIden">
                        <div class="modal-body">
                            <form action="post" id="employeeForm">
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
                                        <select class="custom-select" id="positionSelector" name="POS_ID">
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6 form-group form-row">
                                        <label for="identityNumber" class="col-sm-5 col-form-label required">Identity Number</label>
                                        <div class="col-sm-12">
                                            <input type="text" validIden="true" require class="form-control" id="identityNumber" name="IdentityNumber" maxlength="200">
                                        </div>
                                    </div>
                                    <div class="col-6 form-group form-row">
                                        <label for="phone" class="col-sm-5 col-form-label required">Phone</label>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control" id="phone" name="Phone" maxlength="200">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 form-group form-row">
                                        <label for="address" class="col-sm-5 col-form-label required">Address</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="address" name="Address" maxlength="200">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 form-group form-row">
                                        <label for="email" class="col-sm-5 col-form-label required">Email</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="email" name="Email" maxlength="200">
                                        </div>
                                    </div>
                                </div>
                            </form>
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
        $('positionSelector').text('');
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
    });

    function edit(id) {
        $('#employeeModal').modal('show');
        $.ajax({
            url: "http://localhost/HotelManagement/api/admin/employees/" + id,
            type: "GET",
            success: function(response) {
                $('#id').val(response.data.EMP_ID);
                $('#name').val(response.data.Name);
                $('#identityNumber').val(response.data.IdentityNumber);
                $('#phone').val(response.data.Phone);
                $('#address').val(response.data.Address);
                $('#email').val(response.data.Email);
                $("#positionSelector").val(response.data.POS_ID);
                $('#oldIden').val(response.data.IdentityNumber);
            }
        })
    }

    function save() {
        var id = $('#id').val();
        var form = $('#employeeForm')[0];
        var data = new FormData(form);
        if ($('#employeeForm').valid()) {
            if (id > 0) {
                $.ajax({
                    url: "http://localhost/HotelManagement/api/admin/employees/" + id,
                    type: "POST",
                    data: data,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
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
                        console.log(response.message);
                    }
                })

            } else {
                $.ajax({
                    url: "http://localhost/HotelManagement/api/admin/employees",
                    type: "POST",
                    data: data,
                    cache: false,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.error == 0) {
                            swal({
                                icon: "success",
                                title: "Added Successfully!",
                                text: "Added successfully!"
                            });
                            loadData();
                            $('#employeeModal').modal('hide');
                        } else {
                            swal({
                                icon: "warning",
                                title: "Added Failed!",
                                text: response.message
                            })
                        }
                    },
                    error: function(response) {
                        swal({
                            icon: "warining",
                            title: "Added Failed!",
                            text: response
                        });
                    }
                })
            }
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
    // Validate identity 
    jQuery.validator.addMethod("validIden", function(value, element) {
        var valid = false;
        var oldIdentity = $('#oldIden').val();
        if(oldIdentity == value){
            valid = true;
        } else {
            $.ajax({
            url: "http://localhost/HotelManagement/api/admin/employees-validate/" + value,
            method: "GET",
            async: false,
            success: function(response) {
                console.log(response);
                return valid = response.error;
                }
            });
        }
        return valid;
    }, "This Identity has been taken.");
</script>
@endsection