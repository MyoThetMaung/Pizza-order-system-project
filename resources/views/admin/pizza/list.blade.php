@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-12">
              @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong></strong> {{session('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            <div class="card mt-3">
              <div class="card-header">
                <a href="{{ route('admin#addPizza') }}" class="btn btn-sm btn-outline-dark my-2">Add</a>
                <span class="ml-5"><button class="btn btn-sm btn-primary">Total categories => {{$pizzas->total()}}</button></span>

                <div class="card-tools my-2">
                    <form action="{{ route('admin#pizza') }}" method="POST">
                        @csrf
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="search" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Pizza Name</th>
                      <th>Image</th>
                      <th>Price</th>
                      <th>Publish Status</th>
                      <th>Buy 1 Get 1 Status</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                        @if($emptyStatus == 0)
                          <td colspan="7">
                              <small class='text-muted'>There is no data</small>
                          </td>
                        @else
                        @foreach ($pizzas as $pizza )
                        <tr>
                            <td>{{$pizza->id}}</td>
                            <td>{{$pizza->name}}</td>
                            <td>
                                <img src="{{ asset('uploads/'.$pizza->image) }}" class="img-thumbnail" width="100px">
                            </td>
                            <td>{{$pizza->price}}</td>
                            <td>{{$pizza->publish_status}}</td>
                            <td>{{$pizza->buy_one_get_one_status}}</td>
                            <td>
                                <a href="{{ route('admin#editPizza',$pizza->id) }}"><button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                                <a href="{{ route('admin#deletePizza',$pizza->id) }}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
                                <a href="{{ route('admin#seemorePizza',$pizza->id) }}"><button class="btn btn-sm bg-warning text-white"><i class="fas fa-solid fa-eye"></i></button></a>
                            </td>
                        </tr>
                        @endforeach
                        @endif

                  </tbody>
                </table>
                <div class="float-end m-2">{{$pizzas->links()}}</div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
