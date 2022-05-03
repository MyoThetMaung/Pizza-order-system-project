@extends('admin.layout.app')

@section('content')
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-9 offset-3 mt-5">
            <div class="col-md-8">
              <a href="{{route('admin#category')}}" class="btn btn-primary btn-sm mb-2 ">Back</a>
              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center">Update Category</legend>
                </div>
                @error('name')
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong></strong> {{$message}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @enderror
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" method="POST" action=" {{ route('admin#updateCategory',$category->id) }} ">
                        @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName" value="{{$category->name}}" placeholder="Category Name" name="name" >
                          </div>
                        </div>

                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn bg-dark text-white">Update</button>
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
    </section>
  </div>
@endsection
