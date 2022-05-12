@extends('admin.layout.app')

@section('content')
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <a href="{{ route('admin#addCategory') }}"><button class="btn btn-sm btn-outline-dark">Add Category</button></a>
                </h3>
                <span class="ml-5"><button class="btn btn-sm btn-primary">Total categories => {{$categories->total()}}</button></span>
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong></strong> {{session('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card-tools">
                    <form action="{{ route('admin#searchCategory') }}" method="GET">
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
                      <th>Category Name</th>
                      <th>Product_count</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>
                                @if($category->count == 0)
                                    <a class="badge badge-danger text-decoration-none" >{{$category->count}}</a>
                                @else
                                    <a class="badge badge-success text-decoration-none" href="{{route('admin#categoryItem',$category->id)}}">{{$category->count}}</a>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex">
                                    <form action="/admin/deleteCategory/{{$category->id}}" method="POST">
                                        @csrf
                                        <button class="btn btn-sm bg-danger text-white" type="submit"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                    <a href="/admin/editCategory/{{$category->id}}" class="ml-3">
                                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="float-right mt-3 mr-2">{{$categories->links()}}</div>
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
