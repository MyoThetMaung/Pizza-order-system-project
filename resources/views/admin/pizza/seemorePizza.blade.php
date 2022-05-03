@extends('admin.layout.app')

@section('content')
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-12 offset-2 mt-5">
            <div class="col-md-8">
              <a href="{{route('admin#pizza')}}" class="btn btn-primary btn-sm mb-2 ">Back</a>
              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center">Detail Info of Pizza</legend>
                </div>
                
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <div class="contine">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <img src="{{asset('/uploads/'.$pizza->image)}}" class="ml-5 mt-5 rounded" width="250px">
                                        </div>
                                        <div class="col-6">
                                            <div>
                                                <p><b>Name</b> : <span>{{$pizza->name}}</span></p>
                                                <p><b>Price</b> : <span>{{$pizza->price}}</span></p>
                                                <p><b>Publish Status</b> : <span>{{$pizza->publish_status == 1 ? 'YES' : 'NO'}}</span></p>
                                                <p><b>Category</b> : <span>{{$pizza->category_id}}</span></p>
                                                <p><b>Discount Price</b> : <span>{{$pizza->discount_price}}</span></p>
                                                <p><b>Buy One Get One Status</b> : <span>{{$pizza->buy_one_get_one_status== 1 ? 'YES' : 'NO'}}</span></p>
                                                <p><b>Waiting Time</b> : <span>{{$pizza->waiting_time}}</span></p>
                                                <p><b>Description</b> : <span>{{$pizza->description}}</span></p>
                                                
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
