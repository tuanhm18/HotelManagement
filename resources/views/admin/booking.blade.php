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
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary float-right">Add</button>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </thead>
                <tbody>
               
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </tfoot>
            </table>
    </section>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 800px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 mt-sm-2">
                            <div class="form-group form-row">
                                <label for="txtFullName"  class="col-sm-5 col-form-label required">First name</label>
                                <div class="col-sm-7">
                                    <input type="text" required class="form-control" id="firstName" name="firstName" maxlength="200">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-sm-2">
                            <div class="form-group form-row">
                                <label for="txtIdCardNumber" class="col-sm-5 col-xl-4 col-form-label required">Last name</label>
                                <div class="col-sm-7 col-xl-8">
                                    <input type="text" class="form-control" required id="lastName" name="lastName" maxlength="30">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mt-sm-2">
                            <div class="form-group form-row">
                                <label for="txtFullName" class="col-sm-5 col-form-label required">Identify number</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" required id="identifyNumber" name="identifyNumber" maxlength="200">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-sm-2">
                            <div class="form-group form-row">
                                <label for="txtIdCardNumber" class="col-sm-5 col-xl-4 col-form-label required">Email</label>
                                <div class="col-sm-7 col-xl-8">
                                    <input required type="email" class="form-control" id="email" name="email" maxlength="30">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
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
</script>
@endsection