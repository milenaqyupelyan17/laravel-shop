@extends('layouts.app')

@section('content')

<main class="help-page">
    <section class="help-hero">
        <div class="wrapper w-100 text-center">
            <div class="title-1">Help & Support</div>
            <p class="w-50 text-grey">
                Need help? Find answers to common questions or contact our
                support team.
            </p>
        </div>
    </section>
    <section class="help-content w-60 p-top">
        <div class="wrapper">
            <div class="title-3">Frequently Asked Questions</div>
            <div class="faq">
                <div class="faq-item">
                    <div class="title-5">How can I place an order?</div>
                    <p class="text-grey">
                        Browse our products, choose the item you like and add
                        it to your shopping cart. Then proceed to checkout.
                    </p>
                </div>
                <div class="faq-item">
                    <div class="title-5">How can I track my order?</div>
                    <p class="text-grey">
                        Once your order has been shipped, you will receive
                        information about your delivery.
                    </p>
                </div>
                <div class="faq-item">
                    <div class="title-5">Can I return a product?</div>
                    <p class="text-grey">
                        Yes. If you are not satisfied with your purchase,
                        please contact our support team for return information.
                    </p>
                </div>
                <div class="faq-item">
                    <div class="title-5">How can I contact Luminae?</div>
                    <p class="text-grey">
                        You can contact us by email at support@luminae.com.
                        Our team will be happy to help you.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="help-bottom">
        <div class="wrapper">
            <div class="title-3">Still Need Help?</div>
            <p class="text-grey w-30 text-center">
                Our support team is here to help with your questions,
                orders and products.
            </p>
            <a href="{{ route('contact') }}">
                <div class="btn-1">CONTACT US</div>
            </a>
        </div>
    </section>
</main>

@endsection