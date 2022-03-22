@extends('frontend.master')
@section('content')
    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <br>
                    <img
                        src="{{ (!empty($user->profile_photo_path)) ? url('upload/user_images/'. $user->profile_photo_path) : url('upload/no_image.jpg') }}"
                        alt=""
                        class="card-img-top"
                        style="border-radius:50%"
                        height="50%" width="50%">
                    <br><br>
                    <ul class="list-group list-group-flush">
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm btn-block">Home</a>
                        <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                        <a href="{{ route('user.change.password') }}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                        <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
                    </ul>
                </div>
                <div class="col-md-2">

                </div>
                <div class="col-md-6">
                    <div class="card">
                        <h3 class="text-center"><span class="text-danger">Change Password</span> </h3>

                        <div class="card-body">
                            <form action="{{ route('user.password.update') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Current Password</label>
                                    <input
                                        type="password"
                                        id="current_password"
                                        name="oldpassword"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="email">New Password</label>
                                    <input
                                        id="password"
                                        type="password"
                                        name="password"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Confirm Password</label>
                                    <input
                                        id="password_confirmation"
                                        type="password"
                                        name="password_confirmation"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
@endsection

