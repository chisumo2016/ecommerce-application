@extends('admin.admin_master')
@section('admin_content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Admin <small> Change Password</small></h3>
                        </div>
                        <!-- /.card-heaactionder -->
                        <!-- form start -->
                        <form action="{{ route('update.change.password') }}" method="post" >
                            @csrf
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Current Password</label>
                                                <input
                                                    type="password"
                                                    name="old_password"
                                                    class="form-control"
                                                    id="current_password"
                                                    placeholder="Enter email">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">New Password</label>
                                                <input
                                                    type="password"
                                                    name="password"
                                                    class="form-control"
                                                    id="password"
                                                    placeholder="Enter email">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Confirm Password</label>
                                                <input
                                                    type="password"
                                                    name="password_confirmation"
                                                    class="form-control"
                                                    id="password_confirmation"
                                                    placeholder="Enter email">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" value="update">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content --
@endsection
