@extends('layouts.guest', ['title' => 'login']);
@section('content')
    <div class="col-md-3 m-auto">
        <form id="login-form" method="POST" action="{{ route('user.login') }}" enctype='multipart/form-data'>
            @csrf
            @include('layouts.partials.message');
            <h2 class="text-center">Login</h2>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <div class="mb-3 form-check">

                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-primary" href="{{ route('user.signup') }}"> <label class="form-check-label"
                        for="">SignUp</label>
                </a>
            </div>
        </form>
    </div>
@endsection
