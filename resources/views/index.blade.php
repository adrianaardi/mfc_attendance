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

@if(session('success'))
    @if($activeDay && $currentActivity)
        <style>
            #announcementModal { display: none !important; }
        </style>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Registration Confirmed!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'Got it!',
                confirmButtonColor: '#1a3a2a',
                background: '#f7f3ec',
                color: '#1a2a1e',
                iconColor: '#4a7c59',
                borderRadius: '14px',
                customClass: {
                    popup: 'swal-forest-popup',
                    title: 'swal-forest-title',
                }
            }).then((result) => {
                // Once the user clicks "Got it!", show the announcement modal
                const announcement = document.getElementById('announcementModal');
                if (announcement) {
                    announcement.style.setProperty('display', 'flex', 'important');
                }
            });
        });
    </script>
@endif

  <!-- ── ANNOUNCEMENT MODAL ──────────────────────────────── -->
  @if($activeDay && $currentActivity)
  <div id="announcementModal" class="announcement-overlay">
      <div class="announcement-content">
          <div class="announcement-header">
            @if($activeDay == 1)
                <span>Live Now — 13th July 2026</span>
            @elseif($activeDay == 2)
                <span>Live Now — 14th July 2026</span>
            @elseif($activeDay == 3)
                <span>Live Now — 15th July 2026</span>
            @endif
              <button class="close-announcement" onclick="closeAnnouncement()">&times;</button>
          </div>
          <div class="announcement-body">
            <h3>Current Agenda:</h3>
              <h1>{{ $currentActivity['activity'] }}</h1>
              @if(isset($currentActivity['speaker']))
                  <p>🎤 <strong>{{ $currentActivity['speaker'] }}</strong></p>
              @endif
              <button class="announcement-btn" onclick="closeAnnouncement()">Got it!</button>
          </div>
      </div>
  </div>
  @endif

  <!-- ── NAV ─────────────────────────────────────────────── -->
  <nav>
    <a href="#header">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" onerror="this.style.display='none'" />
      <img src="{{ asset('images/logo_mfc.jpeg') }}" alt="Logo" onerror="this.style.display='none'" />
    </a>

    <a href="#agenda">Agenda</a>
    <a href="#speakers">Speakers</a>
    <a href="#slides">Slides</a>
    <a href="#footer">Contacts</a>
  </nav>

<header id="header">
  <div class="slider">

    <div class="slide active" data-slide="1">
      <div class="hero-inner">
        <div class="hero-tag">21st Edition · 2026</div>
        <h1>Malaysian <em>Forestry</em><br>Conference 2026</h1>
          <p class="excerpt-text">
            The Malaysian Forestry Conference (MFC) is the premier national forestry conference in Malaysia. <br> <span class="more-text"> Since its inception in 1966, the conference has been organised on a rotational basis among the forestry authorities of Peninsular Malaysia, Sabah and Sarawak.<br>
            Held every few years, the conference provides a platform for forestry professionals to exchange knowledge, share experiences and discuss issues relating to the sustainable management of Malaysia's forest resources.
            <br>Over the decades, MFC has evolved into an important forum that brings together government agencies, researchers, academia, industry representatives and stakeholders to address emerging forestry challenges and opportunities at the national, regional and global levels.
            <br>The conference continues to strengthen collaboration among forestry institutions while promoting innovation, sustainability and responsible stewardship of Malaysia's forests.
          </span>
          <button class="read-more-btn">Read More</button>
        </p>
        @if($settings['registration'])
            <a href="/event-register" class="register_btn">Register Here</a>
        @else
            <button class="register_btn" disabled style="opacity:0.5; cursor:not-allowed;">Registration Closed</button>
        @endif
      </div>
    </div>

    <!-- Slide 2: Promotion -->
    <div class="slide" data-slide="2">
      <div class="hero-inner">
                <div class="hero-tag">MFC 2026 Post-Tour</div>

        <h1 style="font-size: clamp(20px, 6vw, 48px);
  white-space: nowrap;">Discover · Connect · Collaborate</h1>
        <p>Explore the beauty of Sarawak, connect with fellow participants, and create lasting partnerships through the MFC 2026 experience.</p>
        <a href="/poster" class="register_btn">View Here</a>
      </div>
    </div>

  </div>

  <div class="slider-dots">
    <span class="dot active" data-dot="1"></span>
    <span class="dot" data-dot="2"></span>
  </div>

  <div class="scroll-hint">
    Kelingkang Range
  </div>
</header>

  <!-- ── AGENDA ───────────────────────────────────────────── -->
