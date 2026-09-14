  <section id="letter">
        <div class="row bg-blue">
            <div class="col">
                <div class="wrapper flex flex-column gap-20">
                    <div class="title-2 w-700 text-white"> Luminae Store</div>
                    <div class="text-white">
                        Register your email not to miss the latest offers + Free delivery
                    </div>
                    <form action="{{ route('newsletter.store') }} "
                        method="POST" class="flex gap-20 text-center justify-content-center">
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