@extends('layouts.app')

@section('content')
<main>
    <section id="categories">
        <div class="row">
            <div class="col w-100">
                <div class="wrapper flex justify-content-between">
                    <div class="text-orange title-6">Woman</div>
                    <div class="text-grey title-6">Best seller</div>
                </div>
            </div>
        </div>
    </section>
    <section id="not_found">
        <div class="row">
            <div class="col w-50">
                <div class="wrapper w-40">
                    <img src="images/notfound.png">
                </div>
            </div>
            <div class="col w-50">
                <div class="wrapper not_found_border">
                    <div class="w-700">No results were found for searching " Blue Sony Camera ".</div>
                    <div class="title-6"><i class="fa-solid fa-notdef"></i> We recommend you to search different
                        clear key words to get the best result.
                    </div>
                    <div class="title-6"><i class="fa-solid fa-notdef"></i> You can see the most related purchased
                        products bellow.</div>
                </div>
            </div>
        </div>
        <a href="{{ route('home') }}" class="btn-1">
            Home
        </a>
        <a href="{{ route('products') }}" class="btn-1">
            Products
        </a>
    </section>
</main>
@endsection