<section id="agenda">
    <span class="section-label">Schedule</span>
    <h2>Conference Agenda</h2>

    <div class="agenda-tabs" id="agenda-day-tabs">
        <button onclick="showDay(1)" class="active">13th July 2026 <br> DAY 1</button>
        <button onclick="showDay(2)">14th July 2026 <br> DAY 2</button>
        <button onclick="showDay(3)">15th July 2026 <br> DAY 3</button>
    </div>

    <!-- DAY 1 -->
    <div id="day1" class="agenda-day">
      <table>
        <tr><th style="width: 30%;">Time</th><th>Activity</th></tr>
        <tr><td>8:15 AM – 10:15 AM</td><td><ul><li>Appointment of the Conference's Chairman by previous Chairman</li>
        <li>Introduction remarks by respective Heads of Departments</li>
      <li>Appointment of Conference Officials</li>
        <li>Reporting of the 20th Malaysian Forestry Conference Resolutions</li>
          <li>Amendment to the Standing Orders of Malaysian Forestry Conference, if any.</li>
      </ul></td></tr>
        <tr><td>10:15 AM – 10:30 AM</td><td>Refreshments</td></tr>
        <tr><td colspan="2"><strong>Plenary Session: Keynote Address and Main Working Paper</strong></td></tr>
        <tr><td>10:30 AM – 11:00 AM</td><td><strong>Keynote Address:</strong> Protected Areas, Eco-Forest Parks, and Geoparks: Drivers of Green Economy and Sustainability in Malaysian Forestry<ul><li>Prof. Emeritus Dato Dr. Ibrahim Komoo</li></ul></td></tr>
        <tr><td>11:00 AM – 11:30 AM</td><td><strong>Main Working Paper 1:</strong> Sabah Forestry Department</td></tr>
        <tr><td>11:30 AM – 12:00 PM</td><td><strong>Main Working Paper 2:</strong> Forestry Department of Peninsular Malaysia</td></tr>
        <tr><td>12:00 AM – 12:30 PM</td><td><strong>Main Working Paper 3:</strong> Forest Department Sarawak</td></tr>
        <tr><td>12:30 PM – 1:45 PM</td><td>Lunch</td></tr>
        <tr><td colspan="2"><strong>Subtheme 1: Policy and Governance<br>Chairman: </strong>Tuan Muhamad Bin Abdullah (Jabatan Perhutanan Semenanjung Malaysia)</td></tr>
        <tr><td>1:45 PM – 2:00 PM</td><td>Session Commencement</td></tr>
        <tr><td>2:00 PM – 2:20 PM</td><td><strong>Paper 1:</strong> Digital Governance in Forestry: Enhancing STLVS Integrity and Revenue Efficiency as a Catalyst for Sarawak’s Green Economy<ul><li>Hasnaliza B.A. et al. (Forest Department Sarawak)</li></ul></td></tr>
        <tr><td>2:20 PM – 2:40 PM</td><td><strong>Paper 2:</strong> Unlocking Natural Capital: Sabah’s Policy Frameworks for a Forest-Based Green Economy <ul><li>Indra P. H. Sunjoto et al. (Sabah Forestry Department)</li></ul></td></tr>
        <tr><td>2:40 PM – 3:00 PM</td><td><strong>Paper 3:</strong> Penetapan Pendengaran Awam (Public Hearing) Bagi Pewartaan Keluar Hutan Simpanan Kekal (HSK) Di Semenanjung Malaysia<ul><li>Zarin R. et al. (Jabatan Perhutanan Semenanjung Malaysia)</li></ul></td></tr>
        <tr><td>3:00 PM – 3:20 PM</td><td><strong>Paper 4:</strong> Science-Based Forest Policy in Action: Integrating Dipterocarp Population Assessment into Sarawak's Efforts on CITES and the Sustainable Timber Framework<ul><li>Vilma Bodos et al. (Forest Department Sarawak)</li></ul></td></tr>
        <tr><td>3:20 PM – 3:30 PM</td><td>Question and Answer Session</td></tr>
        <tr><td>3:30 PM</td><td>Refreshments &amp; End of Day 1</td></tr>
      </table>
      <div class="punch-in-container">
        @if($settings['attendance_day1'])
            <button onclick="openAttendanceModal(1)" class="punch-btn">Verify Attendance — Day 1</button>
        @else
            <button class="punch-btn" disabled style="opacity:0.5; cursor:not-allowed;">Day 1 Closed</button>
        @endif
      </div>
    </div>

    <!-- DAY 2 -->
    <div id="day2" class="agenda-day" style="display:none;">
      <table>
        <tr><th style="width: 30%;">Time</th><th>Activity</th></tr>
        <tr><td colspan="2"><strong>Subtheme 2: Nature-Based Adaptation and Solution<br>Chairman: </strong>Tuan Haji Mohd. Ridzuwan Bin Endor (Jabatan Perhutanan Semenanjung Malaysia)</td></tr>
        <tr><td>8:30 AM – 8:40 AM</td><td>Session Commencement</td></tr>
        <tr><td>8:40 AM – 9:00 AM</td><td><strong>Paper 5:</strong> Pengalaman Dan Cabaran Pengurusan Kebakaran Hutan Paya Gambut Di Selangor<ul><li>Debora Belawan et al. (Jabatan Perhutanan Semenanjung Malaysia)</li></ul></td></tr>
        <tr><td>9:00 AM – 9:20 AM</td><td><strong>Paper 6:</strong> Estimating Aboveground Forest Carbon Density through LiDAR and Geospatial Remote Sensing in Sarawak<ul><li>Dr Malcom anak Demies et al. (Forest Department Sarawak)</li></ul></td></tr>
        <tr><td>9:20 AM – 9:40 AM</td><td><strong>Paper 7:</strong> A Review: Ecological Dynamics of Tropical Highland Peat Ecosystems<ul><li>Iqtie Qamar Laila Mohd Gani et al. (Jabatan Perhutanan Semenanjung Malaysia)</li></ul></td></tr>
        <tr><td>9:40 AM – 10:00 AM</td><td><strong>Paper 8:</strong> Nature, Climate, and Economy: Sabah’s Pathway Through Nature-Based Solutions<ul><li>Rosila Anthony et al. (Sabah Forestry Department)</li></ul></td></tr>
        <tr><td>10:00 AM – 10:10 AM</td><td>Question and Answer Session</td></tr>
        <tr><td>10:10 AM – 10:30 AM</td><td>Refreshments</td></tr>
        <tr><td colspan="2"><strong>Subtheme 3: Partnership and Collaboration<br>Chairman: </strong>Tuan Indra Puwandita Bin Herry Sunjoto (Sabah Forestry Department)</td></tr>
        <tr><td>10:30 AM – 10:40 AM</td><td>Session Commencement</td></tr>
        <tr><td>10:40 AM – 11:00 AM</td><td><strong>Paper 9:</strong> Sabah Timber Legality Assurance System Plus (TLAS+): Advancing Timber Legality through International Collaboration<ul><li>Mijol R. M et al. (Sabah Forestry Department)</li></ul></td></tr>
        <tr><td>11:00 AM – 11:20 AM</td><td><strong>Paper 10:</strong> Operasi Penguatkuasaan Bersepadu Jabatan Perhutanan Semenanjung Malaysia<ul><li>Gana R.K et al. (Jabatan Perhutanan Semenanjung Malaysia)</li></ul></td></tr>
        <tr><td>11:20 AM – 11:40 AM</td><td><strong>Paper 11:</strong> Digitalizing Conservation Governance: [HOBS] A Cross-Agency Project Management System for the Heart of Borneo in Sarawak<ul><li>Meliza Binti Mohd Rizan et al. (Forest Department Sarawak)</li></ul></td></tr>
        <tr><td>11:40 AM – 12:00 PM</td><td><strong>Paper 12: </strong>Small Mammal Diversity in Borneo: Insights from Historical Records and Collaborative Biodiversity Assessments<ul><li>Professor Ts. Dr. Faisal Ali bin Anwarali Khan et al. (Unimas)</li></ul></td></tr>
        <tr><td>12:00 PM – 12:10 PM</td><td>Question and Answer Session</td></tr>
        <tr><td>12:10 PM – 1:30 PM</td><td>Lunch</td></tr>
        <tr><td colspan="2"><strong>Subtheme 4: Biodiversity Research and Conservation<br>Chairman</strong> Arthur Chung Yaw Chyang (Sabah Forestry Department)</td></tr>
        <tr><td>1:30 PM – 1:40 PM</td><td>Session Commencement</td></tr>
        <tr><td>1:40 PM – 2:00 PM</td><td><strong>Paper 13:</strong> Ekspedisi Saintifik Kepelbagaian Biologi Hutan: Pencapaian dan Hala Tuju<ul><li>Siti Khatijah Othman et al. (Jabatan Perhutanan Semenanjung Malaysia)</li></ul></td></tr>
        <tr><td>2:00 PM – 2:20 PM</td><td><strong>Paper 14:</strong> Developing a Forest Reference Level Monitoring System in Sabah: Integrating Field Biometrics and Remote Sensing for Biodiversity Conservation and Sustainable Forest Management<ul><li>Reuben Nilus et al. (Sabah Forestry Department)</li></ul></td></tr>
        <tr><td>2:20 PM – 2:40 PM</td><td><strong>Paper 15:</strong> The use of UAV-based LiDAR for Forest Volume Modeling in Sarawak<ul><li>Bibian Diway et al. (Forest Department Sarawak)</li></ul></td></tr>
        <tr><td>2:40 PM – 3:00 PM</td><td><strong>Paper 16: </strong>An An Overview of Orangutan Conservation in Sarawak for the Next Decade<ul><li>Aliana Binti Affendi et al. (Sarawak Forestry Corporation)</li></ul></td></tr>
        <tr><td>3:00 PM – 3:20 PM</td><td><strong>Paper 17:</strong> Vascular Plant Diversity and Conservation Importance of the Ultramafic Forests of Meliau Range, Central Sabah
        <ul>
          <li>Jonathan J. Lucas et al. (Sabah Forestry Department)</li>
        </ul>
      </td></tr>
        <tr><td>3:20 PM – 3:30 PM</td><td>Question and Answer Session</td></tr>
        <tr><td>3:30 PM – 3:40 PM</td><td>Refreshments</td></tr>
        <tr><td colspan="2"><strong>Subtheme 5: Forest Plantation and Restoration<br>Chairman: </strong>Dr. Affendi bin Suhaili (Forest Department Sarawak)</td></tr>
        <tr><td>3:40 PM – 4:00 PM</td><td>Session Commencement</td></tr>
        <tr><td>4:00 PM – 4:20 PM</td><td><strong>Paper 18:</strong> Forest Restoration and Rehabilitation: Experiences and Insights<ul><li>Zarina, S. et al.(Forest Department Sarawak)</li></ul></td></tr>
        <tr><td>4:20 PM – 4:30 PM</td><td><strong>Paper 19:</strong> Forest Landscape Restoration Approaches to Strengthen Forest Sustainability In Peninsular Malaysia<ul><li>M. Hafni et al. (Jabatan Perhutanan Semenanjung Malaysia)</li></ul></td></tr>
        <tr><td>4:30 PM – 4:50 PM</td><td><strong>Paper 20:</strong> Shifting Dependency on Natural Forests to Forest Plantations in Support of Forest Landscape Sustainability<ul><li>Heidi Henry William et al. (Sabah Forestry Department)</li></ul></td></tr>
        <tr><td>4:50 PM – 5:10 PM</td><td><strong>Paper 21:</strong> Transforming Industrial Forest Plantations through R&D and Certification: Samling’s Experience In Sarawak, Malaysia.<ul><li>Roger Tami et al. (Samling Reforestation [Bintulu] Sdn. Bhd.)</li></ul></td></tr>
        <tr><td>5:10 PM – 5:20 PM</td><td>Question and Answer Session</td></tr>
        <tr><td>5:20 PM</td><td>End of Day 2</td></tr>
      </table>
      <div class="punch-in-container">
        @if($settings['attendance_day2'])
            <button onclick="openAttendanceModal(2)" class="punch-btn">Verify Attendance — Day 2</button>
        @else
            <button class="punch-btn" disabled style="opacity:0.5; cursor:not-allowed;">Day 2 Closed</button>
        @endif
      </div>
    </div>

    <!-- DAY 3 -->
    <div id="day3" class="agenda-day" style="display:none;">
      <table>
        <tr><th style="width: 30%;">Time</th><th>Activity</th></tr>
        <tr><td colspan="2"><strong>Subtheme 6: Social Forestry &amp; Ecotourism<br>Chairman:</strong> Tuan Haji Happysupina Bin Sait (Forest Department Sarawak)</td></tr>
        <tr><td>8:30 AM – 8:40 AM</td><td>Session Commencement</td></tr>
        <tr><td>8:40 AM – 9:00 AM</td><td><strong>Paper 22:</strong> Seridan Folia: A Community’s Journey with Tongkat Ali in the Heart of Borneo<ul><li>Suliman Bin Haji Jamahari et al. (Forest Department Sarawak)</li></ul></td></tr>
        <tr><td>9:00 AM – 9:20 AM</td><td><strong>Paper 23:</strong> Beyond Conservation: Community Participation as a Driver of Green Economy in Sabah’s Forest Landscapes<ul><li>E.B. Johnlee et al. (Sabah Forestry Department)</li></ul></td></tr>
        <tr><td>9:20 AM – 9:40 AM</td><td><strong>Paper 24:</strong> Pengurusan Kawasan Pendakian Di Dalam Hutan Simpanan Kekal Di Semenanjung Malaysia<ul><li>Reanee Lee et al. (Jabatan Perhutanan Semenanjung Malaysia)</li></ul></td></tr>
        <tr><td>9:40 AM – 10:00 AM</td><td><strong>Paper 25:</strong> Community-based Tourism and its Contribution to  Local Economies: Insights from Peros<ul><li>Madeline George Pau et al. (Forest Department Sarawak)</li></ul></td></tr>
        <tr><td>10:00 AM – 10:10 AM</td><td>Question and Answer Session</td></tr>
        <tr><td>10:10 AM – 10:25 AM</td><td>Refreshments</td></tr>
        <tr><td colspan="2"><strong>Closed Sessions (For Members Only)</strong></td></tr>
        <tr><td>10:25 AM – 10:30 AM</td><td>Session Commencement</td></tr>
        <tr><td>10:30 AM – 12:30 PM</td><td>Conference Resolution Presentation and Adoption</td></tr>
        <tr><td colspan="2"><strong>Closing Ceremony</strong></td></tr>
        <tr><td>12:30 PM – 1:30 PM</td><td><strong>Closing Ceremony</strong><ul><li>Arrival of Permanent Secretary, Ministry of Natural Resources and Urban Development, Datu Haji Abdullah Bin Julaihi</li>
        <li>Negaraku and Ibu Pertiwiku</li>
      <li>Recital of Doa</li>
    <li>Closing Address by Permanent Secretary</li>
  <li>Photo Session</li>
