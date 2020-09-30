@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Category</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Category</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <h3 class="text-center">Category List</h3>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <table id="categoryTable" class="table table-striped table-bordered" style="width:100%">
                <button type="button" data-toggle="modal" data-target="#categoryModal" class="btn btn-primary float-right">Add</button>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>

                    </tr>
                </tbody>
            </table>
            <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 800px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <input value="0" type="hidden" name="id" id="id">
                        <div class="modal-body">
                            <form id="categoryForm" action="post">
                                <div class="row">
                                    <div class="col-12  form-group form-row">
                                        <label for="price" class="col-sm-2 col-form-label required">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="name" name="Name" maxlength="200">
                                        </div>
                                        <div id="validateMessage" class="text-danger col-8 offset-md-4 mt-1"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12  form-group form-row">
                                        <label for="price" class="col-sm-2 col-form-label required">Code</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="code" name="Code" maxlength="200">
                                        </div>
                                        <div id="validateMessage" class="text-danger col-8 offset-md-4 mt-1"></div>
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
    $('#categoryModal').on('show.bs.modal', function() {
        $(this).find("input").val('');
        $('#validateMessage').text("");
    });

    function edit(id) {
        $('#categoryModal').modal('show');
        $.ajax({
            url: "http://localhost/HotelManagement/api/admin/category/" + id,
            type: "GET",
            success: function(response) {
                $('#code').val(response.data.Code);
                $('#id').val(response.data.CAT_ID)
                $('#name').val(response.data.Name);
            }
        })
    }

    function save() {
        var id = $('#id').val();
        var form = $('#categoryForm')[0];
        var data = new FormData(form);
        $.ajax({
            url: "http://localhost/HotelManagement/api/admin/categories",
            type: "POST",
            data: data,
            cache: false,
            processData:false,
            contentType: false,
            success: function(response) {
                swal({
                    icon: "success",
                    title: "Success",
                    text: "Category added successfully!"
                });
                loadData();
                $('#categoryModal').modal('hide');
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
                        url: "http://localhost/HotelManagement/api/admin/category/" + id,
                        type: "DELETE",
                        cache: false,
                        success: function(response) {
                            swal({
                                icon: "success",
                                title: "Delete Successfully",
                                text: "Category deleted successfully!"
                            });
                            loadData();
                            $('#categoryModal').modal('hide');
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
    $('#categories').addClass("active");

    function loadData() {
        var table = $('#categoryTable').DataTable({
            destroy: true,
            ajax: {
                url: "http://localhost/HotelManagement/api/admin/categories",
                method: "GET",
            },
            columns: [{
                    data: null
                },
                {
                    data: "Name"
                },
                {
                    data: "Code"
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<i class="fas fa-edit text-infor pointer editBtn"  onclick="edit(' + data.CAT_ID + ')"></i>';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<i class="fas fa-trash text-infor pointer deleteBtn" onclick="remove(' + data.CAT_ID + ')"></i>';
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