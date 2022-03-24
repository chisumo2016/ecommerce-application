@extends('admin.admin_master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card m-4">
                    <div class="card-header">
                        <h3 class="card-title">Create Brand</h3>
                    </div>

                     <form action="{{ route('brand.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Brand Name English</label>
                                        <input
                                            type="text"
                                            name="brand_name_en"
                                            class="form-control"
                                            id="current_password"
                                            placeholder="Enter Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Brand Name Tanzania</label>
                                        <input
                                            type="text"
                                            name="brand_name_tz "
                                            class="form-control"
                                            id="current_password"
                                            placeholder="Enter Password">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Upload Brand Image</label>
                                        <input
                                            type="file"
                                            name="image"
                                            class="form-control"
                                            id="current_password"
                                            placeholder="Enter Password">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" value="update">Create Brand</button>
                                </div>
                            </form>
                </div>
                <!-- /.card -->
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>

@endsection
