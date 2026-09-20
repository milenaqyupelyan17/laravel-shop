  <section id="letter" style="padding-top: 150px;">
      <div class="row bg-blue justify-content-center">
          <div class="col" style="padding: 30px 50px;">
              <div class="wrapper flex flex-column gap-20">
                  <div class="title-2 w-700 text-white"> Luminae Store</div>
                  <div class="text-white">
                      Register your email not to miss the latest offers + Free delivery
                  </div>
                  <form action="{{ route('newsletter.store') }}"
                      method="POST"
                      class="flex gap-20 text-center justify-content-center">
                      @csrf
                      <input
                          type="email"
                          name="email"
                          placeholder="Enter your email"
                          required
                          style="height: 48px; padding: 0 14px; border: 1px solid #ffffff; border-radius: 4px; outline: none; font-size: 14px; background: white; color: #333; ">
                      <button type="submit"
                          class="btn-2 text-white"
                          style=" height: 48px; padding: 0 20px;
            border: 1px solid white;
            border-radius: 4px;
            background: transparent;
            color: white;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;">
                          Send Email
                      </button>
                  </form>
                  @if(session('success'))
                  @endif
                  @error('email')
                  <div class="text-white"
                      style=" margin-top: 10px; text-align: center; font-size: 14px;">
                      {{ $message }}
                  </div>
                  @enderror
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
  <script>
document.getElementById('newsletter-form').addEventListener('submit', function(event) {

    event.preventDefault();
    const form = this;
    const message = document.getElementById('newsletter-message');
    const email = document.getElementById('newsletter-email');
    const formData = new FormData(form);
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        message.textContent = '✓ ' + data.message;
        email.value = '';
    })
    .catch(error => {
        message.textContent = 'Something went wrong.';
    });

});
</script>