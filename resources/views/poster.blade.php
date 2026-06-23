<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
  <title>Malaysian Forestry Conference 2026 — Events</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('style.css') }}">
  <link rel="icon" href="{{ asset('images/logo-icon.png')}}">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    #events {
      align-items: center;
      padding-top: calc(var(--nav-h) + 30px);
    }

    #events > * {
      width: 100%;
      max-width: 740px;
    }

    .events-gallery {
      display: flex;
      flex-direction: column;
      gap: 18px;
      margin: 0px 0 32px;
    }

    .events-gallery img {
      width: 100%;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      object-fit: cover;
      display: block;
    }

    .events-cta {
      text-align: center;
    }
  </style>
</head>
<body>
  <!-- ── NAV ─────────────────────────────────────────────── -->
  <nav>
    <a href="/">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" onerror="this.style.display='none'" />
      <img src="{{ asset('images/logo_mfc.jpeg') }}" alt="Logo" onerror="this.style.display='none'" />
    </a>

    <a href="#agenda">Agenda</a>
    <a href="#speakers">Speakers</a>
    <a href="#slides">Slides</a>
    <a href="#footer">Contacts</a>
  </nav>

  <section id="events">

    <span class="section-label">Discover. Connect. Collaborate.</span>
    <h2>MFC 2026 Post-Tour</h2>

    <div class="back-btn">
      <a href="javascript:history.back()">← Back</a>
    </div>

    <div class="events-gallery">
      <img src="{{ asset('images/poster/post-conference-tour-1.jpg') }}" alt="Post Conference Tour" />
      <img src="{{ asset('images/poster/post-conference-tour-2.jpg') }}" alt="Post Conference Tour" />
    </div>

    <div class="events-cta">
      <a href="https://forms.gle/Y1LY3HnbGtcNYgUd6" target="_blank" class="register_btn">Join Us</a>
    </div>
  </section>
</body>
</html>