</ul></td></tr>
        <tr><td>1:30 PM</td><td>Lunch and End of Conference</td></tr>
      </table>
      <div class="punch-in-container">
        @if($settings['attendance_day3'])
            <button onclick="openAttendanceModal(3)" class="punch-btn">Verify Attendance — Day 3</button>
        @else
            <button class="punch-btn" disabled style="opacity:0.5; cursor:not-allowed;">Day 3 Closed</button>
        @endif
      </div>
    </div>
  </section>

<!-- ── SPEAKERS ─────────────────────────────────────────── -->
<!-- ── SPEAKERS ─────────────────────────────────────────── -->
 <section id="speakers">
    <span class="section-label">Our Presenters</span>
    <h2>Speaker Information</h2>
    <div class="speakers-grid">

      <!-- Permanent Secretary -->
      <div class="speaker-card" onclick="showSpeakerModal('Datu Haji Abdullah Bin Julaihi','Permanent Secretary','','{{ asset('images/talker/DATU HAJI ABDULLAH JULAIHI.png') }}')">
        <img src="{{ asset('images/talker/DATU HAJI ABDULLAH JULAIHI.png') }}" alt="Datu Haji Abdullah Bin Julaihi" />
        <strong>Datu Haji Abdullah Bin Julaihi</strong>
        <span>Permanent Secretary</span>
      </div>

      <!-- Day 1: Keynote -->
      <div class="speaker-card" onclick="showSpeakerModal('Prof. Emeritus Dato Dr. Ibrahim Komoo','Keynote Speaker','','{{ asset('images/talker/PROF EMERITUS DATO DR IBRAHIM KOMOO.png') }}')">
        <img src="{{ asset('images/talker/PROF EMERITUS DATO DR IBRAHIM KOMOO.png') }}" alt="Prof. Emeritus Dato Dr. Ibrahim Komoo" />
        <strong>Prof. Emeritus Dato Dr. Ibrahim Komoo</strong>
        <span>Keynote Speaker</span>
      </div>

      <!-- Day 1: Subtheme 1 - Policy and Governance -->
      <div class="speaker-card" onclick="showSpeakerModal('Tuan Muhamad Bin Abdullah','Session Chairman','Jabatan Perhutanan Semenanjung Malaysia','{{ asset('images/talker/TUAN ABDULLAH.png') }}')">
        <img src="{{ asset('images/talker/TUAN ABDULLAH.png') }}" alt="Tuan Muhamad Bin Abdullah" />
        <strong>Tuan Muhamad Bin Abdullah</strong>
        <span>Session Chairman · Jabatan Perhutanan Semenanjung Malaysia</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Indra P. H. Sunjoto','Paper Presenter & Session Chairman','Sabah Forestry Department','{{ asset('images/talker/INDRA PH SUNJOTO.png') }}')">
        <img src="{{ asset('images/talker/INDRA PH SUNJOTO.png') }}" alt="Indra P. H. Sunjoto" />
        <strong>Indra P. H. Sunjoto</strong>
        <span>Paper Presenter & Session Chairman · Sabah Forestry Department</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Tuan Haji Mohd. Ridzuwan Bin Endor','Session Chairman','Jabatan Perhutanan Semenanjung Malaysia','{{ asset('images/talker/RIDZUWAN.png') }}')">
        <img src="{{ asset('images/talker/RIDZUWAN.png') }}" alt="Tuan Haji Mohd. Ridzuwan Bin Endor" />
        <strong>Tuan Haji Mohd. Ridzuwan Bin Endor</strong>
        <span>Session Chairman · Jabatan Perhutanan Semenanjung Malaysia</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Arthur Chung Yaw Chyang','Session Chairman','Sabah Forestry Department','https://ui-avatars.com/api/?name=Arthur+Chung&background=1a5c2e&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Arthur+Chung&background=1a5c2e&color=fff&size=150" alt="Arthur Chung Yaw Chyang" />
        <strong>Arthur Chung Yaw Chyang</strong>
        <span>Session Chairman · Sabah Forestry Department</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Dr. Affendi bin Suhaili','Session Chairman','Forest Department Sarawak','{{ asset('images/talker/DR AFFENDI.png') }}')">
        <img src="{{ asset('images/talker/DR AFFENDI.png') }}" alt="Dr. Affendi bin Suhaili" />
        <strong>Dr. Affendi bin Suhaili</strong>
        <span>Session Chairman · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Tuan Haji Happysupina Bin Sait','Session Chairman','Forest Department Sarawak','{{ asset('images/talker/HAJI HAPPYSUPINA.png') }}')">
        <img src="{{ asset('images/talker/HAJI HAPPYSUPINA.png') }}" alt="Tuan Haji Happysupina Bin Sait" />
        <strong>Tuan Haji Happysupina Bin Sait</strong>
        <span>Session Chairman · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Hasnaliza B.A.','Paper Presenter','Forest Department Sarawak','{{ asset('images/talker/HASNALIZA.png') }}')">
        <img src="{{ asset('images/talker/HASNALIZA.png') }}" alt="Hasnaliza B.A." />
        <strong>Hasnaliza B.A.</strong>
        <span>Paper Presenter · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Zarin R.','Paper Presenter','Jabatan Perhutanan Semenanjung Malaysia','{{ asset('images/talker/ZARIN R.png') }}')">
        <img src="{{ asset('images/talker/ZARIN R.png') }}" alt="Zarin R." />
        <strong>Zarin R.</strong>
        <span>Paper Presenter · Jabatan Perhutanan Semenanjung Malaysia</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Vilma Bodos','Paper Presenter','Forest Department Sarawak','{{ asset('images/talker/VILMA ANAK BODOS.png') }}')">
        <img src="{{ asset('images/talker/VILMA ANAK BODOS.png') }}" alt="Vilma Bodos" />
        <strong>Vilma Bodos</strong>
        <span>Paper Presenter · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Debora Belawan','Paper Presenter','Jabatan Perhutanan Semenanjung Malaysia','{{ asset('images/talker/DEBORA.png') }}')">
        <img src="{{ asset('images/talker/DEBORA.png') }}" alt="Debora Belawan" />
        <strong>Debora Belawan</strong>
        <span>Paper Presenter · Jabatan Perhutanan Semenanjung Malaysia</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Dr Malcom anak Demies','Paper Presenter','Forest Department Sarawak','{{ asset('images/talker/DR MALCOM DEMIES.png') }}')">
        <img src="{{ asset('images/talker/DR MALCOM DEMIES.png') }}" alt="Dr Malcom anak Demies" />
        <strong>Dr Malcom anak Demies</strong>
        <span>Paper Presenter · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Iqtie Qamar Laila Mohd Gani','Paper Presenter','Jabatan Perhutanan Semenanjung Malaysia','{{ asset('images/talker/IQTIE.jpg') }}')">
        <img src="{{ asset('images/talker/IQTIE.jpg') }}" alt="Iqtie Qamar Laila Mohd Gani" />
        <strong>Iqtie Qamar Laila Mohd Gani</strong>
        <span>Paper Presenter · Jabatan Perhutanan Semenanjung Malaysia</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Rosila Anthony','Paper Presenter','Sabah Forestry Department','{{ asset('images/talker/ROSILA ANTHONY.png') }}')">
        <img src="{{ asset('images/talker/ROSILA ANTHONY.png') }}" alt="Rosila Anthony" />
        <strong>Rosila Anthony</strong>
        <span>Paper Presenter · Sabah Forestry Department</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Mijol R. M.','Paper Presenter','Sabah Forestry Department','{{ asset('images/talker/MIJOL RM.png') }}')">
        <img src="{{ asset('images/talker/MIJOL RM.png') }}" alt="Mijol R. M." />
        <strong>Mijol R. M.</strong>
        <span>Paper Presenter · Sabah Forestry Department</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Gana R. K.','Paper Presenter','Jabatan Perhutanan Semenanjung Malaysia','{{ asset('images/talker/GANA R.png') }}')">
        <img src="{{ asset('images/talker/GANA R.png') }}" alt="Gana R. K." />
        <strong>Gana R. K.</strong>
        <span>Paper Presenter · Jabatan Perhutanan Semenanjung Malaysia</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Meliza Binti Mohd Rizan','Paper Presenter','Forest Department Sarawak','{{ asset('images/talker/MELIZA.jpg') }}')">
        <img src="{{ asset('images/talker/MELIZA.jpg') }}" alt="Meliza Binti Mohd Rizan" />
        <strong>Meliza Binti Mohd Rizan</strong>
        <span>Paper Presenter · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Prof. Ts. Dr. Faisal Ali bin Anwarali Khan','Paper Presenter','Unimas','{{ asset('images/talker/FAISAL ALI.jpg') }}')">
        <img src="{{ asset('images/talker/FAISAL ALI.jpg') }}" alt="Prof. Ts. Dr. Faisal Ali bin Anwarali Khan" />
        <strong>Prof. Ts. Dr. Faisal Ali bin Anwarali Khan</strong>
        <span>Paper Presenter · Unimas</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Siti Khatijah Othman','Paper Presenter','Jabatan Perhutanan Semenanjung Malaysia','{{ asset('images/talker/SITI KHATIJAH.png') }}')">
        <img src="{{ asset('images/talker/SITI KHATIJAH.png') }}" alt="Siti Khatijah Othman" />
        <strong>Siti Khatijah Othman</strong>
        <span>Paper Presenter · Jabatan Perhutanan Semenanjung Malaysia</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Reuben Nilus','Paper Presenter','Sabah Forestry Department','{{ asset('images/talker/REUBEN NILUS.png') }}')">
        <img src="{{ asset('images/talker/REUBEN NILUS.png') }}" alt="Reuben Nilus" />
        <strong>Reuben Nilus</strong>
        <span>Paper Presenter · Sabah Forestry Department</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Bibian Anak Micheal Diway','Paper Presenter','Forest Department Sarawak','{{ asset('images/talker/BIBIAN MICHAEL DIWAY.png') }}')">
        <img src="{{ asset('images/talker/BIBIAN MICHAEL DIWAY.png') }}" alt="Bibian Anak Micheal Diway" />
        <strong>Bibian Anak Micheal Diway</strong>
        <span>Paper Presenter · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Aliana Binti Affendi','Paper Presenter','Sarawak Forestry Corporation','{{ asset('images/talker/ALIANA.jpg') }}')">
        <img src="{{ asset('images/talker/ALIANA.jpg') }}" alt="Aliana Binti Affendi" />
        <strong>Aliana Binti Affendi</strong>
        <span>Paper Presenter · Sarawak Forestry Corporation</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Jonathan J. Lucas','Paper Presenter','Sabah Forestry Department','{{ asset('images/talker/JONATHAN J LUCAS.jpg') }}')">
        <img src="{{ asset('images/talker/JONATHAN J LUCAS.jpg') }}" alt="Jonathan J. Lucas" />
        <strong>Jonathan J. Lucas</strong>
        <span>Paper Presenter · Sabah Forestry Department</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Zarina Shebli','Paper Presenter','Forest Department Sarawak','{{ asset('images/talker/ZARINA SHEBLI.png') }}')">
        <img src="{{ asset('images/talker/ZARINA SHEBLI.png') }}" alt="Zarina Shebli" />
        <strong>Zarina Shebli</strong>
        <span>Paper Presenter · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('M. Hafni','Paper Presenter','Jabatan Perhutanan Semenanjung Malaysia','{{ asset('images/talker/HAFNI.png') }}')">
        <img src="{{ asset('images/talker/HAFNI.png') }}" alt="M. Hafni" />
        <strong>M. Hafni</strong>
        <span>Paper Presenter · Jabatan Perhutanan Semenanjung Malaysia</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Heidi Henry William','Paper Presenter','Sabah Forestry Department','{{ asset('images/talker/HEIDI HENRY.png') }}')">
        <img src="{{ asset('images/talker/HEIDI HENRY.png') }}" alt="Heidi Henry William" />
        <strong>Heidi Henry William</strong>
        <span>Paper Presenter · Sabah Forestry Department</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Roger Tami','Paper Presenter','Samling Reforestation (Bintulu) Sdn. Bhd.','{{ asset('images/talker/ROGER TAMI.jpg') }}')">
        <img src="{{ asset('images/talker/ROGER TAMI.jpg') }}" alt="Roger Tami" />
        <strong>Roger Tami</strong>
        <span>Paper Presenter · Samling Reforestation (Bintulu) Sdn. Bhd.</span>
      </div>
    
      <div class="speaker-card" onclick="showSpeakerModal('Suliman Bin Haji Jamahari','Paper Presenter','Forest Department Sarawak','{{ asset('images/talker/SULIMAN HAJI JAMAHARI.png') }}')">
        <img src="{{ asset('images/talker/SULIMAN HAJI JAMAHARI.png') }}" alt="Suliman Bin Haji Jamahari" />
        <strong>Suliman Bin Haji Jamahari</strong>
        <span>Paper Presenter · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('E. B. Johnlee','Paper Presenter','Sabah Forestry Department','{{ asset('images/talker/EB JOHNLEE.png') }}')">
        <img src="{{ asset('images/talker/EB JOHNLEE.png') }}" alt="E. B. Johnlee" />
        <strong>E. B. Johnlee</strong>
        <span>Paper Presenter · Sabah Forestry Department</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Reanee Lee','Paper Presenter','Jabatan Perhutanan Semenanjung Malaysia','{{ asset('images/talker/REANEE LEE.png') }}')">
        <img src="{{ asset('images/talker/REANEE LEE.png') }}" alt="Reanee Lee" />
        <strong>Reanee Lee</strong>
        <span>Paper Presenter · Jabatan Perhutanan Semenanjung Malaysia</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Madeline George Pau','Paper Presenter','Forest Department Sarawak','{{ asset('images/talker/MADELINE GEORGE PAU.png') }}')">
        <img src="{{ asset('images/talker/MADELINE GEORGE PAU.png') }}" alt="Madeline George Pau" />
        <strong>Madeline George Pau</strong>
        <span>Paper Presenter · Forest Department Sarawak</span>
      </div>

    </div>
  </section>

