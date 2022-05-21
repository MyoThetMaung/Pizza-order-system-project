@extends('user.layout.style')

@section('content')
<div class="row mt-5 d-flex justify-content-center">

    <div class="col-4 ">
        <img src="{{asset('uploads/'.$pizzaInfo[0]['image'])}}" class="img-thumbnail" width="100%"> <br>
        <a href="{{route('user#index')}}">
            <button class="btn bg-dark text-white" style="margin-top: 20px;">
                <i class="fas fa-backspace"></i> Back
            </button>
        </a>
    </div>

    <div class="col-6">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong></strong> {{session('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <h5>Name</h5>
        <small>{{$pizzaInfo[0]['name']}}</small> <hr>

        <h5>Price</h5>
        <small>{{$pizzaInfo[0]['price'] - $pizzaInfo[0]['discount_price'] . ' kyats'}}</small> <hr>

        <h5>Waiting Time</h5>
        <small>{{$pizzaInfo[0]['waiting_time']}}</small> <hr>

        <h5>Description</h5>
        <small>{{$pizzaInfo[0]['description']}}</small> <hr>

        <form action="{{ route('user#placeOrder') }}" method="POST">
            @csrf
            <h5>Pizza Count</h5>
            <input type="text" class="form-control shadow-none" name="pizzaCount" placeholder="Number of Pizza">
            @error('pizzaCount')
                <div class="alert alert-danger p-1">
                    {{ $message }}
                </div>
            @enderror <hr>
            <h5>Payment</h5>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="paymentType" id="inlineRadio1" value="1">
                <label class="form-check-label" for="inlineRadio1">Credit Card</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="paymentType" id="inlineRadio2" value="2">
                <label class="form-check-label" for="inlineRadio2">Cash</label>
            </div>
            @error('paymentType')
                <div class="alert alert-danger p-1">
                    {{ $message }}
                </div>
            @enderror <hr>
            <button class="btn btn-primary mt-2 p-2 col-12"><i class="fas fa-shopping-cart"></i> Place Order</button>
        </form>
    </div>
</div>

@endsection
