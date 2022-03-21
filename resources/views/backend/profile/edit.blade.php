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
                            <h3 class="card-title">Admin <small> Profile</small></h3>
                        </div>
                        <!-- /.card-heaactionder -->
                        <!-- form start -->
                        <form action="{{ route('admin.profile.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Admin User Name</label>
                                                <input
                                                    type="text"
                                                    name="name"
                                                    value="{{ $profile_edit->name}}"
                                                    class="form-control"
                                                    id="exampleInputEmail1"
                                                    placeholder="Enter email">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Admin Email</label>
                                                <input
                                                    type="email"
                                                    name="email"
                                                    value="{{$profile_edit->email}}"
                                                    class="form-control"
                                                    id="exampleInputEmail1"
                                                    placeholder="Enter email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputFile">Avatar</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="profile_photo_path" class="custom-file-input" id="image">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Upload</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <img
                                                id="display_image"
                                                src="{{ (!empty($profile_edit->profile_photo_path)) ? url('upload/admin_images/'.$profile_edit->profile_photo_path) : url('upload/no_image.jpg') }}"
                                                alt=""
                                                style="width:100px; height: 100px">
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
    <!-- /.content -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {

                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#display_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
@endsection
