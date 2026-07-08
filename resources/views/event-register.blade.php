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
      <img src="{{ asset('images/logo_mfc.jpeg') }}" alt="Logo" onerror="this.style.display='none'" />
    </a>

    <a href="/agenda">Agenda</a>
    <a href="/speakers">Bio's</a>
    <a href="{{ asset('pdf/pamphlet.pdf') }}" target="_blank">Booklet</a>
    <a href="/slides">Slides</a>
    <a href="/footer">Contacts</a>
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
        <div style="text-align:center; margin-top:20px;">
            <a href="/" class="register_btn">Back to Home</a>
        </div>
    </section>

</body>
</html>