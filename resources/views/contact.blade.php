@extends('layouts.app')

@section('content')

<main class="contact-page">
    <section class="contact-hero">
        <div class="wrapper w-100 text-center">
            <div class="title-1">
                Contact Us
            </div>
            <p
                class="text-grey text-center w-50"
                style="margin: 0 auto;">
                Have a question or need help? We would love to hear from you.
                Contact the Luminae team and we will get back to you as soon as possible.
            </p>
        </div>
    </section>
    @if(session('contact_success'))
    <div class="contact-notify">
        ✓ {{ session('contact_success') }}
    </div>
    @endif
    <section class="contact-content flex justify-content-center"
        style="padding-bottom: 40px;">
        <div class="row gap-20">
            <div class="col w-60">
                <div class="wrapper contact-info flex flex-column gap-20">
                    <div class="title-3">
                        Get In Touch
                    </div>
                    <p>
                        Whether you have a question about an order, a product,
                        delivery or anything else, feel free to contact us.
                    </p>
                    <div class="contact-item">
                        <div class="title-6 w-700">
                            Email
                        </div>
                        <div class="text-grey">
                            support@luminae.com
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="title-6 w-700">
                            Phone
                        </div>
                        <div class="text-grey">
                            +374 00 00 00 00
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="title-6 w-700">
                            Address
                        </div>
                        <div class="text-grey">
                            Yerevan, Armenia
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="wrapper contact-form">
                    <div class="title-3">
                        Send Us A Message
                    </div>
                    <form
                        action="{{ route('contact.store') }}"
                        method="POST">
                        @csrf
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Your name"
                            required>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Your email"
                            required>
                        <textarea
                            name="message"
                            rows="6"
                            placeholder="Your message"
                            required>{{ old('message') }}</textarea>
                        <button
                            type="submit"
                            class="btn-1">
                            SEND MESSAGE
                        </button>
                        @if ($errors->any())
                        <div class="text-red">
                            @foreach ($errors->all() as $error)
                            <div>
                                {{ $error }}
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection