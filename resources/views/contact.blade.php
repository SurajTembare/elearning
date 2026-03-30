@extends('master')
@section('content')

<section class="contact_section layout_padding" style="background:linear-gradient(135deg, #fefefe, #f4f5f7); padding:70px 0;">
  <div class="container">
    <div class="text-center mb-5">
      <h2 style="font-weight:700; color:#232f3e; text-transform:uppercase; display:inline-block; border-bottom:3px solid #ff9900; padding-bottom:8px;">
        Get in Touch
      </h2>
      <p style="color:#555; margin-top:12px; font-size:1.1rem;">We’re here to help — contact our support team anytime.</p>
    </div>

    <div class="row align-items-stretch">
      <!-- Contact Info Card -->
      <div class="col-lg-4 mb-4 mb-lg-0">
        <div style="background:#fff; border-radius:12px; box-shadow:0 4px 15px rgba(0,0,0,0.08); padding:30px; height:100%;">
          <h4 style="font-weight:600; color:#232f3e; margin-bottom:20px;">Contact Information</h4>
          <p style="color:#555; margin-bottom:20px;">Our customer service is available 24/7 to assist you.</p>

          <div style="margin-bottom:15px;">
            <i class="fa-solid fa-phone" style="margin-right:10px; color:#ff9900;"></i>
            <strong>Phone:</strong> +91 9876543210
          </div>

          <div style="margin-bottom:15px;">
            <i class="fa-solid fa-envelope" style="margin-right:10px; color:#ff9900;"></i>
            <strong>Email:</strong> support@yourstore.com
          </div>

          <div style="margin-bottom:15px;">
            <i class="fa-solid fa-location-dot" style="margin-right:10px; color:#ff9900;"></i>
            <strong>Address:</strong> 123, Main Street, Phaltan, Maharashtra
          </div>

          <div style="margin-top:25px;">
            <!-- ⭐ UPDATED: SHOW STORE ADDRESS ON MAP -->
            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode('123, Main Street, Phaltan, Maharashtra') }}"
              target="_blank"
              style="background-color:#232f3e; color:#fff; padding:10px 20px; border-radius:6px; text-decoration:none; font-weight:600;">
              View on Map
            </a>
          </div>
        </div>
      </div>

      <!-- Contact Form Card -->
      <div class="col-lg-8">
        <div style="background:#fff; border-radius:12px; box-shadow:0 4px 15px rgba(0,0,0,0.08); padding:40px;">
          <h4 style="font-weight:600; color:#232f3e; margin-bottom:25px;">Send Us a Message</h4>

          <form action="/insertcontact" method="POST" style="display:flex; flex-direction:column; gap:18px;">
            @csrf

            <div style="display:flex; gap:15px;">
              <input type="text" name="name" placeholder="Your Name" required
                style="flex:1; padding:12px 14px; border:1px solid #ccc; border-radius:6px; font-size:1rem;">
              <input type="text" name="number" placeholder="Your Phone" required
                style="flex:1; padding:12px 14px; border:1px solid #ccc; border-radius:6px; font-size:1rem;">
            </div>

            <input type="email" name="email" placeholder="Your Email" required
              style="padding:12px 14px; border:1px solid #ccc; border-radius:6px; font-size:1rem;">

            <textarea name="message" placeholder="Type your message..." required
              style="padding:12px 14px; border:1px solid #ccc; border-radius:6px; font-size:1rem; resize:none; height:120px;"></textarea>

            <button type="submit"
              style="align-self:flex-start; background-color:#ffa41c; color:#111; border:none; padding:12px 30px; border-radius:6px; font-size:1rem; font-weight:600; cursor:pointer; transition:background 0.3s ease;">
              Send Message
            </button>
          </form>
        </div>
      </div>
    </div>

    <!-- Google Map Section -->
    <div style="margin-top:60px; border-radius:12px; overflow:hidden; box-shadow:0 4px 15px rgba(0,0,0,0.08);">

      <!-- ⭐ UPDATED MAP TO SHOW YOUR STORE LOCATION -->
      <iframe
        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&q={{ urlencode('123, Main Street, Phaltan, Maharashtra') }}"
        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy">
      </iframe>
    </div>

  </div>
</section>

@endsection
