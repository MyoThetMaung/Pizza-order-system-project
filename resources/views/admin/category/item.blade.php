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
                  <button class="btn btn-sm btn-success">Category = {{strtoupper($pizzas[0]['category_name'])}}</button>
                </h3>
                <span class="ml-5 float-end"><button class="btn btn-sm btn-success">Total pizzas => {{$pizzas->total()}}</button></span>
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong></strong> {{session('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>Pizza ID</th>
                      <th>Pizza Name</th>
                      <th>Image</th>
                      <th>Price</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($pizzas as $pizza)
                        <tr>
                            <td>{{$pizza->id}}</td>
                            <td>{{$pizza->name}}</td>
                            <td>
                                <img src="{{asset('uploads/'.$pizza->image)}}" width="200px" >
                            </td>
                            <td>{{$pizza->price}}</td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="float-right mt-3 mr-2">{{$pizzas->links()}}</div>
            </div>
            <!-- /.card-body -->
        </div>
        <a href="{{route('admin#category')}}" class="btn btn-sm btn-primary mb-3">Back</a>
            <!-- /.card -->
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
