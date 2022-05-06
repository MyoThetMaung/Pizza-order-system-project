@extends('admin.layout.app')

@section('content')
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-8 offset-2 mt-5">
            <div class="col-md-10">
              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center">User Profile</legend>
                </div>
                <?php
                    function message($message,$type){
                ?>
                    <div class="alert alert-{{$type}} alert-dismissible fade show" role="alert">
                        <strong></strong> {{$message}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                }
                ?>
                @if(session('success'))
                    <?php message(session('success'),'success'); ?>
                @endif
                @if(session('password_number'))
                    <?php message(session('password_number'),'warning'); ?>
                @endif
                @if(session('password_not_match'))
                    <?php message(session('password_not_match'),'warning'); ?>
                @endif
                @if(session('old_password_incorrect'))
                    <?php message(session('old_password_incorrect'),'warning'); ?>
                @endif
            
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" action="{{ route('admin#changePassword',Auth::user()->id)}}" method="POST">
                        @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Old Password</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="old_password" value="">
                            @error('old_password')
                                <div class="alert alert-danger p-1 mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-2 col-form-label">New Password</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="new_password" value="">
                            @error('new_password')
                                <div class="alert alert-danger p-1 mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Confirm Password</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="confirm_password" value="">
                              @error('confirm_password')
                                  <div class="alert alert-danger p-1 mt-1">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                        </div>

                        <div class="form-group row ml-4" >
                            <div class="offset-sm-2 col-sm-10 ">
                              <button type="submit" class="btn bg-success text-white">Change</button>
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