<!-- ── SLIDES ───────────────────────────────────────────── -->
<section id="slides">
    <span class="section-label">Resources</span>
    <h2>Presentation Slides</h2>
    <p>Download the official presentation slides from each session below.</p>

    <div class="slides-tabs">
        <button onclick="showSlideDay(1)" class="active" id="slide-tab-1">13th July 2026 <br> DAY 1</button>
        <button onclick="showSlideDay(2)" id="slide-tab-2">14th July 2026 <br> DAY 2</button>
        <button onclick="showSlideDay(3)" id="slide-tab-3">15th July 2026 <br> DAY 3</button>
    </div>

@foreach([1,2,3] as $day)
<div id="slides-day{{ $day }}" class="slides-day" style="{{ $day !== 1 ? 'display:none;' : '' }}">
    @php 
        $daySlides = $slides->get($day, collect());
        $daySessions = $daySlides->groupBy('session_label'); 
    @endphp

    @forelse($daySessions as $label => $items)
        <div class="slides-session-label">{{ $label }}</div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr><th>Speaker</th><th>Title</th><th>Slides</th></tr>
                </thead>
                <tbody>
                    @foreach($items as $slide)
                    <tr>
                        <td>{{ $slide->speaker }}</td>
                        <td>{{ $slide->title }}</td>
                        <td>
                            @if($slide->pdf_url)
                                <a href="{{ $slide->pdf_url }}" target="_blank">↓ PDF</a>
                            @else
                                <span style="color:var(--text-soft);">—</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @empty
        <p style="color:var(--text-soft); font-size:14px; margin-top:16px;">No slides uploaded yet.</p>
    @endforelse
