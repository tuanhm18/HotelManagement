@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <h3 class="text-center">User List</h3>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <table id="userTable" class="table table-striped table-bordered" style="width:100%">
                <button type="button" data-toggle="modal" data-target="#userModal" class="btn btn-primary float-right">Add</button>
                <thead>
                    <tr>
                        <th></th>
                        <th>Avatar</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    </tr>
                </tbody>
            </table>
            <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 800px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="post" id="userForm">
                                <div class="row text-center justify-content-center">
                                    <div class="col-12 form-group form-row justify-content-center">
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" name="Avatar" class="custom-file-input" id="userAvatar" aria-describedby="inputGroupFileAddon01">
                                                <label class="custom-file-label" for="inputGroupFile01" id="txtFileLabel">Choose file</label>
                                            </div>
                                        </div>
                                        <div id="thumnail">
                                            <img style="width: 200px;
                                        height: 200px;
                                        object-fit: cover;
                                        border-radius: 50%" src="" id="imgPreview" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <input value="0" type="hidden" name="USE_ID" id="use_id">
                                    <div class="col-6 form-group form-row">
                                        <label for="firstName" class="col-sm-4 col-form-label required">First name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="firstName" name="FirstName" style="text-transform: capitalize" maxlength="200">
                                        </div>
                                    </div>
                                    <div class="col-6 form-group form-row">
                                        <label for="lastName" class="col-sm-4 col-form-label required">Last name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="lastName" name="LastName" style="text-transform: capitalize" maxlength="200">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 form-group form-row">
                                        <label for="username" class="col-sm-4 col-form-label required">Username</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="username" name="username" style="text-transform: capitalize" maxlength="200">
                                        </div>
                                    </div>
                                    <div class="col-6 form-group form-row">
                                        <label for="password" class="col-sm-4 col-form-label required">Password</label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" id="password" name="password" style="text-transform: capitalize" maxlength="200">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-group mb-3 col-6 form-group form-row">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="role">Roles</label>
                                        </div>
                                        <select class="custom-select" name="Role" id="role">
                                            <option value="Admin">Admin</option>
                                            <option value="Editor">Editor</option>
                                        </select>
                                    </div>
                                    <div class="input-group mb-3 col-6 form-group form-row">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                        </div>
                                        <select class="custom-select" name="Position" id="position">
                                        </select>
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
    $('#userAvatar').change(function(e) {
        ReadImageUrl(this, "imgPreview", "txtFileLabel");
    })
    $('#users').addClass('active');
    $('#userModal').on('hidden.bs.modal', function() {
        $(this).find("input").val('');
        $('#validateMessage').text("");
        $('#password').prop('disabled', false);
    });
    $('#userModal').on('show.bs.modal', function() {
        $('#password').val('');
    })
    
    function edit(id) {
        $.ajax({
            url: "http://localhost/HotelManagement/api/admin/users/" + id,
            type: "GET",
            success: function(response) {
                console.log(response);
                url = "{{url('/public/data/users')}}" + '/' + response.data.Avatar;
                $('#thumnail').text('');
                $('#thumnail').append( '<img style="width: 200px;' +
                            'height: 200px;' +
                            'object-fit: cover;' +
                            'border-radius: 50%"' +
                            'src="' + url + '" id="imgPreview" alt="">');
                $('#firstName').val(response.data.FirstName);
                $('#use_id').val(response.data.USE_ID);
                $('#lastName').val(response.data.LastName);
                $('#username').val(response.data.username);
                $('#password').prop('disabled', true);
                $("#role option[value='" + response.data.Role + "']").prop("selected", true);
                $('#userModal').modal('show');
            },
            error: function(response) {
                console.log(response);
            }
        });
    }

    function save() {
        var USE_ID = $('#use_id').val();
        var form = $('#userForm')[0];
        var data = new FormData(form);
        // Dữ liệu nhập đúng
        if (USE_ID == 0) {
            $.ajax({
                url: "http://localhost/HotelManagement/api/admin/users",
                method: "POST",
                data: data,
                dataType: 'json',
                //enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(data)
                    swal({
                        icon: "success",
                        title: "Added Successfully",
                        text: "User added successfully!"
                    });
                    loadData();
                    $('#userModal').modal('hide');
                },
                error: function(response) {
                    console.log(response);
                }
            })
        } else {
            $.ajax({
                url: "http://localhost/HotelManagement/api/admin/users/" + USE_ID,
                method: "POST",
                data: data,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    swal({
                        icon: "success",
                        title: "Update Successfully",
                        text: "User updated successfully!"
                    });
                    loadData();
                    $('#userModal').modal('hide');
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
                        url: "http://localhost/HotelManagement/api/admin/users/" + id,
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

    function loadData() {
        var table = $('#userTable').DataTable({
            destroy: true,
            ajax: {
                url: "http://localhost/HotelManagement/api/admin/users",
                method: "GET",
            },
            order: [
                [1, 'asc']
            ],
            columns: [{
                    data: null
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        url = "{{url('/public/data/users')}}" + '/' + data.Avatar;
                        return '<img style="width: 100px;' +
                            'height: 100px;' +
                            'object-fit: cover;' +
                            'border-radius: 50%"' +
                            'src="' + url + '"  alt="">';
                    }
                },
                {
                    data: "FirstName"
                },
                {
                    data: "LastName"
                },
                {
                    data: "username"
                },
                {
                    data: "Role"
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<i class="fas fa-edit text-infor pointer editBtn"  onclick="edit(' + data.USE_ID + ')"></i>';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<i class="fas fa-trash text-infor pointer deleteBtn" onclick="remove(' + data.USE_ID + ')"></i>';
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