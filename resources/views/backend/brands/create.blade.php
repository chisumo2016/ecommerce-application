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
                                        <label for="exampleInputEnglish">Brand Name English <span class="text-danger">*</span></label>
                                        <input
                                            type="text"
                                            name="brand_name_en"
                                            class="form-control"
                                            id="brand_name_en"
                                            placeholder="Enter Brand Name English">
                                        @error('brand_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputTanzania">Brand Name Tanzania <span class="text-danger">*</span></label>
                                        <input
                                            type="text"
                                            name="brand_name_tz"
                                            class="form-control"
                                            id="brand_name_tz"
                                            placeholder="Enter Brand Name Tanzania" />
                                            @error('brand_name_tz')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputImage">Upload Brand Image <span class="text-danger">*</span></label>
                                        <input
                                            type="file"
                                            name="image"
                                            class="form-control"
                                            id="brand_image"
                                            placeholder="Avatar">
                                            @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
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
