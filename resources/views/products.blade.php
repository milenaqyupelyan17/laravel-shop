@extends('layouts.app')

@section('content')

<div class="products-grid flex flex-column gap-20">
    @foreach($products as $product)
    <a href="{{ route('productdetails', ['id' => $product->id]) }}" class="product-card">
        <div class="product-image">
            <img src="{{ asset($product->image) }}" alt="{{ $product->title }}">
        </div>
        <div class="product-info">
            <div>
                <h2 class="title-7 w-700">
                    {{ $product->title }}
                </h2>
                <p class="text-grey title-8">
                    {{ $product->description }}
                </p>
            </div>
            <div class="products-info">
                <div class="price text-red">
                    ${{ $product->price }}
                </div>
                <i class="fa-regular fa-heart favorite-btn"
                    data-id="{{ $product->id }}"
                    data-title="{{ $product->title }}"
                    data-price="{{ $product->price }}"
                    data-image="{{ asset($product->image) }}">
                </i>
            </div>
        </div>
    </a>
    @endforeach
</div>

@endsection