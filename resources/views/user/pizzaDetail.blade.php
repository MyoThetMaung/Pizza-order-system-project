@extends('user.layout.style')

@section('content')
<div class="row mt-5 d-flex justify-content-center">

    <div class="col-4 ">
        <img src="{{asset('uploads/'.$pizza[0]['image'])}}" class="img-thumbnail" width="100%">  <br>
        <a href="{{ route('user#order') }}"><button class="btn btn-primary float-end mt-2 col-12"><i class="fas fa-shopping-cart"></i> Order</button></a>
        <a href="{{route('user#index')}}">
            <button class="btn bg-dark text-white" style="margin-top: 20px;">
                <i class="fas fa-backspace"></i> Back
            </button>
        </a>
    </div>
    <div class="col-6">
        <h5>Name</h5>
        <small>{{$pizza[0]['name']}}</small> <hr>

        <h5>Price</h5>
        <small>{{$pizza[0]['price']}} kyats</small> <hr>

        <h5>Discount Price</h5>
        <small>{{$pizza[0]['discount_price']}} kyats</small> <hr>

        <h5>Buy 1 Get 1</h5>
        @if($pizza[0]['buy_one_get_one_status'] == '1')
            <small>Yes</small> <hr>
        @else
            <small>No</small> <hr>
        @endif

        <h5>Waiting Time</h5>
        <small>{{$pizza[0]['waiting_time']}}</small> <hr>

        <h5>Description</h5>
        <small>{{$pizza[0]['description']}}</small> <hr>

        <h1 class="text-success">Total</h1>
        <p class="text-success">{{$pizza[0]['price'] - $pizza[0]['discount_price'] . ' kyats'}}</p>
    </div>
</div>

@endsection
