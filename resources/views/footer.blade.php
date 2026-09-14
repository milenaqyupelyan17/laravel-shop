<footer class="p-top">
    <section id="letter">
        <div class="row bg-blue">
            <div class="col">
                <div class="wrapper flex flex-column gap-20">
                    <div class="title-2 w-700 text-white"> Luminae Store</div>
                    <div class="text-white">
                        Register your email not to miss the latest offers + Free delivery
                    </div>
                    <form action="{{ route('newsletter.store') }} "
                        method="POST" class="flex gap-20 text-center">
                        @csrf
                        <input type="email" name="email" placeholder="Enter your email" required>
                        <button type="submit" class="btn-2 text-white">Send Email</button>
                    </form>
                    @if(session('success'))
                    <div class="text-white">
                        {{ session('success') }}
                    </div>
                    @endif
                    @error('email')
                    <div class="text-white">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
    </section>
    <section id="about">
        <div class="row footer-bg-2 justify-content-between">
            <div class="col flex flex-column gap-20">
                <div class="title-6 w-700">Company</div> <a href="{{ route('about') }}">
                    <div class="text-grey title-6">About us</div>
                </a> <a href="{{ route('contact') }}" class="title-6 text-grey"> Our Store </a>
            </div>
            <div class="col flex flex-column gap-20">
                <div class="title-6 w-700">Career Opportunities</div> <a href="{{ route('home') }}" class="title-6 text-grey"> Selling Programs </a> <a href="{{ route('home') }}" class="title-6 text-grey"> Advertise </a> <a href="{{ route('home') }}" class="title-6 text-grey"> Cooperation </a>
            </div>
            <div class="col flex flex-column gap-20">
                <div class="title-6 w-700">Help</div> <a href="{{ route('contact') }}" class="title-6 text-grey"> Contact Us </a>
            </div>
        </div>
    </section>
    <section id="info">
        <div class="row">
            <div class="col w-40">
                <div class="wrapper">
                    <div class="title-6">165-179 Forster Road City of Monash, Melbourne, Australia</div>
                </div>
            </div>
            <div class="col w-40">
                <div class="wrapper">
                    <div class="title-6 text-grey">©2023 Copyright in reserved for lumine shop</div>
                </div>
            </div>
            <div class="col w-20">
                <div class="wrapper flex gap-20">
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"> <i class="fa-brands fa-telegram"></i></a>
                </div>
            </div>
        </div>
    </section>
</footer>