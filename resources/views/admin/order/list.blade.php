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
                  {{--  <a href="{{ route('admin#addCategory') }}"><button class="btn btn-sm btn-outline-dark">Add Category</button></a>  --}}
                </h3>
                <span class=""><button class="btn btn-sm btn-primary">Total Orders => {{ count($orders) }} </button></span>
                <div class="card-tools">
                    <form action="{{ route('admin#orderSearch') }}" method="GET">
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
                      <th>Customer Name</th>
                      <th>Pizza Name</th>
                      <th>Pizza Count</th>
                      <th>Order Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->customer_name}}</td>
                            <td>{{$order->pizza_name}}</td>
                            <td>{{$order->count}}</td>
                            <td>{{$order->order_time}}</td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="float-right mt-3 mr-2">{{ $orders->links() }}</div>
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