</div>
@endforeach

</section>

<footer id="footer">
<footer id="footer">
    <div class="footer-container">
        <div class="footer-section">
            <h2 class="footer-title">Contact Us</h2>
            <p class="footer-subtitle">Tap a name to message on WhatsApp</p>
        </div>

        <div class="footer-grid">

            <div class="footer-group">
                <h3 class="group-title">Transportation</h3>
                <div class="footer-contacts">
                    <a href="https://wa.me/60146909608" target="_blank" class="footer-contact-item">
                        <span class="contact-name">Yusof Bin Noh</span>
                        <span class="contact-number">014-6909608</span>
                    </a>
                    <a href="https://wa.me/60105578894" target="_blank" class="footer-contact-item">
                        <span class="contact-name">Afreene Cecilia Binti Tuah</span>
                        <span class="contact-number">010-5578894</span>
                    </a>
                </div>
            </div>

            <div class="footer-group">
                <h3 class="group-title">Registration</h3>
                <div class="footer-contacts">
                    <a href="https://wa.me/60198169159" target="_blank" class="footer-contact-item">
                        <span class="contact-name">Wilma Anak Mancu</span>
                        <span class="contact-number">019-8169159</span>
                    </a>
                    <a href="https://wa.me/60149927904" target="_blank" class="footer-contact-item">
                        <span class="contact-name">Muammar Nur Parizzat</span>
                        <span class="contact-number">014-9927904</span>
                    </a>
                </div>
            </div>

            <div class="footer-group">
                <h3 class="group-title">Programme</h3>
                <div class="footer-contacts">
                    <a href="https://wa.me/60198463949" target="_blank" class="footer-contact-item">
                        <span class="contact-name">Mohd Izzuddin Bin Sallehin</span>
                        <span class="contact-number">019-8463949</span>
                    </a>
                </div>
            </div>

            <div class="footer-group">
                <h3 class="group-title">Seminar</h3>
                <div class="footer-contacts">
                    <a href="https://wa.me/60177171881" target="_blank" class="footer-contact-item">
                        <span class="contact-name">Dr Pang Shek Ling</span>
                        <span class="contact-number">017-7171881</span>
                    </a>
                </div>
            </div>

            <div class="footer-group">
                <h3 class="group-title">Spouse Programme</h3>
                <div class="footer-contacts">
                    <a href="https://wa.me/60168743246" target="_blank" class="footer-contact-item">
                        <span class="contact-name">Nur Qamaereena Binti Karim</span>
                        <span class="contact-number">016-8743246</span>
                    </a>
                </div>
            </div>

            <div class="footer-group">
                <h3 class="group-title">Post-tour</h3>
                <div class="footer-contacts">
                    <a href="https://wa.me/60198857074" target="_blank" class="footer-contact-item">
                        <span class="contact-name">Dulles Leo Balan</span>
                        <span class="contact-number">019-8857074</span>
                    </a>
                </div>
            </div>

            <div class="footer-group">
                <h3 class="group-title">Secretariates</h3>
                <div class="footer-contacts">
                    <a href="https://wa.me/60198597425" target="_blank" class="footer-contact-item">
                        <span class="contact-name">Judy George Wan</span>
                        <span class="contact-number">019-8597425</span>
                    </a>
                    <a href="https://wa.me/60165775122" target="_blank" class="footer-contact-item">
                        <span class="contact-name">Angel Kho</span>
                        <span class="contact-number">016-5775122</span>
                    </a>
                    <a href="https://wa.me/60142204162" target="_blank" class="footer-contact-item">
                        <span class="contact-name">Zaima Darahim</span>
                        <span class="contact-number">014-2204162</span>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <div class="footer-bottom">
        <a href="/admin" style="color:inherit; text-decoration:none;">
            <p>Copyright &copy; 2026 Forest Department Sarawak</p>
        </a>
    </div>
