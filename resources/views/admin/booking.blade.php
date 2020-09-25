@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Booking</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Booking</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <h3 class="text-center">Booking List</h3>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <table id="bookingTable" class="table table-striped table-bordered" style="width:100%">
                <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary float-right">Add</button>
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>IdentityNumber</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>CheckInDate</th>
                        <th>CheckOutDate</th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
    </section>
    <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 800px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input value="0" type="hidden" name="BOO_ID" id="boo_id">
                <div class="modal-body">
                   <form id="bookingForm" action="post">
                   <div class="row">
                        <div class="col-lg-6 mt-sm-2">
                            <div class="form-group form-row">
                                <label for="txtFullName"  class="col-sm-5 col-form-label required">First name</label>
                                <div class="col-sm-7">
                                    <input type="text" required class="form-control" id="firstName" name="FirstName" maxlength="200">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-sm-2">
                            <div class="form-group form-row">
                                <label for="txtIdCardNumber" class="col-sm-5 col-xl-4 col-form-label required">Last name</label>
                                <div class="col-sm-7 col-xl-8">
                                    <input type="text" class="form-control" required id="lastName" name="LastName" maxlength="30">
                                </div>
                            </div>
                        </div>
                    </div>
                   <div class="row">
                        <div class="col-lg-6 mt-sm-2">
                            <div class="form-group form-row">
                                <label for="txtFullName"  class="col-sm-5 col-form-label required">Identity Number</label>
                                <div class="col-sm-7">
                                    <input type="text" required class="form-control" id="identityNumber" name="IdentityNumber" maxlength="200">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-sm-2">
                            <div class="form-group form-row">
                                <label for="txtIdCardNumber" class="col-sm-5 col-xl-4 col-form-label required">Email</label>
                                <div class="col-sm-7 col-xl-8">
                                    <input type="text" class="form-control" required id="email" name="Email" maxlength="30">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mt-sm-2">
                            <div class="form-group form-row">
                                <label for="txtFullName" class="col-sm-5 col-form-label required">Phone</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" required id="phone" name="Phone" maxlength="200">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-sm-2">
                            <div class="form-group form-row">
                                <label for="txtIdCardNumber" class="col-sm-5 col-xl-4 col-form-label required">Check In Date</label>
                                <div class="col-sm-7 col-xl-8">
                                    <input required type="email" class="form-control" id="checkInDate" name="CheckInDate" maxlength="30">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-sm-2">
                            <div class="form-group form-row">
                                <label for="txtIdCardNumber" class="col-sm-5 col-xl-4 col-form-label required">Check Out Date</label>
                                <div class="col-sm-7 col-xl-8">
                                    <input required type="email" class="form-control" id="checkOutDate" name="CheckOutDate" maxlength="30">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-sm-2">
                            <div class="form-group form-row">
                                <label for="txtIdCardNumber" class="col-sm-5 col-xl-4 col-form-label required">Status</label>
                                <div class="col-sm-7 col-xl-8">
                                <input type="checkbox" checked data-toggle="toggle" data-onstyle="success" data-on="Checked" data-off="UnChecked">
                                </div>
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
    <!-- /.content -->
</div>
@endsection
@section('js')
<script>
    $('#booking').addClass("active");
    $(document).ready(function() {
        $('#example').DataTable();
    });
    $('#checkInDate').datepicker();
    $('#checkOutDate').datepicker();
    function edit(id) {
        $('#bookingModal').modal('show');
        $.ajax({
            url: "http://localhost/HotelManagement/api/admin/booking/" + id,
            type: "GET",
            success: function(response) {
                $('#boo_id').val(response.data.BOO_ID);
                $('#identityNumber').val(response.data.IdentityNumber);
                $('#email').val(response.data.Email);
                $('#phone').val(response.data.Phone);
                $('#checkInDate').val(response.data.CheckInDate);
                $('#checkOutDate').val(response.data.CheckOutDate);
                $('#status').val(response.data.Status);
                $('#firstName').val(response.data.FirstName);
                $('#lastName').val(response.data.LastName);
                $('#bookingModal').modal('show');
            }
        })
    }
    
    function save() {
        var BOO_ID = $('#boo_id').val();
        var form = $('#bookingForm')[0];
        var data = new FormData(form);
            $.ajax({
                url: "http://localhost/HotelManagement/api/admin/booking/" + BOO_ID,
                type: "POST",
                data:data,
                dataType:'json',
                processData: false,
                contentType: false,
                success: function(response) {
                    swal({
                        icon: "success",
                        title: "Update Successfully",
                        text: "Booking updated successfully!"
                    });
                    loadData();
                    $('#bookingModal').modal('hide');
                },
                error: function(response) {
                    console.log(response);
                }
            })
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
                        url: "http://localhost/HotelManagement/api/admin/booking/" + id,
                        type: "DELETE",
                        success: function(response) {
                            console.log(response);
                            swal({
                                icon: "success",
                                title: "Delete Successfully",
                                text: "Booking deleted successfully!"
                            });
                            loadData();
                            $('#bookingModal').modal('hide');
                        },
                        error:function(response) {
                            console.log(response);
                        }
                    })
                } else {
                    swal("Your imaginary file is safe!");
                }
            });

    }
    $('#booking').addClass("active");

    function loadData() {
        $('#bookingTable').DataTable({
            destroy: true,
            ajax: {
                url: "http://localhost/HotelManagement/api/admin/booking",
                method: "GET",
            },
            columns: [
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
                    data: "Email"
                },
                {
                    data: "Phone"
                },
                {
                    data: "CheckInDate"
                },
                {
                    data: "CheckOutDate"
                },
                {
                    data: "Status"
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<i class="fas fa-edit text-infor pointer editBtn"  onclick="edit(' + data.BOO_ID + ')"></i>';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<i class="fas fa-trash text-infor pointer deleteBtn" onclick="remove(' + data.BOO_ID + ')"></i>';
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