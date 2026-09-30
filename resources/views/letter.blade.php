<section id="letter" style="padding-top: 150px;">
    <div class="row bg-blue justify-content-center">
        <div class="col" style="padding: 30px 50px;">
            <div class="wrapper flex flex-column gap-20">
                <div class="title-2 w-700 text-white">
                    Luminae Store
                </div>
                <div class="text-white">
                    Register your email not to miss the latest offers + Free delivery
                </div>
                @if(session('newsletter_success'))
                <div
                    style="
                            color: white;
                            text-align: center;
                            font-size: 14px;
                            padding: 10px;
                        ">
                    ✓ {{ session('newsletter_success') }}
                </div>
                @endif
                @if(session('newsletter_error'))
                <div
                    style="
                            color: white;
                            text-align: center;
                            font-size: 14px;
                            padding: 10px;
                        ">
                    {{ session('newsletter_error') }}
                </div>
                @endif
                @error('email')
                <div
                    style="
                            color: white;
                            text-align: center;
                            font-size: 14px;
                            padding: 10px;">
                    {{ $message }}
                </div>
                @enderror
                <form
                    id="newsletter-form"
                    action="{{ route('newsletter.store') }}"
                    method="POST"
                    class="flex gap-20 text-center justify-content-center">
                    @csrf
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter your email"
                        required
                        style="
                            height: 48px;
                            padding: 0 14px;
                            border: 1px solid #ffffff;
                            border-radius: 4px;
                            outline: none;
                            font-size: 14px;
                            background: white;
                            color: #333;
                        ">
                    <button
                        type="submit"
                        class="btn-2 text-white"
                        style="
                            height: 48px;
                            padding: 0 20px;
                            border: 1px solid white;
                            border-radius: 4px;
                            background: transparent;
                            color: white;
                            font-size: 14px;
                            font-weight: 500;
                            cursor: pointer;
                        ">
                        Send Email
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>