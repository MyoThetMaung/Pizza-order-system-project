
@extends('user.layout.style')

@section('content')


    <!-- Page Content-->
    <div class="container px-4 px-lg-5" id="home">
        <!-- Heading Row-->
        <div class="row gx-4 gx-lg-5 align-items-center my-5">
            <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" id="code-lab-pizza" src="https://www.pizzamarumyanmar.com/wp-content/uploads/2019/04/chigago.jpg" alt="..." /></div>
            <div class="col-lg-5">
                <h1 class="font-weight-light" id="about">SAIMON Pizza</h1>
                <p>This is a template that is great for small businesses. It doesn't have too much fancy flare to it, but it makes a great use of the standard Bootstrap core components. Feel free to use this template for any project you want!</p>
                <a class="btn btn-primary" href="#!">Enjoy!</a>
            </div>
        </div>

        <!-- Content Row-->
        <div class="d-flex ">
            <div class="col-3 me-5">
                <div class="">
                    <div class="py-5 text-center">
                        <form class="d-flex m-5" method="GET" action="{{route('user#searchPizza')}}">
                            @csrf
                            <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-dark" type="submit">Search</button>
                        </form>

                        <div class="">
                                <a href="{{route('user#index')}}" class="text-decoration-none btn btn-sm btn-success"><h5 class="m-1">All</h5></a>
                            @foreach ($categories as $category)
                                <a href="{{route('user#categorySearch',$category->id)}}" class="text-decoration-none"><div class="m-2 p-2">{{$category->name}}</div></a>
                            @endforeach
                        </div>
                        <hr>
                        <form action="{{route('user#searchDatePrice')}}" method="GET">
                            @csrf
                            <div class="text-center m-4 p-2">
                                <h3 class="mb-3">Start Date - End Date</h3>
                                <input type="date" name="start_date" id="" class="form-control"> -
                                <input type="date" name="end_date" id="" class="form-control">
                            </div>
                            <hr>
                            <div class="text-center m-3 p-2">
                                <h3 class="mb-3">Min - Max Amount</h3>
                                <input type="number" name="min_price" id="" class="form-control" placeholder="minimum price"> -
                                <input type="number" name="max_price" id="" class="form-control" placeholder="maximun price">
                            </div>
                            <input type="submit" value="Search" class="btn btn-dark">
                        </form>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <div class="row gx-4 gx-lg-5" id="pizza">
                    @if($status == 1)
                        @foreach($pizzas as $pizza)
                            <div class="col-4 mb-5" style="width: 300px;">
                                <div class="card h-100" >
                                    <!-- Sale badge-->
                                    @if($pizza->buy_one_get_one_status == 1)
                                        <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Buy 1 Get 1</div>
                                    @endif
                                    <!-- Product image-->
                                    <img class="card-img-top" src="{{asset('uploads/'.$pizza->image)}}" height="200px" alt="..." />
                                    <!-- Product details-->
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <!-- Product name-->
                                            <h5 class="fw-bolder">{{$pizza->name}}</h5>
                                            <!-- Product price-->
                                            {{-- <span class="text-muted text-decoration-line-through">$20.00</span> $18.00 --}}
                                            {{$pizza->price}} kyats
                                        </div>
                                    </div>
                                    <!-- Product actions-->
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{route('user#pizzaDetail',$pizza->id)}}">More Details</a></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-danger" role="alert">
                            There is no Pizza Data ...
                        </div>
                    @endif
                    {{$pizzas->links()}}
                </div>
            </div>
        </div>
    </div>


    <div class="text-center d-flex justify-content-center align-items-center" id="contact">
        <div class="col-4 border shadow-sm ps-5 pt-5 pe-5 pb-2 mb-5">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong></strong> {{session('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <h3>Contact Us</h3>

            <form action="{{ route('user#contactCreate') }}"  method="POST" class="my-4">
                @csrf
                @error('name')
                <div class="alert alert-danger p-1">
                    {{ $message }}
                </div>
                @enderror
                <input type="text" name="name" value="{{old('name')}}" class="form-control my-1" placeholder="Name">
                @error('email')
                <div class="alert alert-danger p-1">
                    {{ $message }}
                </div>
                @enderror
                <input type="text" name="email" value="{{old('email')}}" class="form-control my-1" placeholder="Email">
                @error('message')
                <div class="alert alert-danger p-1">
                    {{ $message }}
                </div>
                @enderror
                <textarea class="form-control my-1" name="message" rows="3" placeholder="Message">{{old('message')}}</textarea>
                <button type="submit" class="btn btn-outline-dark">Send</button>
            </form>
        </div>
    </div>
@endsection

