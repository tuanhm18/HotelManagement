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
                <button type="button" data-toggle="modal" data-target="#customerModal" class="btn btn-primary float-right">Add</button>
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>FirstName</th>
                        <th>LastName</th>
                        <th>IdentityNumber</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    </tr>
                </tbody>
            </table>
            <div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 800px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="oldIdentity" id="oldIdentity">
                        <div class="modal-body">
                            <form action="post" id="customerForm">
                                <div class="row">
                                    <div class="col-6 form-group form-row">
                                        <label for="firstName" class="col-sm-3 col-form-label required">First Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="firstName" name="FirstName" maxlength="200">
                                        </div>
                                    </div>
                                    <div class="col-6 form-group form-row">
                                        <label for="lastName" class="col-sm-3 col-form-label required">Last Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="lastName" name="LastName" maxlength="200">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 form-group form-row">
                                        <label for="identityNumber" class="col-sm-3 col-form-label required">ID</label>
                                        <div class="col-sm-9">
                                            <input type="text" validIdentity="true" required class="form-control" id="identityNumber" name="IdentityNumber" maxlength="200">
                                        </div>
                                    </div>
                                    <div class="col-6 form-group form-row">
                                        <label for="phone" class="col-sm-3 col-form-label required">Phone</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="phone" name="Phone" maxlength="200">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 form-group form-row">
                                        <label for="email" class="col-sm-1 col-form-label required">Email</label>
                                        <div class="col-sm-11">
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
    $('#customerModal').on('hidden.bs.modal', function() {
        $(this).find("input").val('');
    });

    function edit(id) {
        $.ajax({
            url: "http://localhost/HotelManagement/api/admin/customers/" + id,
            type: "GET",
            success: function(response) {
                $('#id').val(response.data.CUS_ID);
                $('#firstName').val(response.data.FirstName);
                $('#lastName').val(response.data.LastName);
                $('#identityNumber').val(response.data.IdentityNumber);
                $('#phone').val(response.data.Phone);
                $('#email').val(response.data.Email);
                $('#customerModal').modal('show');
                $('#oldIdentity').val(response.data.IdentityNumber);
            }
        })
    }

    function save() {
        var id = $('#id').val();
        var form = $('#customerForm')[0];
        var data = new FormData(form);
        if ($('#customerForm').valid()) {
            if (id > 0) {
                $.ajax({
                    url: "http://localhost/HotelManagement/api/admin/customers/" + id,
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
                        $('#customerModal').modal('hide');
                    },
                    error: function(response) {
                        console.log(response);
                        console.log(response.message);
                    }
                })

            } else {
                $.ajax({
                    url: "http://localhost/HotelManagement/api/admin/customers",
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
                            $('#customerModal').modal('hide');
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
                        url: "http://localhost/HotelManagement/api/admin/customers/" + id,
                        type: "DELETE",
                        success: function(response) {
                            swal({
                                icon: "success",
                                title: "Delete Successfully",
                                text: "Customer deleted successfully!"
                            });
                            loadData();
                            $('#customerModal').modal('hide');
                        }
                    })
                } else {
                    swal("Your imaginary file is safe!");
                }
            });

    }
    $('#customers').addClass("active");

    function loadData() {
        $('#customerTable').DataTable({
            destroy: true,
            ajax: {
                url: "http://localhost/HotelManagement/api/admin/customers",
                method: "GET",
            },
            columns: [{
                    data: "CUS_ID"
                },
                {
                    data: "FirstName"
                },
                {
                    data: "LastName"
                },
                {
                    data: "IdentityNumber"
                },
                {
                    data: "Phone"
                },
                {
                    data: "Email"
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<i class="fas fa-edit text-infor pointer editBtn"  onclick="edit(' + data.CUS_ID + ')"></i>';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<i class="fas fa-trash text-infor pointer deleteBtn" onclick="remove(' + data.CUS_ID + ')"></i>';
                    }
                }
            ]
        });
    }
    $(document).ready(function() {
        loadData();
    });

    // Validate identity 
    jQuery.validator.addMethod("validIdentity", function(value, element) {
        var valid = false;
        var oldIdentity = $('#oldIdentity').val();
        if(oldIdentity == value){
            valid = true;
        } else {
            $.ajax({
            url: "http://localhost/HotelManagement/api/admin/customers-valid/" + value,
            method: "GET",
            async: false,
            success: function(response) {
                console.log(response);
                return valid = response.error;
                }
            });
        }
        return valid;
    }, "This Identity has been taken!");
    
</script>
@endsection