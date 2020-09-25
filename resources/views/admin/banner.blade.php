@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Banners</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Banners</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <h3 class="text-center">Banner List</h3>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <table id="bannerTable" class="table table-striped table-bordered" style="width:100%">
                <button type="button" data-toggle="modal" data-target="#bannerModal" class="btn btn-primary float-right">Add</button>
                <thead>
                    <tr>
                        <th></th>
                        <th>Avatar</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Published</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    </tr>
                </tbody>
            </table>
            <div class="modal fade" id="bannerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <form id="bannerForm" action="post">
                            @csrf
                                <input type="hidden" id="id">
                                <div class="row">
                                    <div class="col-12 form-group form-row">
                                        <label for="name" class="col-sm-4 col-form-label required" require>Title</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" minlength="3" require id="title" name="Title" style="text-transform: capitalize" maxlength="200">
                                        </div>
                                        <div id="validateMessage" class="text-danger col-8 offset-md-4 mt-1"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 form-group form-row">
                                        <label require for="name" class="col-sm-4 col-form-label required">Description</label>
                                        <div class="col-sm-8">
                                            <textarea type="text" require minlength="3" class="form-control" id="description" name="Description" style="text-transform: capitalize" maxlength="200"></textarea>
                                        </div>
                                        <div id="validateMessage" class="text-danger col-8 offset-md-4 mt-1"></div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" name="Avatar" class="custom-file-input" id="bannerAvatar" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01" id="txtFileLabel">Choose file</label>
                                    </div>
                                </div>
                                <div id="preview">
                                    <img src="" style="width: 100%;" id="imgPreview" alt="">
                                </div>
                                <div class="col-12 form-group form-row mt-3">
                                    <!-- Material checked -->
                                    <label for="numberOfBeds" class="col-sm-4 col-form-label required">Published</label>
                                    <div class="col-sm-8 chekbox-status">
                                        <input type="checkbox" checked data-toggle="toggle" id="isPublished" name="IsPublished" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">
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
    $('#bannerAvatar').change(function(e) {
        ReadImageUrl(this, "imgPreview", "txtFileLabel");
    })
    $(document).ready(function() {
        loadData();
    });
    function edit(id) {
        $.ajax({
            url: "http://localhost/HotelManagement/api/admin/banners/" + id,
            type: "GET",
            success: function(response) {
                console.log(response);
                url = "{{url('/public/data/banners')}}" + '/' + response.data.Avatar;
                $('#preview').text("");
                $('#preview').append('<img id="imgPreview" style="width: 100%;"' +
                    'src="' + url + '"alt="">');
                $('#title').val(response.data.Title);
                $('#id').val(response.data.BAN_ID);
                $('#description').val(response.data.Description);
                response.data.IsPublished == 1 ? $('#isPublished').bootstrapToggle('on') : $('#isPublished').bootstrapToggle('off');
                $('#bannerModal').modal('show');
            },
            error: function(response) {
                console.log(response);
            }
        });
    }

    function save() {
        var id = $('#id').val();
        var isPublished = document.getElementById('isPublished').checked ? 1 : 0;

        $('#isPublished').val(isPublished);
        var form = $('#bannerForm')[0];
        var data = new FormData(form);
            if (id > 0) {
                $.ajax({
                    url: "http://localhost/HotelManagement/api/admin/banners/" + id,
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
                        $('#bannerModal').modal('hide');
                    },
                    error: function(response) {
                        console.log(response);
                    }
                })
            } else {
                $.ajax({
                    url: "http://localhost/HotelManagement/api/admin/banners",
                    method: "POST",
                    data: data,
                    dataType: 'json',
                    //enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        swal({
                            icon: "success",
                            title: "Added Successfully",
                            text: "User added successfully!"
                        });
                        loadData();
                        $('#bannerModal').modal('hide');
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
                        url: "http://localhost/HotelManagement/api/admin/banners/" + id,
                        type: "DELETE",
                        success: function(response) {
                            swal({
                                icon: "success",
                                title: "Delete Successfully",
                                text: "Banner deleted successfully!"
                            });
                            loadData();
                            $('#bannerModal').modal('hide');
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
    $('#banners').addClass("active");

    function loadData() {
        var table = $('#bannerTable').DataTable({
            destroy: true,
            ajax: {
                url: "http://localhost/HotelManagement/api/admin/banners",
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
                        url = "{{url('/public/data/banners')}}" + '/' + data.Avatar;
                        return '<img style="width: 100px;"' +
                            'src="' + url + '"  alt="">';
                    }
                },
                {
                    data: "Title"
                },
                {
                    data: "Description"
                },
                {
                    data: "IsPublished"
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<i class="fas fa-edit text-infor pointer editBtn" onclick="edit(' + data.BAN_ID + ')"></i>';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<i class="fas fa-trash text-infor pointer deleteBtn" onclick="remove(' + data.BAN_ID + ')"></i>';
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
   
</script>
@endsection