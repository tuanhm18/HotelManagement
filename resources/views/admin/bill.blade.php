@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Bills</h1>
                    @if(isset($from))
                    {{$from}}
                    @endif
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Bills</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <h3 class="text-center">Bill List</h3>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <table id="billTable" class="table table-striped table-bordered" style="width:100%">
                <form action="get" id="searchByDateForm">
                    @csrf
                    <div class="row">
                        <div class="col-3 form-group form-row">
                            <label for="name" class="col-sm-4 col-form-label required">Form</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="searchFrom" name="SearchFrom" maxlength="200">
                            </div>
                        </div>
                        <div class="col-3 form-group form-row">
                            <label for="name" class="col-sm-4 col-form-label required">To</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="searchTo" name="SearchTo" maxlength="200">
                            </div>
                        </div>
                        <div class="col-3">
                            <button class="btn btn-primary" onclick="loadData(loadByDate)">Search</button>
                        </div>
                    </div>
                </form>
                <button type="button" data-toggle="modal" data-target="#billModal" class="btn btn-primary float-right">Add</button>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Check-in date</th>
                        <th>Check-out date</th>
                        <th>Price</th>
                        <!-- <th>Employee</th> -->
                        <th>Customer</th>
                        <th>Room</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <div class="modal fade" id="empModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 800px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Employee</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6 form-group form-row">
                                    <label for="name" class="col-sm-4 col-form-label required">Name</label>
                                    <div class="col-sm-8">
                                        <input disabled type="text" class="form-control" id="empName" name="empName" maxlength="200">
                                    </div>
                                </div>
                                <div class="col-6 form-group form-row">
                                    <label for="name" class="col-sm-4 col-form-label required">ID Number</label>
                                    <div class="col-sm-8">
                                        <input disabled type="text" class="form-control" id="empId" name="empId" maxlength="200">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 form-group form-row">
                                    <label for="phone" class="col-sm-4 col-form-label required">Phone</label>
                                    <div class="col-sm-8">
                                        <input disabled type="text" class="form-control" id="empPhone" name="empPhone" maxlength="200">
                                    </div>
                                </div>
                                <div class="col-6 form-group form-row">
                                    <label for="name" class="col-sm-4 col-form-label required">Address</label>
                                    <div class="col-sm-8">
                                        <input disabled type="text" class="form-control" id="empAddress" name="empAddress" maxlength="200">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 form-group form-row">
                                    <label for="name" class="col-sm-4 col-form-label required">Email</label>
                                    <div class="col-sm-8">
                                        <input disabled type="text" class="form-control" id="empEmail" name="empEmail" maxlength="200">
                                    </div>
                                </div>
                                <div class="col-6 form-group form-row">
                                    <label for="name" class="col-sm-4 col-form-label required">Position</label>
                                    <div class="col-sm-8">
                                        <input disabled type="text" class="form-control" id="empPosition" name="empPosition" maxlength="200">
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
            <!-- Customer modal -->
            <div class="modal fade" id="cusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 800px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6 form-group form-row">
                                    <label for="name" class="col-sm-4 col-form-label required">Name</label>
                                    <div class="col-sm-8">
                                        <input disabled type="text" class="form-control" id="cusName" name="cusName" maxlength="200">
                                    </div>
                                </div>
                                <div class="col-6 form-group form-row">
                                    <label for="name" class="col-sm-4 col-form-label required">ID Number</label>
                                    <div class="col-sm-8">
                                        <input disabled type="text" class="form-control" id="cusId" name="cusId" maxlength="200">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 form-group form-row">
                                    <label for="phone" class="col-sm-4 col-form-label required">Phone</label>
                                    <div class="col-sm-8">
                                        <input disabled type="text" class="form-control" id="cusPhone" name="cusPhone" maxlength="200">
                                    </div>
                                </div>
                                <div class="col-6 form-group form-row">
                                    <label for="name" class="col-sm-4 col-form-label required">Email</label>
                                    <div class="col-sm-8">
                                        <input disabled type="text" class="form-control" id="cusEmail" name="cusEmail" maxlength="200">
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
            <!-- Bill Modal -->
            <div class="modal fade" id="billModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 800px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Bill</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <input value="0" type="hidden" name="BIL_ID" id="bil_id">
                        <div class="modal-body">
                            <div class="row">
                                <h4 class="col-sm-12 required text-center text-blue">Customer Info</h4>
                                <div class="col-6 form-group form-row">
                                    <label for="phone" class="col-sm-4 col-form-label required">First name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="firstName" name="firstName" maxlength="200">
                                    </div>
                                </div>
                                <div class="col-6 form-group form-row">
                                    <label for="name" class="col-sm-4 col-form-label required">Last name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="lastName" name="lastName" maxlength="200">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 form-group form-row">
                                    <label for="phone" class="col-sm-4 col-form-label required">ID Number</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="idNumber" name="idNumber" maxlength="200">
                                    </div>
                                </div>
                                <div class="col-6 form-group form-row">
                                    <label for="name" class="col-sm-4 col-form-label required">Phone</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="phone" name="phone" maxlength="200">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group form-row">
                                    <label for="phone" class="col-sm-2 col-form-label required">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email" maxlength="200">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h4 class="col-sm-12 required text-center text-blue">Bill Details Info</h4>
                                <div class="col-6 form-group form-row">
                                    <label for="name" class="datepicker col-sm-4 col-form-label required">Check-in Date</label>
                                    <div class="col-sm-8">
                                        <input type="text" data-toggle="datepicker" class="form-control" id="checkinDate" name="checkinDate" maxlength="200">
                                    </div>
                                </div>
                                <div class="col-6 form-group form-row">
                                    <label for="name" class="col-sm-4 col-form-label required">Check-out Date</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="checkoutDate" name="checkoutDate" maxlength="200">
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                </div>
                                <select class="custom-select" multiple id="roomSelector">
                                </select>
                            </div>
                            <ul class="list-group" id="roomSelected">
                            </ul>

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
    $('#bills').addClass("active");
    var loadAllUrl = "http://localhost/HotelManagement/api/admin/bills";
    var loadByDate = "http://localhost/HotelManagement/api/admin/getBillByDate";
    var currentCusId = 0;
    var currentEmpId = 0;
    $('#searchFrom').datepicker();
    $('#searchTo').datepicker();
    $('#billModal').on('hidden.bs.modal', function() {
        loadRoom();
        $('#firstName').attr("disabled", false);
        $('#lastName').attr("disabled", false);
        $('#idNumber').attr("disabled", false);
        $('#email').attr("disabled", false);
        $('#phone').attr("disabled", false);
        $(this).find("input").val('');
    });
    $('select').on('change', function() {
        $('#roomSelected').text("");
        var values = $('#roomSelector').val();
        values.forEach(element => {
            $('#roomSelected').append('<li class="list-group-item text-primary">' + element + '</li>');
        });
    });

  
    function loadRoom() {
        $('#roomSelected').text("");
        $("#roomSelector").text("");
        $.ajax({
            url: "http://localhost/HotelManagement/api/admin/rooms-available",
            method: "GET",
            success: function(response) {
                
                var output = "";
                response.data.forEach(element => {
                    output += "<option value=" + element.ROO_ID + ">" + element.ROO_ID + "</option>";
                });
                $('#roomSelector').append(output);
            },
            error: function(response) {
                console.log(response);
            }
        })
    }

    function showEmp(id) {
        if (currentEmpId != id) {
            $.ajax({
                url: "http://localhost/HotelManagement/api/admin/employees/" + id,
                method: "GET",
                success: function(response) {
                    $('#empName').val(response.data.Name);
                    $('#empId').val(response.data.IdentityNumber);
                    $('#empPhone').val(response.data.Phone);
                    $('#empAddress').val(response.data.Address);
                    $('#empEmail').val(response.data.Email);
                    $('#empPosition').val(response.data.position.Name);
                    currentEmpId = id;
                }
            });
        }
        $('#empModal').modal('show');
    }

    function showCus(id) {
        if (currentCusId != id) {
            $.ajax({
                url: "http://localhost/HotelManagement/api/admin/customers/" + id,
                method: "GET",
                success: function(response) {
                    $('#cusName').val(response.data.FirstName + " " + response.data.LastName);
                    $('#cusId').val(response.data.IdentityNumber);
                    $('#cusPhone').val(response.data.Phone);
                    $('#cusEmail').val(response.data.Email);
                    currentCusId = id;
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }
        $('#cusModal').modal('show');
    }
    $('#checkinDate').datepicker({
        autoclose: true,
        format: "yyyy/mm/dd",
        calendarWeeks: true,
        todayHighlight: true
    });
    $('#checkoutDate').datepicker({
        autoclose: true,
        format: "yyyy/mm/dd",
        calendarWeeks: true,
        todayHighlight: true
    });

    function edit(id) {
        $.ajax({
            url: "http://localhost/HotelManagement/api/admin/bills/" + id,
            type: "GET",
            success: function(response) {
                $("#bil_id").val(response.data.BIL_ID);
                $('#firstName').attr("disabled", true).val(response.data.customer.FirstName);
                $('#lastName').attr("disabled", true).val(response.data.customer.LastName);
                $('#idNumber').attr("disabled", true).val(response.data.customer.IdentityNumber);
                $('#email').attr("disabled", true).val(response.data.customer.Email);
                $('#phone').attr("disabled", true).val(response.data.customer.Phone);
                $('#checkinDate').val(response.data.CheckInDate);
                $('#checkoutDate').val(response.data.CheckOutDate);
                response.data.roomBills.forEach(element => {
                    console.log(jQuery.inArray(element.ROO_ID, $('roomSelector').val()));
                    if (jQuery.inArray(element.ROO_ID, $('roomSelector').val()) == -1) {
                        var output = "<option value=" + element.ROO_ID + ">" + element.ROO_ID + "</option>";
                        $('#roomSelector').append(output);
                    }
                    $("#roomSelector option[value='" + element.ROO_ID + "']").prop("selected", true);
                    $('#roomSelected').append('<li class="list-group-item text-primary">' + element.ROO_ID + '</li>');
                });
                $("#billModal").modal("show");
            }
        })
        $("#positionModal").modal('show');
    }

    function save() {
        var BIL_ID = $('#bil_id').val();
        var firstName = $('#firstName').val();
        var lastName = $('#lastName').val();
        var identityNumber = $('#idNumber').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var checkinDate = $('#checkinDate').val();
        var checkoutDate = $('#checkinDate').val();
        var rooms = $('#roomSelector').val();
        if (BIL_ID == 0) {
            $.ajax({
                url: "http://localhost/HotelManagement/api/admin/bills",
                type: "POST",
                data: {
                    FirstName: firstName,
                    LastName: lastName,
                    IdentityNumber: identityNumber,
                    Email: email,
                    Phone: phone,
                    CheckInDate: checkinDate,
                    CheckOutDate: checkoutDate,
                    Rooms: rooms
                },
                cache: false,
                success: function(response) {
                    console.log(response);
                    swal({
                        icon: "success",
                        title: "Added Successfully",
                        text: "Position added successfully!"
                    });
                    loadData(loadAllUrl);
                    $('#billModal').modal('hide');
                },
                error: function(response) {
                    console.log(response);
                }
            })
        } else {
            $.ajax({
                url: "http://localhost/HotelManagement/api/admin/bills",
                type: "PUT",
                data: {
                    BIL_ID: BIL_ID,
                    CheckInDate: checkinDate,
                    CheckOutDate: checkoutDate,
                    Rooms: rooms
                },
                cache: false,
                success: function(response) {
                    swal({
                        icon: "success",
                        title: "Updated Successfully",
                        text: "Position updated successfully!"
                    });
                    loadData(loadAllUrl);
                    $('#billModal').modal('hide');
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
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "http://localhost/HotelManagement/api/admin/bills/" + id,
                        type: "DELETE",
                        success: function(response) {
                            swal("Your data file has been deleted!", {
                                icon: "success",
                            });
                            loadData(loadAllUrl);
                            loadRoom();
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

    function loadData(url = null) {
        if (url == null) {
            var form = $('#searchByDateForm')[0];
            var data = new FormData(form);
        }
        var table = $('#billTable').DataTable({
            destroy: true,
            ajax: {
                url: url,
                method: "GET",
                data: data,
                processData: false,
                contentType:false,
                // success: function(response) {
                //     alert(url);
                //     console.log(response);
                // },
                // error: function(response) {
                //     console.log(response);
                // }
            },
            columns: [{
                    data: null
                },
                {
                    data: "CheckInDate"
                },
                {
                    data: "CheckOutDate"
                },
                {
                    data: "Price"
                },
                // {
                //     data: null,
                //     render: function(data, type, row) {
                //         return '<i class="pointer text-primary" onclick="showEmp(' + data.EMP_ID + ')">' + data.employee.Name + '</i>';
                //     }
                // },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<i class="pointer text-primary" onclick="showCus(' + data.CUS_ID + ')">' + data.customer.FirstName + ' ' + data.customer.LastName + '</i>';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        var output = "";
                        data.roomBills.forEach(element => {
                            output += '<i class="pointer text-primary" onclick="showRoom(' + element.ROO_ID + ')">- Room ' + element.ROO_ID + '</i><br/>'
                        });
                        return output;
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<i class="fas fa-edit text-infor pointer editBtn"  onclick="edit(' + data.BIL_ID + ')"></i>';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<i class="fas fa-trash text-infor pointer deleteBtn" onclick="remove(' + data.BIL_ID + ')"></i>';
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
        loadData(loadAllUrl);
        loadRoom();
    });
</script>
@endsection