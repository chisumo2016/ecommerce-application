@extends('admin.admin_master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Display Brand List</h3>
                        <a href="{{ route('brand.create') }}" class="btn btn-primary float-right" style="">create brand</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Brand En</th>
                                <th>Brand Tz</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($brands as $brand)
                                <tr>
                                    <td>{{$brand->brand_name_en}}</td>
                                    <td>{{$brand->brand_name_tz}}</td>
                                    <td>
                                        <img
                                            src="{{ asset($brand->image) }}"
                                            style="width:70px; height:40px;"
                                            alt="">
                                    </td>
                                    <td>
                                        <a href="{{ route('brand.edit', $brand) }}" class="btn btn-info">Edit</a>
                                        <a href="" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>

@endsection
