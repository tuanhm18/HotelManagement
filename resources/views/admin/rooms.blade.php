@extends('admin.layout.layout')
@section('css')
<style>
    .toggle.btn {
        width: 100% !important;
    }

    .error {
        color: red;
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
                        <th>Number of beds</th>
                        <th>Number of rests</th>
                        <th>Room type name</th>
                        <th>Price</th>
                        <th>Hot</th>
                        <th>Available</th>
                        <th>Edit</th>
                        <th>Delete</th>
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
                        <input type="hidden" value="1" id="isAdd">
                        <div class="modal-body">
                            <form action="post" id="roomForm">
                                <div class="row">
                                    <div class="col-6 form-group form-row">
                                        <label for="numberOfBeds" class="col-sm-4 col-form-label required">Room number</label>
                                        <div class="col-sm-8">
                                            <input type="number" validRoomId="true" required class="form-control" id="roo_id" name="ROO_ID" maxlength="200">
                                        </div>
                                    </div>
                                    <div class="col-6 form-group form-row">
                                    <label for="numberOfBeds" class="col-sm-4 col-form-label required">Status</label>
                                        <div class="col-sm-8 chekbox-status">
                                            <input type="checkbox" checked data-toggle="toggle" name="Status" id="status" data-on="Available" data-off="Being used" data-onstyle="success" data-offstyle="danger">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">Room type</label>
                                        </div>
                                        <select class="custom-select" name="RTYP_ID" id="roomTypeSelector">
                                        </select>
                                    </div>
                                    <div class="col-6 form-group form-row">
                                        <!-- Material checked -->
                                        <label for="numberOfBeds" class="col-sm-4 col-form-label required">Hot</label>
                                        <div class="col-sm-8 chekbox-status">
                                            <input type="checkbox" checked data-toggle="toggle" name="IsHot" id="isHot" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="custom-file">
                                        <input type="file" name="Images[]" multiple class="custom-file-input" id="roomImages">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div id="preview"></div>
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
    function loadRoomType() {
        $('#roomTypeSelector').text('');
        $.ajax({
            url: "http://localhost/HotelManagement/api/admin/roomtype",
            type: 'GET',
            success: function(response) {
                response.data.forEach(element => {
                    $('#roomTypeSelector').append("<option value='" + element.RTYP_ID + "'>" + element.Name + "</option>");
                });
            }
        })
    }
    $('#roomModal').on('hidden.bs.modal', function() {
        $(this).find("input").val('');
        $('#roo_id').attr("disabled", false);
        $('#preview').text('');
        $('#isAdd').val(1);
    });

    function edit(id) {
        $('#roomModal').modal('show');
        $.ajax({
            url: "http://localhost/HotelManagement/api/admin/rooms/" + id,
            type: "GET",
            success: function(response) {
                response.data.Images.forEach(element => {
                    url = "{{url('/public/data/rooms')}}" + '/' + element.Image;
                    $('#preview').append('<img style="height: 100px;"' +
                        'src="' + url + '"alt="">');
                });
                $('#roo_id').attr("disabled", true);
                $('#isAdd').val(0);
                $('#roo_id').val(response.data.ROO_ID);
                response.data.Status == 1 ? $('#status').bootstrapToggle('on') : $('#status').bootstrapToggle('off');
                response.data.IsHot == 1 ? $('#isHot').bootstrapToggle('on') : $('#isHot').bootstrapToggle('off');
                $("#roomTypeSelector").val(response.data.RTYP_ID);
            }
        })
    }

    function save() {
        var ROO_ID = $('#roo_id').val();
        var status = document.getElementById('status').checked ? 1 : 0;
        var roomType = $('#roomTypeSelector').val();
        var isHot = document.getElementById('isHot').checked ? 1 : 0;
        $('#status').val(status);
        $('#isHot').val(isHot);
        var form = $('#roomForm')[0];
        var data = new FormData(form);
        
        if ($('#isAdd').val() == 1) {
            $.ajax({
                url: "http://localhost/HotelManagement/api/admin/rooms",
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
                            text: "Room added successfully!"
                        });
                        loadData();
                        $('#roomModal').modal('hide');
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
        } else {
            $.ajax({
                url: "http://localhost/HotelManagement/api/admin/rooms/" + ROO_ID,
                type: "POST",
                data: data,
                cache: false,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    swal({
                        icon: "success",
                        title: "Update Successfully",
                        text: "Room updated successfully!"
                    });
                    loadData();
                    $('#roomModal').modal('hide');
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
                        url: "http://localhost/HotelManagement/api/admin/rooms/" + id,
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
                            console.log(response.message);
                            swal({
                                icon: "warning",
                                title: "Delete failed!",
                                text: "Data is being used!"
                            });
                        }
                    })
                } else {
                    swal("Your imaginary file is safe!");
                }
            });
    }

    function loadData() {
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
                {
                    data: null,
                    render: function(data, type, row) {
                        return data.IsHot == 1 ? '<i class="fas fa-check text-success"></>' : "";
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return data.Status == 1 ? '<i class="fas fa-check text-success"></i>' : "";
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<i class="fas fa-edit text-infor pointer editBtn"  onclick="edit(' + data.ROO_ID + ')"></i>';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<i class="fas fa-trash text-infor pointer deleteBtn" onclick="remove(' + data.ROO_ID + ')"></i>';
                    }
                }
            ]
        });
        loadRoomType();
    }
    $(document).ready(function() {
        loadData();
    });


    document.querySelector('#roomImages').onchange = function() {
        $('#preview').text('');
        var preview = document.querySelector('#preview');
        [].forEach.call(this.files, function(file) {
            if (/image\/.*/.test(file.type)) { // use any image format the browser can read
                var img = new Image;
                img.onload = remURL; // to remove Object-URL after use
                img.style.height = "100px"; // use style, "width" defaults to "auto"
                img.src = (URL || webkitURL).createObjectURL(file);
                preview.appendChild(img); // add image to preview container
            }
        });

        function remURL() {
            (URL || webkitURL).revokeObjectURL(this.src)
        }
    };
    $('#rooms').addClass("active");
    // Validate room id
    jQuery.validator.addMethod("validRoomId", function(value, element) {
        var valid = false;
        $.ajax({
            url: "http://localhost/HotelManagement/api/admin/rooms-valid/" + value,
            method: "GET",
            async: false,
            success: function(response) {
                return valid = response.error;
            }
        });
        return valid;
    }, "This Id has been taken!");
    $('#roo_id').focusout(function() {
        $('#roo_id').valid();
    })
</script>
@endsection