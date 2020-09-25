@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Blog</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blog</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <h3 class="text-center">Blog List</h3>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <table id="blogTable" class="table table-striped table-bordered" style="width:100%">
                <button type="button" data-toggle="modal" data-target="#blogModal" class="btn btn-primary float-right">Add</button>
                <thead>
                    <tr>
                        <th></th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Hot</th>
                        <th>Published</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
    </section>
    <div class="modal fade" id="blogModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <form method="post" style="background-color: white;" class="p-3" id="blogForm">
                    @csrf
                        <h1 class="text-center mb-3">Add Blog</h1>
                        <input type="hidden" name="id" id="id" value="0">
                        <input type="hidden" id="oldName">
                        <div class="row form-group">
                            <div class="col-6 row">
                                <div class="col-2">
                                    <label for="nf-email" class=" form-control-label">Title</label>
                                </div>
                                <div class="col-10">
                                    <input type="text" id="title" name="Title" required placeholder="Enter title..." class="form-control">
                                </div>
                            </div>
                            <div class="col-6 row">
                                <label for="nf-email" class=" form-control-label">Tag</label>
                                <div class="col-10">
                                    <select name="Tags[]" id="tags" multiple data-live-search="true"></select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nf-email" class="col-3 form-control-label">Category</label>
                            <select name="CAT_ID" id="cat_id" class="col-8" data-live-search="true"></select>
                        </div>
                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Description</label>
                            <textarea name="Description" id="description" class="form-control" placeholder="Enter description.." cols="25" rows="3"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" name="Avatar" class="custom-file-input" id="avatar" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile01" id="txtFileLabel">Choose file</label>
                            </div>
                        </div>
                        <div id="thumnail">
                            <img style="width:100%;" src="" id="imgPreview" alt="">
                        </div>

                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Details</label>
                            <textarea name="Details" id="details" class="form-control" placeholder="Enter details.."></textarea>
                        </div>
                        <div class="row form-group">
                            <div class="col-3 row">
                                <div class="col-3">
                                    <label for="nf-password" class=" form-control-label">Hot</label>
                                </div>
                                <div class="col-9">
                                    <input type="checkbox" checked data-toggle="toggle" id="isHot" name="IsHot" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">
                                </div>
                            </div>
                            <div class="col-6 row">
                                <div class="col-5">
                                    <label for="nf-password" class="form-control-label">Published</label>
                                </div>
                                <div class="col-7">
                                    <input type="checkbox" checked data-toggle="toggle" id="isPublished" name="IsPublished" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">
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
    $('#blog').addClass("active");
    $(document).ready(function() {
        $("#tags").select2({
            tags: true
        });
        $('#example').DataTable();
        $('#details').summernote();
        $('#avatar').change(function(e) {
            ReadImageUrl(this, "imgPreview", "txtFileLabel");
        });
        loadTag();
        loadCategory();
    });

    function loadCategory() {
        $.ajax({
            url: "http://localhost/HotelManagement/api/admin/categories/",
            method: "GET",
            success: function(response) {
                response.data.forEach(element => {
                    $('#cat_id').append('<option value="' + element.CAT_ID + '">#' + element.Name + '</option>');
                });
                $('#cat_id').selectpicker();
            }
        });
    }

    function edit(id) {
        $.ajax({
            url: "http://localhost/HotelManagement/api/admin/blogs/" + id,
            type: "GET",
            success: function(response) {
                $('#id').val(response.data.BLO_ID);
                $('#title').val(response.data.Title);
                $('#description').val(response.data.Description);
                $('#details').summernote('code', response.data.Details);
                response.data.IsPublished == 1 ? $('#isPublished').bootstrapToggle('on') : $('#isPublished').bootstrapToggle('off');
                response.data.IsHot == 1 ? $('#isHot').bootstrapToggle('on') : $('#isHot').bootstrapToggle('off');
                $("#imgPreview").attr('src', "http://localhost/HotelManagement/public/data" + '/blogs/' + response.data.Avatar);
                $('#blogModal').modal('show');
                $('#cat_id').val(response.data.CAT_ID).selectpicker("refresh");
                $.ajax({
                    url: "http://localhost/HotelManagement/api/admin/blogs/tags/" + id,
                    method: "GET",
                    success: function(response) {
                        response.data.forEach(element => {
                            console.log(element.TAG_ID);
                            $("#tags option[value='" + element.TAG_ID + "']").prop("selected", true);
                        });
                        $("#tags").select2({
                            tags: true
                        });
                    },
                    error:function(response) {
                        console.log(response);
                    }
                });
            }
        });
        $('#blogModal').modal('show');
    }

    function loadTag() {
        $.ajax({
            url: "http://localhost/HotelManagement/api/admin/tags",
            method: "GET",
            async: false,
            success: function(response) {
                response.data.forEach(element => {
                    $('#tags').append('<option value="' + element.TAG_ID + '">' + element.Name + '</option>');
                });
            }
        })
    }

    function save() {
        var id = $('#id').val();
        var isPublished = document.getElementById('isPublished').checked ? 1 : 0;
        $('#isPublished').val(isPublished);
        var isHot = document.getElementById('isHot').checked ? 1 : 0;
        $('#isHot').val(isHot);
        var form = $('#blogForm')[0];
        var data = new FormData(form);
        data.append('Details', $('#details').summernote('code'));
        if ($('#blogForm').valid()) {
            if (id > 0) {
                $.ajax({
                    url: 'http://localhost/HotelManagement/api/admin/blogs/' + id,
                    method: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        swal({
                            icon: "success",
                            title: "Updated Successfully",
                            text: "Updated blog successfully!"
                        });
                        loadData();
                        $('#blogModal').modal('hide');
                    },
                    error: function(response) {
                        swal({
                            icon: "warning",
                            title: "Updated Failed!",
                            text: response.message
                        });
                    }
                })
            } else {
                $.ajax({
                    url: 'http://localhost/HotelManagement/api/admin/blogs',
                    method: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        swal({
                            icon: "success",
                            title: "Create Successfully",
                            text: "Create blog successfully!"
                        });
                        loadData();
                        $('#blogModal').modal('hide');
                    },
                    error: function(response) {
                        swal({
                            icon: "warning",
                            title: "Create Failed!",
                            text: response.message
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
                        url: "http://localhost/HotelManagement/api/admin/blog/" + id,
                        type: "DELETE",
                        success: function(response) {
                            swal({
                                icon: "success",
                                title: "Delete Successfully",
                                text: "blog deleted successfully!"
                            });
                            loadData();
                            $('#blogModal').modal('hide');
                        }
                    })
                } else {
                    swal("Your imaginary file is safe!");
                }
            });

    }
    $('#blog').addClass("active");

    function loadData() {
        var table = $('#blogTable').DataTable({
            destroy: true,
            ajax: {
                url: "http://localhost/HotelManagement/api/admin/blogs",
                method: "GET",
            },
            columns: [{
                    data: null
                },
                {
                    data: "Title"
                },
                {
                    data: "Description"
                },
                {
                    data: "IsHot"
                },
                {
                    data: "IsPublished"
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<i class="fas fa-edit text-infor pointer editBtn"  onclick="edit(' + data.BLO_ID + ')"></i>';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<i class="fas fa-trash text-infor pointer deleteBtn" onclick="remove(' + data.BLO_ID + ')"></i>';
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