</footer>

<!-- ── SPEAKER MODAL ────────────────────────────────────── -->
  <div id="speakerModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <img id="modalImg" src="" alt="Speaker" />
      <h2 id="modalName"></h2>
      <p id="modalTitle"></p>
      <p id="modalCompany"></p>
    </div>
  </div>

  <!-- Attendance Modal -->
  <div id="attendanceModal" class="modal" style="display:none;">
      <div class="modal-content">
          <span class="close" onclick="closeAttendanceModal()">&times;</span>
          <h2 style="color: var(--canopy)">Verify Attendance</h2>
          <p style="color: var(--text-soft); font-size:14px; margin-bottom:20px;">Enter your registered email to verify attendance.</p>

          @if(session('attendance_success'))
              <div class="alert-success">{{ session('attendance_success') }}</div>
          @endif

          @if(session('attendance_error'))
              <div class="alert-error">{{ session('attendance_error') }}</div>
          @endif

          <form method="POST" action="/attendance">
              @csrf
              <input type="hidden" name="day" id="attendanceDay" value="1">
              <input
                  type="email"
                  name="email"
                  placeholder="Your registered email"
                  required
                  class="attendance-input"
              >
              <button type="submit" class="punch-btn" style="border:none; cursor:pointer; width:100%; margin-top:12px;">
                  Verify Attendance
              </button>
          </form>
      </div>
  </div>

  <script>

     // Reopen attendance modal if there's a flash message
    @if(session('attendance_error') || session('attendance_success'))
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('attendanceModal').style.display = 'flex';
        });
    @endif
    // Agenda tabs
    function showDay(day) {
        document.querySelectorAll('.agenda-day').forEach(el => el.style.display = 'none');
        document.getElementById('day' + day).style.display = 'block';
        document.querySelectorAll('#agenda-day-tabs button').forEach((btn, i) => {
            btn.classList.toggle('active', i + 1 === day);
        });
    }
    // Speaker modal
    function showSpeakerModal(name, title, company, imgSrc) {
      document.getElementById('modalImg').src = imgSrc;
      document.getElementById('modalName').textContent = name;
      document.getElementById('modalTitle').textContent = title;
      document.getElementById('modalCompany').textContent = company;
      document.getElementById('speakerModal').style.display = 'flex';
    }

    function closeModal() {
      document.getElementById('speakerModal').style.display = 'none';
    }

    window.addEventListener('click', e => {
      if (e.target === document.getElementById('speakerModal')) closeModal();
    });

    // Announcement modal
    function closeAnnouncement() {
      const modal = document.getElementById('announcementModal');
      modal.style.opacity = '0';
      modal.style.pointerEvents = 'none';
      setTimeout(() => modal.style.display = 'none', 300);
      // DELETE this line: sessionStorage.setItem('announcementClosed', 'true');
  }

    // Nav active highlight on scroll
    const navLinks = document.querySelectorAll('nav > a[href^="#"]');
    window.addEventListener('scroll', () => {
      let current = '';
      document.querySelectorAll('[id]').forEach(s => {
        if (window.scrollY >= s.offsetTop - 70) current = s.id;
      });
      navLinks.forEach(a => {
        a.classList.toggle('nav-active', a.getAttribute('href') === '#' + current);
      });
    });

    function openAttendanceModal(day) {
        document.getElementById('attendanceDay').value = day;
        document.getElementById('attendanceModal').style.display = 'flex';
    }

    function closeAttendanceModal() {
        document.getElementById('attendanceModal').style.display = 'none';
    }
    
