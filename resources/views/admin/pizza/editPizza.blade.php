@extends('admin.layout.app')

@section('content')
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-9 offset-3 mt-5">
            <div class="col-md-8">
              <a href="{{route('admin#pizza')}}" class="btn btn-primary btn-sm mb-2 ">Back</a>
              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center">Edit Pizza</legend>
                </div>
                <div class="text-center"><img src="{{asset('/uploads/'.$pizza->image)}}" class="m-2 rounded" width="250px"></div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" method="POST" action="{{route('admin#updatePizza',$pizza->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{old('name',$pizza->name)}}" placeholder="Category Name" name="name" >
                                @error('name')
                                    <div class="alert alert-danger p-1 mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="inputName" name="image" >
                                @error('image')
                                    <div class="alert alert-danger p-1 mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{old('name',$pizza->price)}}" placeholder="Price" name="price" >
                                @error('price')
                                    <div class="alert alert-danger p-1 mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Discount</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{old('name',$pizza->discount_price)}}" placeholder="Discount Price" name="discount_price" >
                                @error('discount_price')
                                    <div class="alert alert-danger p-1 mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <select name="category_id" class="form-select">
                                    <option value="">Choose Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{$pizza->category_id == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="alert alert-danger p-1 mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Publish Status</label>
                            <div class="col-sm-10">
                                <select name="publish_status" class="form-select">
                                    <option value="1" {{$pizza->publish_status == 1 ? 'selected' : ''}}>Published</option>
                                    <option value="0" {{$pizza->publish_status == 0 ? 'selected' : ''}}>Unpublished</option>
                                </select>
                                @error('publish_status')
                                    <div class="alert alert-danger p-1 mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Buy 1 Get 1 status</label>
                            <div class="col-sm-10">
                                <input type="radio" value="1" name="buy_one_get_one_status" {{$pizza->buy_one_get_one_status == 1 ? 'checked' : ''}}> Yes  
                                <input type="radio" value="0" name="buy_one_get_one_status" {{$pizza->buy_one_get_one_status == 0 ? 'checked' : ''}}> No
                                @error('buy_one_get_one_status')
                                    <div class="alert alert-danger p-1 mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Waiting Time</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" value="{{old('waiting_time',$pizza->waiting_time)}}" placeholder="Waiting Time" name="waiting_time" >
                                @error('waiting_time')
                                    <div class="alert alert-danger p-1 mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea name="description" placeholder="Description" class="form-control" cols="30" rows="5">{{old('description',$pizza->description)}}</textarea>
                                @error('description')
                                    <div class="alert alert-danger p-1 mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
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
