@extends('layouts.auth', ['title' => 'user-cart'])
@section('content')
    <section class="h-100 h-custom" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="row">

                                <div class="col-lg-7">
                                    <h5 class="mb-3"><a href="#!" class="text-body"><i
                                                class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>
                                    <hr>

                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div>
                                            <p class="mb-1">Shopping cart</p>
                                            <p class="mb-0">You have {{ count($cart) }} items in your cart</p>
                                        </div>

                                    </div>
                                    @php
                                        $total = 0;
                                    @endphp
                                    <div class="card mb-3">
                                        @foreach ($cart as $item)
                                            @php
                                                $total = $total + $item['price'];
                                            @endphp
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <img src="{{ asset(@$item['image']) }}"
                                                                class="img-fluid rounded-3" alt="Shopping item"
                                                                style="width: 65px;">
                                                        </div>
                                                        <div class="ms-3">
                                                            <h5>{{ $item['name'] }}</h5>
                                                            <p class="small mb-0">{{ $item['description'] }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <div style="width: 50px;">
                                                            <p>Qnt.</p>
                                                            <h5 class="fw-normal mb-0">{{ $item['quantity'] }}
                                                            </h5>
                                                        </div>
                                                        <div style="width: 80px;">
                                                            <p>Price</p>
                                                            <h5 class="mb-0">{{ $item['price'] }}</h5>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- More cards -->

                                </div>
                                <div class="col-lg-5">

                                    <div class="card bg-primary text-white rounded-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <h5 class="mb-0">Card details</h5>
                                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp"
                                                    class="img-fluid rounded-3" style="width: 45px;" alt="Avatar">
                                            </div>

                                            <!-- Form and inputs -->

                                            <hr class="my-4">

                                            <div class="d-flex justify-content-between">
                                                <p class="mb-2">Subtotal</p>
                                                <p class="mb-2">${{ $total }}</p>
                                            </div>

                                            <div class="d-flex justify-content-between">
                                                <p class="mb-2">Shipping</p>
                                                <p class="mb-2">$20.00</p>
                                            </div>

                                            <div class="d-flex justify-content-between mb-4">
                                                <p class="mb-2">Total(Incl. taxes)</p>
                                                <p class="mb-2">$ {{ $total + 20.0 }}</p>
                                            </div>

                                            <button type="button" class="btn btn-info btn-block btn-lg">
                                                <div class="d-flex justify-content-between">
                                                    <span>$ {{ $total + 20.0 }}</span>
                                                    <span>Checkout <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                                </div>
                                            </button>

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
@endsection
