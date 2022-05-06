@extends('admin.layout.app')

@section('content')
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-8 offset-3 mt-5">
            <div class="col-md-9">
              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center">User Profile</legend>
                </div>
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong></strong> {{session('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" action="{{ route('admin#updateProfile',$user->id) }}" method="POST">
                        @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Name" value="{{old('name',$user->name)}}">
                          </div>
                        </div>
                        @error('name')
                            <div class="alert alert-danger p-1 mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" placeholder="Email" value="{{old('email',$user->email)}}">
                          </div>
                        </div>
                        @error('email')
                            <div class="alert alert-danger p-1 mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="phone" placeholder="Phone" value="{{old('phone',$user->phone)}}">
                            </div>
                        </div>
                        @error('phone')
                            <div class="alert alert-danger p-1 mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="address" placeholder="Address" value="{{old('address',$user->address)}}">
                            </div>
                        </div>
                        @error('address')
                            <div class="alert alert-danger p-1 mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                        <!-- Button trigger modal -->
                        <a href="{{ route('admin#changePasswordPage') }}">
                            <p  class="text-primary float-end" data-toggle="modal" data-target="#exampleModal">
                                Change Password
                            </p>
                        </a>
                        <div class="form-group row ml-4" >
                            <div class="offset-sm-2 col-sm-10 ">
                              <button type="submit" class="btn bg-success text-white">Update</button>
                            </div>
                        </div>
                    </form>
                    </div>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
