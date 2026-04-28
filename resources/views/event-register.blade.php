<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <title>Register — Malaysian Forestry Conference 2026</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="icon" href="{{ asset('images/logo-icon.png')}}">
</head>
<body>

    <!-- Nav -->
    <nav>
        <a href="/">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" onerror="this.style.display='none'" />
        </a>
        <a href="/">Home</a>
        <a href="/#agenda">Agenda</a>
        <a href="/#speakers">Speakers</a>
        <a href="/#footer">Contacts</a>
    </nav>

    <!-- Registration Section -->
    <section id="register">
        <span class="section-label">Join Us</span>
        <h2>Event Registration</h2>


        @if($errors->any())
            <div class="alert-error">
                <ul style="margin: 0; padding-left: 16px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="back-btn">
            <a href="/">← Back</a>
        </div>
        <form method="POST" action="/event-register" class="register-form">
            @csrf

            <div class="form-group">
                <label>Full Name</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="As per identification card"
                    required
                />
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="yourname@example.com"
                    required
                />
            </div>

            <div class="form-group">
                <label>Phone Number</label>
                <input
                    type="text"
                    name="phone"
                    value="{{ old('phone') }}"
                    placeholder="e.g. 011-12345678"
                    required
                />
            </div>

            <div class="form-group">
                <label>Designation</label>
                <input
                    type="text"
                    name="designation"
                    value="{{ old('designation') }}"
                    placeholder="e.g. Forest Officer, Senior Researcher"
                    required
                />
            </div>

            <div class="form-group">
                <label>Agency / Organisation</label>
                <input
                    type="text"
                    name="agency"
                    value="{{ old('agency') }}"
                    placeholder="e.g. Forest Department Sarawak"
                    required
                />
            </div>

            <button type="submit" class="register_btn" style="border:none; cursor:pointer; width:100%; justify-content:center; margin-top:8px;">
                Register Now
            </button>

        </form>
    </section>

    <footer id="footer">
    <div class="footer-container">
      <div class="footer-section">
        <h3>Contact Us</h3>
        <p>📧 <a href="mailto:forestdepartment@sarawak.gov.my">forestdepartment@sarawak.gov.my</a></p>
        <p>📞 <a href="tel:+6082495111">+6082 495 111</a></p>
        <p class="footer-address">
          Forest Department Sarawak HQ<br>
          Level 15, East Wing,<br>
          Bangunan Baitul Makmur II,<br>
          Medan Raya, Petra Jaya,<br>
          93050 Kuching, Sarawak
        </p>
      </div>
      <div class="footer-section">
        <h3>Quick Links</h3>
        <ul>
          <li><a href="https://forestry.sarawak.gov.my/web/subpage/webpage_view/32" target="_blank">Security Policy</a></li>
          <li><a href="https://forestry.sarawak.gov.my/web/subpage/webpage_view/31" target="_blank">Privacy Policy</a></li>
          <li><a href="https://forestry.sarawak.gov.my/web/subpage/webpage_view/33" target="_blank">Terms &amp; Conditions</a></li>
          <li><a href="https://forestry.sarawak.gov.my/web/subpage/faq_view/" target="_blank">FAQ</a></li>
          <li><a href="/admin">Admin Login</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>Copyright &copy; 2026 Forest Department Sarawak</p>
    </div>
  </footer>

</body>
</html>