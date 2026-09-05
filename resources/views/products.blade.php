@extends('layouts.app')

@section('content')

<main>

    <div class="products-grid">

        @foreach($products as $product)

            <div class="product-card">

                <div class="product-image">
                    <img
                        src="{{ asset($product->image) }}"
                        alt="{{ $product->title }}"
                    >
                </div>

                <div class="product-info">
                    <h2>{{ $product->title }}</h2>

                    <p>{{ $product->description }}</p>

                    <div class="price">
                        ${{ $product->price }}
                    </div>
                </div>

            </div>

        @endforeach

    </div>

</main>

@endsection
