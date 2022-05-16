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
                  <a href="{{ route('admin#addCategory') }}"><button class="btn btn-sm btn-success">Contact List</button></a>
                </h3>
                <div class="card-tools">
                    <form action="{{ route('admin#contactSearch') }}" method="GET">
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
                      <th>Contact ID</th>
                      <th> Name</th>
                      <th> Email</th>
                      <th> Message</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td>{{$contact->contact_id}}</td>
                            <td>{{$contact->name}}</td>
                            <td>{{$contact->email}}</td>
                            <td>{{$contact->message}}</td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="float-right mt-3 mr-2">{{$contacts->links()}}</div>
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
