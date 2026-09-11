<div class="products-grid">
    @foreach($products as $product)
        <a href="{{ route('productdetails', ['id' => $product->id]) }}"
           class="product-card">
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
                <div class="products-info w-700 title-6">
                    <div class="price text-red">
                        ${{ $product->price }}
                    </div>
                </div>
            </div>
        </a>
    @endforeach
</div>