<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
  <title>Malaysian Forestry Conference 2026</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('style.css') }}">
  <link rel="icon" href="{{ asset('images/logo-icon.png')}}">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <!-- ── NAV ─────────────────────────────────────────────── -->
  <nav>
    <a href="#header">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" onerror="this.style.display='none'" />
    </a>
    <a href="#agenda">Agenda</a>
    <a href="#speakers">Speakers</a>
    <a href="#slides">Slides</a>
    <a href="#footer">Contacts</a>
  </nav>

<section class="poster-section">
            <a href="javascript:history.back()" class="btn-back">← Back</a>

        <h1>Post-Conference Tour</h1>
        
        <iframe src="{{ asset('pdfs/Post-Conference Tour.pdf') }}" width="100%" height="600px" style="border: none;">
        <p>Your browser does not support PDFs. 
           <a href="{{ asset('pdfs/Post-Conference Tour.pdf') }}">Download the PDF instead</a>.
        </p>
    </iframe>

        <a href="#" class="btn-join">Click here to register for event</a>

</section>
</body>
</html>