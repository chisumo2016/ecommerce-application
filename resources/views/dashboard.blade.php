@extends('frontend.master')
@section('content')
  <div class="body-content">
      <div class="container">
          <div class="row">
              <div class="col-md-2">
                   <br>
                  <img
                      src="{{ (!empty($profile_edit->profile_photo_path)) ? url('upload/admin_images/'.$profile_edit->profile_photo_path) : url('upload/no_image.jpg') }}"
                      alt=""
                      class="card-img-top"
                      style="border-radius:50%"
                      height="100%" width="100%">
                    <br><br>
                    <ul class="list-group list-group-flush">
                        <a href="" class="btn btn-primary btn-sm btn-block">Home</a>
                        <a href="" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                        <a href="" class="btn btn-primary btn-sm btn-block">Change Password</a>
                        <a href="" class="btn btn-danger btn-sm btn-block">Logout</a>
                    </ul>
              </div>
              <div class="col-md-2">

              </div>
              <div class="col-md-6">
                 <div class="card">
                     <h3 class="text-center"><span class="text-danger">Hi ....</span><strong>{{ Auth::user()->name }}</strong>Welcome to Online Shop </h3>
                 </div>
              </div>
          </div>
      </div>

  </div>
@endsection

