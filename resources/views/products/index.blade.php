@extends('layouts.auth', ['title' => 'products'])
@section('content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="col-md-10 ">
        <div class="header-menu d-flex justify-content-between">
            <h2>Products</h2>
        </div>
        <div class="col-md-8 d-flex justify-content-cenetr">
            @foreach ($products as $item)
                <div class="card col-md-3 ml-3">
                    <img class="card-img-top image_size_item" src="{{ asset($item->image) }}" alt="item_img">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->name }}</h5>
                        <p class="card-text"><small class="text-muted">{{ $item->description }}</small></p>
                        <div class="d-flex text-dark">
                            <h4>Price : <span>{{ $item->price }}.$</span></h4>
                            <button class="btn btn-success cart-btn" id="item_id_{{ $item->id }}"
                                data-id={{ $item->id }}><i class="fa fa-cart-plus" aria-hidden="true"></i>
                                <span class="item-count item_id_{{ $item->id }}"></span></button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $products->links() }}
    </div>

    <style>
        .image_size_item {
            width: 200px;
            height: 200px;
        }
    </style>


    @push('scripts')
        <script>
            $('.cart-btn').click(function() {
                let id = $(this).attr('data-id');
                $.ajax({
                    type: "post",
                    url: "/product/add-to-cart",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'), // Include CSRF token
                        id: id
                    },
                    success: function(data) {
                        if (data.cart_data.length != 0) {
                            $.each(data.cart_data, function(id, value) {
                                $('.item_id_' + id).html(value.quantity);
                                var value = $(".badge-counter").text(data.item_count);
                            });
                        }
                    }
                })
            });
            $(document).ready(function() {
                let cart_data = <?= json_encode($cart_data) ?>;
                if (cart_data.length != 0) {
                    $.each(cart_data, function(id, value) {
                        $('.item_id_' + id).html(value.quantity);

                    });
                }
            });
        </script>
    @endpush
@endsection
