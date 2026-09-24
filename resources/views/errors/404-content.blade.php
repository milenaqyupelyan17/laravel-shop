<section id="not_found">
    <div class="row align-items-center">
        <div class="col w-50">
            <div class="wrapper not-found-image">
                <img
                    src="{{ asset('images/notfound.png') }}"
                    alt="No results found">
            </div>
        </div>
        <div class="col w-50">
            <div class="wrapper not-found-content">
                <div class="not-found-number">
                    404
                </div>
                <div class="title-2 w-700">
                    No results found
                </div>
                <p class="text-grey title-6">
                    We couldn't find what you were looking for.
                </p>
                <p class="text-grey title-6">
                    Try searching with different keywords
                    or explore our products.
                </p>
                <div class="not-found-buttons">
                    <a
                        href="{{ route('home') }}"
                        class="btn-1">
                        <i class="fa-solid fa-house"></i>
                        Home
                    </a>
                    <a
                        href="{{ route('products') }}"
                        class="btn-1">
                        <i class="fa-solid fa-bag-shopping"></i>
                        Products
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    #not_found {
        padding: 80px 0 120px;
    }

    .not-found-image {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .not-found-image img {
        width: 75%;
        max-width: 420px;
        display: block;
    }

    .not-found-content {
        border-left: 1px solid #ddd;
        padding: 40px 50px;
    }

    .not-found-number {
        font-size: 70px;
        font-weight: 700;
        line-height: 1;
        color: #e5e5e5;
        margin-bottom: 15px;
    }

    .not-found-content .title-2 {
        margin-bottom: 15px;
    }

    .not-found-content p {
        margin: 8px 0;
        line-height: 1.6;
    }

    .not-found-buttons {
        display: flex;
        gap: 15px;
        margin-top: 30px;
    }

    .not-found-buttons .btn-1 {
        min-width: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }


    @media (max-width: 768px) {

        #not_found {
            padding: 50px 0 80px;
        }

        .not-found-image img {
            width: 70%;
        }

        .not-found-content {
            border-left: none;
            border-top: 1px solid #ddd;
            margin-top: 40px;
            padding: 35px 20px;
            text-align: center;
        }

        .not-found-buttons {
            justify-content: center;
        }

    }
</style>