function showSlideDay(n) {
    document.querySelectorAll('.slides-day').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.slides-tabs button').forEach(el => el.classList.remove('active'));
    document.getElementById('slides-day' + n).style.display = 'block';
    document.getElementById('slide-tab-' + n).classList.add('active');
}

document.addEventListener('DOMContentLoaded', function () {
    const slider = document.querySelector('.slider');
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');
    let current = 0;
    let autoplay;
    const AUTOPLAY_DELAY = 7000; // slowed down from 5000

    function goToSlide(index) {
      slides[current].classList.remove('active');
      dots[current].classList.remove('active');
      current = (index + slides.length) % slides.length;
      slides[current].classList.add('active');
      dots[current].classList.add('active');
    }

    function nextSlide() {
      goToSlide(current + 1);
    }

    function prevSlide() {
      goToSlide(current - 1);
    }

    function startAutoplay() {
      clearInterval(autoplay);
      autoplay = setInterval(nextSlide, AUTOPLAY_DELAY);
    }

    function restartAutoplay() {
      clearInterval(autoplay);
      startAutoplay();
    }

    dots.forEach((dot, i) => {
      dot.addEventListener('click', () => {
        goToSlide(i);
        restartAutoplay();
      });
    });

    // --- Swipe / drag support ---
    let startX = 0;
    let deltaX = 0;
    let isDragging = false;
    const SWIPE_THRESHOLD = 50; // px needed to trigger a slide change

    function onDragStart(x) {
      isDragging = true;
      startX = x;
      deltaX = 0;
      clearInterval(autoplay); // pause autoplay while interacting
    }

    function onDragMove(x) {
      if (!isDragging) return;
      deltaX = x - startX;
    }

    function onDragEnd() {
      if (!isDragging) return;
      isDragging = false;

      if (deltaX > SWIPE_THRESHOLD) {
        prevSlide();
      } else if (deltaX < -SWIPE_THRESHOLD) {
        nextSlide();
      }
      deltaX = 0;
      startAutoplay();
    }

    // Touch events (mobile)
    slider.addEventListener('touchstart', (e) => {
      onDragStart(e.touches[0].clientX);
    }, { passive: true });

    slider.addEventListener('touchmove', (e) => {
      onDragMove(e.touches[0].clientX);
    }, { passive: true });

    slider.addEventListener('touchend', onDragEnd);

    // Mouse events (desktop drag)
    slider.addEventListener('mousedown', (e) => {
      e.preventDefault();
      onDragStart(e.clientX);
    });

    slider.addEventListener('mousemove', (e) => {
      onDragMove(e.clientX);
    });

    slider.addEventListener('mouseup', onDragEnd);
    slider.addEventListener('mouseleave', () => {
      if (isDragging) onDragEnd();
    });

    startAutoplay();
});


  document.querySelectorAll('.read-more-btn').forEach(button => {
  button.addEventListener('click', function() {
    // Find the closest slide container
    const slide = this.closest('.slide');
    
    // Toggle the expanded class
    slide.classList.toggle('expanded');
    
    // Change button text based on the state
    if (slide.classList.contains('expanded')) {
      this.textContent = 'Read Less';
    } else {
      this.textContent = 'Read More';
    }
  });
});
  </script>
  
</body>
</html>