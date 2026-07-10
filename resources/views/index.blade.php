<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
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
                confirmButtonColor: '#1a3a2ac0',
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
    <a href="#speakers">Bio's</a>
    <a href="#slides">Slides</a>
    <a href="#footer">Contacts</a>
  </nav>

<header id="header">


  <button class="slider-arrow next" aria-label="Next slide">&#10095;</button>

  <div class="slider">

    <div class="slide active" data-slide="1">
      <div class="hero-inner">
        <div class="hero-tag">21st Edition · 2026</div>
        <h1>21ˢᵗ Malaysian <em>Forestry</em><br>Conference 2026</h1>
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

    <div class="slide" data-slide="3">
      <div class="hero-inner">
        <div class="hero-tag">Official Announcement</div>
        <h1 style="font-size: clamp(20px, 6vw, 48px);
  white-space: nowrap;">Programme Book MFC 2026</h1>
        <p>Get the complete event overview, detailed daily agenda, speaker lineups, and guidelines for abstract submissions at a glance.</p>
        <a href="{{ asset('images/poster/pamphlet.pdf') }}" target="_blank" class="register_btn">View Book</a>
      </div>
    </div>

    <div class="slide" data-slide="2">
      <div class="hero-inner">
                <div class="hero-tag">MFC 2026 Post-Tour</div>

        <h1 style="font-size: clamp(20px, 6vw, 48px);
  white-space: nowrap;">Discover · Connect · Collaborate</h1>
        <p>Explore the beauty of Sarawak, connect with fellow participants, and create lasting partnerships through the MFC 2026 experience.</p>
        <a href="/poster" class="register_btn">View Here</a>
      </div>
    </div>

    <div class="slide" data-slide="4">
      <div class="hero-inner">
        <div class="hero-tag">Event Gallery</div>
        <h1 style="font-size: clamp(20px, 6vw, 48px);
  white-space: nowrap;">Capturing <em>Moments</em> Real-Time</h1>
        <p>Browse through live highlights, keynote presentations, networking sessions, and field excursions from MFC 2026.</p>
        <a href="https://cloud.sarawak.gov.my/index.php/s/rkmAe2JeqxE5YnA" target="_blank" class="register_btn">View Photo Gallery</a>
      </div>
    </div>

  <div class="slider-dots">
    <span class="dot active" data-dot="1"></span>
    <span class="dot" data-dot="2"></span>
    <span class="dot" data-dot="3"></span>
    <span class="dot" data-dot="4"></span>
  </div>

  <div class="scroll-hint">
    Kelingkang Range, sarawak
  </div>
</header>

  <!-- ── AGENDA ───────────────────────────────────────────── -->
<section id="agenda">
    <span class="section-label">Schedule</span>
    <h2>Conference Agenda</h2>

    <div class="slides-tabs" id="agenda-day-tabs">
        <button onclick="showDay(1)" class="active">13th July 2026 <br> DAY 1</button>
        <button onclick="showDay(2)">14th July 2026 <br> DAY 2</button>
        <button onclick="showDay(3)">15th July 2026 <br> DAY 3</button>
    </div>

    <!-- DAY 1 -->
    <div id="day1" class="agenda-day">
      <table>
        <tr><th style="width: 30%;">Time</th><th>Activity</th></tr>
        <tr><td>8:15 AM – 10:15 AM</td><td><ul><li>Appointment of the Conference's Chairman</li>
        <li>Introduction remarks by respective Heads of Departments</li>
        <li>Appointment of Conference's Officials</li>
        <li>Reporting of the 20th Malaysian Forestry Conference Resolutions</li>
        <li>Amendment to the Standing Orders of Malaysian Forestry Conference, if any.</li>
      </ul></td></tr>
        <tr><td>10:15 AM – 10:30 AM</td><td>Refreshments</td></tr>
        <tr><td colspan="2"><strong>Plenary Session: Keynote Address & Main Working Paper</strong></td></tr>
        <tr><td>10:30 AM – 11:00 AM</td><td><strong>Keynote Address:</strong> Protected Areas, Eco-Forest Parks, and Geoparks: Drivers of Green Economy and Sustainability in Malaysian Forestry<ul><li>Prof. Emeritus Dato Dr. Ibrahim Komoo & Norhayati Ahmad (Universiti Kebangsaan Malaysia)</li></ul></td></tr>
        <tr><td>11:00 AM – 11:30 AM</td><td><strong>Main Working Paper 1:</strong> Forests at the Frontier:Powering a Green Economy through Sustainable Forest Stewardship for a Climate-Resilient Future
        <ul>
          <li>
            Datuk Zulkifli Suara (Sabah Forestry Department)
          </li>
        </ul></td></tr>
        <tr><td>11:30 AM – 12:00 PM</td><td><strong>Main Working Paper 2:</strong> Sustainable Forest Management: Acting Locally for Global Impact
          <ul><li>Tuan Mohamad Bin Abdullah (Forestry Department of Peninsular Malaysia)</li></ul></td></tr>
        <tr><td>12:00 AM – 12:30 PM</td><td><strong>Main Working Paper 3:</strong> Sarawak Strategic Blueprint for Sustainable Forestry and Climate Action. 
          <ul>
            <li>
              Datu Haji Hamden Bin Haji Mohammad (Forest Department Sarawak)
            </li></ul></td></tr>
        <tr><td>12:30 PM – 1:45 PM</td><td>Lunch</td></tr>
        <tr><td colspan="2"><strong>Subtheme 1: Policy and Governance<br>Chairman: </strong>Tuan Haji Happysupina bin Sait (Forest Department Sarawak)</td></tr>
        <tr><td>1:45 PM – 2:00 PM</td><td>Session Commencement</td></tr>
        <tr><td>2:00 PM – 2:20 PM</td><td><strong>Paper 1:</strong> Digital Governance in Forestry: Enhancing STLVS Integrity and Revenue Efficiency as a Catalyst for Sarawak’s Green Economy<ul><li>Hasnaliza B.A. et al. (Forest Department Sarawak)</li></ul></td></tr>
        <tr><td>2:20 PM – 2:40 PM</td><td><strong>Paper 2:</strong> Unlocking Natural Capital: Sabah’s Policy Frameworks for a Forest-Based Green Economy <ul><li>Indra P. H. Sunjoto et al. (Sabah Forestry Department)</li></ul></td></tr>
        <tr><td>2:40 PM – 3:00 PM</td><td><strong>Paper 3:</strong> Penetapan Pendengaran Awam (Public Hearing) Bagi Pewartaan Keluar Hutan Simpanan Kekal (HSK) Di Semenanjung Malaysia<ul><li>Zarin R. et al. (Forestry Department of Peninsular Malaysia)</li></ul></td></tr>
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
        <tr><td colspan="2"><strong>Subtheme 2: Nature-Based Adaptation and Solution<br>Chairman: </strong>Tuan Haji Mohd. Ridzuwan Bin Endot (Forestry Department of Peninsular Malaysia)</td></tr>
        <tr><td>8:30 AM – 8:40 AM</td><td>Session Commencement</td></tr>
        <tr><td>8:40 AM – 9:00 AM</td><td><strong>Paper 5:</strong> Pengalaman Dan Cabaran Pengurusan Kebakaran Hutan Paya Gambut Di Selangor<ul><li>Amsari Bin Mahmud et al. (Forestry Department of Peninsular Malaysia)</li></ul></td></tr>
        <tr><td>9:00 AM – 9:20 AM</td><td><strong>Paper 6:</strong> Estimating Aboveground Forest Carbon Density through LiDAR and Geospatial Remote Sensing in Sarawak<ul><li>Dr Malcom anak Demies et al. (Forest Department Sarawak)</li></ul></td></tr>
        <tr><td>9:20 AM – 9:40 AM</td><td><strong>Paper 7:</strong> A Review: Ecological Dynamics of Tropical Highland Peat Ecosystems<ul><li>Iqtie Qamar Laila Mohd Gani et al. (Forestry Department of Peninsular Malaysia)</li></ul></td></tr>
        <tr><td>9:40 AM – 10:00 AM</td><td><strong>Paper 8:</strong> Nature, Climate, and Economy: Sabah’s Pathway Through Nature-Based Solutions<ul><li>Rosila Anthony et al. (Sabah Forestry Department)</li></ul></td></tr>
        <tr><td>10:00 AM – 10:10 AM</td><td>Question and Answer Session</td></tr>
        <tr><td>10:10 AM – 10:30 AM</td><td>Refreshments</td></tr>
        <tr><td colspan="2"><strong>Subtheme 3: Partnership and Collaboration<br>Chairman: </strong>Tuan Muhamad Bin Abdullah (Forestry Department of Peninsular Malaysia)</td></tr>
        <tr><td>10:30 AM – 10:40 AM</td><td>Session Commencement</td></tr>
        <tr><td>10:40 AM – 11:00 AM</td><td><strong>Paper 9:</strong> Sabah Timber Legality Assurance System Plus (TLAS+): Advancing Timber Legality through International Collaboration<ul><li>Mijol R. M et al. (Sabah Forestry Department)</li></ul></td></tr>
        <tr><td>11:00 AM – 11:20 AM</td><td><strong>Paper 10:</strong> Operasi Penguatkuasaan Bersepadu Jabatan Perhutanan Semenanjung Malaysia<ul><li>Gana R.K et al. (Forestry Department of Peninsular Malaysia)</li></ul></td></tr>
        <tr><td>11:20 AM – 11:40 AM</td><td><strong>Paper 11:</strong> Digitalizing Conservation Governance: [HOBS] A Cross-Agency Project Management System for the Heart of Borneo in Sarawak<ul><li>Meliza Binti Mohd Rizan et al. (Forest Department Sarawak)</li></ul></td></tr>
        <tr><td>11:40 AM – 12:00 PM</td><td><strong>Paper 12: </strong>Small Mammal Diversity in Borneo: Insights from Historical Records and Collaborative Biodiversity Assessments<ul><li>Professor Ts. Dr. Faisal Ali bin Anwarali Khan et al. (Unimas)</li></ul></td></tr>
        <tr><td>12:00 PM – 12:10 PM</td><td>Question and Answer Session</td></tr>
        <tr><td>12:10 PM – 1:30 PM</td><td>Lunch</td></tr>
        <tr><td colspan="2"><strong>Subtheme 4: Biodiversity Research and Conservation<br>Chairman:</strong> Dr. Arthur Chung Yaw Chyang (Sabah Forestry Department)</td></tr>
        <tr><td>1:30 PM – 1:40 PM</td><td>Session Commencement</td></tr>
        <tr><td>1:40 PM – 2:00 PM</td><td><strong>Paper 13:</strong> Ekspedisi Saintifik Kepelbagaian Biologi Hutan: Pencapaian dan Hala Tuju<ul><li>Siti Khatijah Othman et al. (Forestry Department of Peninsular Malaysia)</li></ul></td></tr>
        <tr><td>2:00 PM – 2:20 PM</td><td><strong>Paper 14:</strong> Developing a Forest Reference Level Monitoring System in Sabah: Integrating Field Biometrics and Remote Sensing for Biodiversity Conservation and Sustainable Forest Management<ul><li>Reuben Nilus et al. (Sabah Forestry Department)</li></ul></td></tr>
        <tr><td>2:20 PM – 2:40 PM</td><td><strong>Paper 15:</strong> The use of UAV-based LiDAR for Forest Volume Modeling in Sarawak<ul><li>Bibian Diway et al. (Forest Department Sarawak)</li></ul></td></tr>
        <tr><td>2:40 PM – 3:00 PM</td><td><strong>Paper 16: </strong>An Overview of Orangutan Conservation in Sarawak for the Next Decade<ul><li>Aliana Binti Affendi et al. (Sarawak Forestry Corporation)</li></ul></td></tr>
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
        <tr><td>4:20 PM – 4:40 PM</td><td><strong>Paper 19:</strong> Forest Landscape Restoration Approaches to Strengthen Forest Sustainability In Peninsular Malaysia<ul><li>M. Hafni et al. (Forestry Department of Peninsular Malaysia)</li></ul></td></tr>
        <tr><td>4:40 PM – 5:00 PM</td><td><strong>Paper 20:</strong> Shifting Dependency on Natural Forests to Forest Plantations in Support of Forest Landscape Sustainability<ul><li>Heidi Henry William et al. (Sabah Forestry Department)</li></ul></td></tr>
        <tr><td>5:00 PM – 5:20 PM</td><td><strong>Paper 21:</strong> Transforming Industrial Forest Plantations through R&D and Certification: Samling’s Experience In Sarawak, Malaysia.<ul><li>Roger Tami et al. (Samling Reforestation [Bintulu] Sdn. Bhd.)</li></ul></td></tr>
        <tr><td>5:20 PM – 5:30 PM</td><td>Question and Answer Session</td></tr>
        <tr><td>5:30 PM</td><td>End of Day 2</td></tr>
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
        <tr><td colspan="2"><strong>Subtheme 6: Social Forestry &amp; Ecotourism<br>Chairman:</strong> Tuan Indra Purwandita bin Herry Sunjoto (Sabah Forestry Department)</td></tr>
        <tr><td>8:30 AM – 8:40 AM</td><td>Session Commencement</td></tr>
        <tr><td>8:40 AM – 9:00 AM</td><td><strong>Paper 22:</strong> Sosial Forestry in Sarawak: An Update.<ul><li>Suliman Bin Haji Jamahari et al. (Forest Department Sarawak)</li></ul></td></tr>
        <tr><td>9:00 AM – 9:20 AM</td><td><strong>Paper 23:</strong> Beyond Conservation: Community Participation as a Driver of Green Economy in Sabah’s Forest Landscapes<ul><li>E.B. Johnlee et al. (Sabah Forestry Department)</li></ul></td></tr>
        <tr><td>9:20 AM – 9:40 AM</td><td><strong>Paper 24:</strong> Pengurusan Kawasan Pendakian Di Dalam Hutan Simpanan Kekal Di Semenanjung Malaysia<ul><li>Reanee Lee et al. (Forestry Department of Peninsular Malaysia)</li></ul></td></tr>
        <tr><td>9:40 AM – 10:00 AM</td><td><strong>Paper 25:</strong> Community-based Tourism and its Contribution to  Local Economies: Insights from Peros<ul><li>Madeline George Pau et al. (Forest Department Sarawak)</li></ul></td></tr>
        <tr><td>10:00 AM – 10:10 AM</td><td>Question and Answer Session</td></tr>
        <tr><td>10:10 AM – 10:55 AM</td><td>Refreshments</td></tr>
        <tr><td colspan="2"><strong>Closed Sessions (For Members Only)</strong></td></tr>
        <tr><td>10:55 AM – 11:00 AM</td><td>Session Commencement</td></tr>
        <tr><td>11:00 AM – 12:30 PM</td><td>Conference Resolution Presentation and Adoption</td></tr>
        <tr><td colspan="2"><strong>Closing Ceremony</strong></td></tr>
        <tr><td>12:30 PM – 1:30 PM</td><td><strong>Closing Ceremony</strong><ul><li>Arrival of YBhg Datu Haji Abdullah Bin Julaihi, Permanent Secretary, Ministry of Natural Resources and Urban Development</li>
        <li>Negaraku and Ibu Pertiwiku</li>
      <li>Recital of Doa</li>
    <li>Closing Address by Permanent Secretary</li>
    <li>Presentation of Souvenirs</li>
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
 <section id="speakers">
    <span class="section-label">Our Presenters</span>
    <h2>Biography</h2>

    <h3 class="group-title">Keynote Address & Main Working Paper</h3>
    <div class="speakers-grid">

      <!-- Day 1: Keynote -->
      <div class="speaker-card" onclick="showSpeakerModal('Prof. Emeritus Dato Dr. Ibrahim Komoo','Research Fellow, Geopark Research Centre (PPG)','Universiti Kebangsaan Malaysia','{{ asset('images/talker/PROF EMERITUS DATO DR IBRAHIM KOMOO.png') }}','Emeritus Professor (Engineering Geology) at Universiti Kebangsaan Malaysia (UKM), he is an internationally recognised expert in engineering geology, geological disasters, environmental geoscience, geoparks, and geotourism. He has held several prominent leadership roles, including Founder Vice President of the Global Geoparks Network (GGN), Founder Vice Chairman of the Asia Pacific Geopark Network (APGN), Founder Vice Chair of the UNESCO Global Geopark Council (UGGpC), Senior Evaluator for UNESCO Global Geoparks, and Chairman of the National Heritage Council. Through these roles, he has made significant contributions to the development of geoparks, geological heritage conservation, and environmental sustainability at both regional and global levels. His distinguished achievements have been recognised with the Langkawi Award (2009), the IUGS Science Excellence Award in Environmental Geology (2013), the ASEAN Biodiversity Heroes Award (2022), and the Malaysian Geologist Laureate Award (2026).')">
        <img src="{{ asset('images/talker/PROF EMERITUS DATO DR IBRAHIM KOMOO.png') }}" alt="Prof. Emeritus Dato Dr. Ibrahim Komoo" />
        <strong>Prof. Emeritus Dato Dr. Ibrahim Komoo</strong>
        <span>Keynote Speaker</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Datuk Zulkifli bin Suara','Chief Conservator of Forests','Sabah Forestry Department','{{ asset('images/talker/DATUK SUARA.png') }}','Datuk Zulkifli bin Suara is the Chief Conservator of Forests at the Sabah Forestry Department, with more than 30 years of experience in the forestry sector. He holds a Bachelor of Science in Forestry from Universiti Putra Malaysia and a Diploma in Forestry from Universiti Pertanian Malaysia. Throughout his career, he has served in various key positions, including Planning Officer, Assistant District Forest Officer, District Forest Officer, Monitoring, Controlling, Enforcement and Evaluation Officer, Head of Investigation, Enforcement and Prosecution Division, and Deputy Chief Conservator of Forests (Operation). His expertise encompasses forest operations, forest enforcement, prosecution, forest governance, and regional forestry cooperation. He has represented the Sabah Forestry Department at numerous national and international platforms and has received multiple excellence awards in recognition of his leadership and contributions to the forestry sector.')">
        <img src="{{ asset('images/talker/DATUK SUARA.png') }}" alt="Datuk Zulkifli bin Suara" />
        <strong>Datuk Zulkifli bin Suara</strong>
        <span>Main Working Paper 1 Speaker</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Tuan Muhamad Bin Abdullah','Senior Director of the Forest Planning and Economics Division','Forestry Department of Peninsular Malaysia','{{ asset('images/talker/TUAN ABDULLAH.png') }}','Tuan Muhamad bin Abdullah is the Senior Director of the Forest Planning and Economics Division at the Forestry Department of Peninsular Malaysia, bringing nearly two decades of experience to the role since joining the department in July 2006. His extensive expertise bridges forestry and social sciences, focusing on forest planning, policy development, governance, and anti-corruption studies. Throughout his career, he has contributed to key national and international initiatives, including legislative reform, climate change, biodiversity conservation, and the Malaysian Criteria and Indicators for Sustainable Forest Management (MC&I SFM). In recognition of his distinguished public service, he was conferred the Darjah Ahli Mahkota Perak by the Perak Government, and he continues his leadership in the sector as the Chairman of Subtheme 1 (Policy and Governance) for the 21st Malaysian Forestry Conference (MFC-21).')">
        <img src="{{ asset('images/talker/TUAN ABDULLAH.png') }}" alt="Tuan Muhamad Bin Abdullah" />
        <strong>Tuan Muhamad Bin Abdullah</strong>
        <span>Main Working Paper 3 Speaker</span>
      </div>
      <div class="speaker-card" onclick="showSpeakerModal('Datu Haji Hamden Bin Haji Mohammad','Director of Forests Sarawak','Forest Department Sarawak','{{ asset('images/talker/HAJI HAMDEN.png') }}','Datu Haji Hamden bin Haji Mohammad has served as the Director of Forests Sarawak since 2018 and is widely recognised for his leadership in sustainable forest management, biodiversity conservation, climate change mitigation, environmental governance, and natural resource policy. He has led the development and implementation of forestry policies and programmes that strengthen sustainable forest management, enhance forest certification, and promote the adoption of advanced technologies such as LiDAR, remote sensing, drones, and geospatial analytics for forest monitoring and conservation. Among his key achievements are leading the Greening Sarawak Campaign under Malaysia\'s 100 Million Trees Campaign, championing forest carbon initiatives and nature-based climate solutions, and fostering strategic collaborations with international organisations and research institutions. Under his leadership, Sarawak exceeded its tree-planting target ahead of schedule and successfully secured the UNESCO Global Geopark designation for the Sarawak Delta Geopark, reinforcing the state\'s international reputation in sustainable forestry and environmental stewardship.')">
        <img src="{{ asset('images/talker/HAJI HAMDEN.png') }}" alt="Datu Haji Hamden Bin Haji Mohammad" />
        <strong>Datu Haji Hamden Bin Haji Mohammad</strong>
        <span>Main Working Paper 3 Speaker</span>
      </div>
    </div>

    <h3 class="group-title" style="margin-top:36px;">Session Chairmen</h3>
    <div class="speakers-grid">

      <div class="speaker-card" onclick="showSpeakerModal('Tuan Haji Happysupina Bin Sait','Deputy Director of Forest (Conservation & Development)','Forest Department Sarawak','{{ asset('images/talker/HAJI HAPPYSUPINA.png') }}','Happysupina Bin Sait is the Deputy Director of Forest (Conservation & Development) at the Forest Department Sarawak, a role he has held since January 2023 to lead strategic initiatives in forest conservation, innovation, and sustainable development. Since joining the department in 1995, he has accumulated over 30 years of experience across forestry administration, licensing, revenue management, and strategic planning, holding key leadership positions such as Head of Regional Forest Offices in Sibu and Kuching. Notably, during his tenure as Chief Information Officer from 2014 to December 2020, he spearheaded major digital transformation initiatives and coordinated vital frameworks, including the Forest Department Sarawak Strategic Plan 2021–2025 and PCDS 2030 initiatives. Happysupina holds a Bachelor of Science in Forestry from Universiti Pertanian Malaysia and a Master of Science in Project Management from Curtin University Malaysia.')">
        <img src="{{ asset('images/talker/HAJI HAPPYSUPINA.png') }}" alt="Tuan Haji Happysupina Bin Sait" />
        <strong>Tuan Haji Happysupina Bin Sait</strong>
        <span>Session 1 Chairman · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Tuan Haji Mohd. Ridzuwan Bin Endot','Senior Director of the Forest Management Division','Forestry Department of Peninsular Malaysia','{{ asset('images/talker/RIDZUWAN.png') }}','Tuan Haji Mohd Ridzuwan bin Endot, born in Pokok Sena, Kedah in 1968, is a highly experienced registered Forester (IRIM-171) with 34 years of extensive expertise in the forestry sector. A graduate of UPM and UKM, he has dedicated his career to the Forestry Department of Peninsular Malaysia (FDPM), specializing in key areas such as silviculture, sustainable forest management, peatland management, carbon credits, and degraded forest restoration. Throughout his distinguished career, he has held prominent administrative roles, including Director of the Selangor State Forestry Department, Director of the Silviculture Division, and Senior Director of the Forest Management Division at FDPM. In addition to his leadership duties, he is an active researcher who frequently authors local and international scientific papers, serves as an expert panellist, and dedicates his time to community healthcare volunteer work.')">
        <img src="{{ asset('images/talker/RIDZUWAN.png') }}" alt="Tuan Haji Mohd. Ridzuwan Bin Endot" />
        <strong>Tuan Haji Mohd. Ridzuwan Bin Endot</strong>
        <span>Session 2 Chairman · Forestry Department of Peninsular Malaysia</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Tuan Muhamad Bin Abdullah','Senior Director of the Forest Planning and Economics Division','Forestry Department of Peninsular Malaysia','{{ asset('images/talker/TUAN ABDULLAH.png') }}','Tuan Muhamad bin Abdullah is the Senior Director of the Forest Planning and Economics Division at the Forestry Department of Peninsular Malaysia, bringing nearly two decades of experience to the role since joining the department in July 2006. His extensive expertise bridges forestry and social sciences, focusing on forest planning, policy development, governance, and anti-corruption studies. Throughout his career, he has contributed to key national and international initiatives, including legislative reform, climate change, biodiversity conservation, and the Malaysian Criteria and Indicators for Sustainable Forest Management (MC&I SFM). In recognition of his distinguished public service, he was conferred the Darjah Ahli Mahkota Perak by the Perak Government, and he continues his leadership in the sector as the Chairman of Subtheme 1 (Policy and Governance) for the 21st Malaysian Forestry Conference (MFC-21).')">
        <img src="{{ asset('images/talker/TUAN ABDULLAH.png') }}" alt="Tuan Muhamad Bin Abdullah" />
        <strong>Tuan Muhamad Bin Abdullah</strong>
        <span>Session 3 Chairman · Forestry Department of Peninsular Malaysia</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Dr. Chung Yaw Chyang','Session Chairman','Sabah Forestry Department','{{ asset('images/talker/ARTHUR CHUNG.png') }}')">
        <img src="{{ asset('images/talker/ARTHUR CHUNG.png') }}" alt="Dr. Chung Yaw Chyang" />
        <strong>Dr. Chung Yaw Chyang</strong>
        <span>Session 4 Chairman · Sabah Forestry Department</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Dr. Affendi bin Suhaili','Head of Forest Technology and Geospatial Division','Forest Department Sarawak','{{ asset('images/talker/DR AFFENDI.png') }}','Dr. Affendi bin Suhaili is the Head of the Forest Technology and Geospatial Division at the Forest Department Sarawak, bringing over three decades of expertise in precision forestry, geospatial science, and hyperspectral remote sensing. Beginning his career in 1991, he later established and directed the Systems Application and Development Unit (SADU) from 2008 to 2020, laying the groundwork for Sarawak\'s modern digital forestry framework before stepping into his current role to lead the division\'s digital transformation. He holds a PhD in Precision Forestry, a Bachelor of Forestry, and a Diploma in Forestry from Universiti Putra Malaysia, and he spent a decade lecturing part-time on Remote Sensing and GIS at Universiti Malaysia Sarawak. An active researcher and author of over 20 scientific publications, Dr. Affendi frequently shares his expertise on forest monitoring and REDD+ readiness globally, bridging the gap between advanced spatial technologies and sustainable forest management.')">
        <img src="{{ asset('images/talker/DR AFFENDI.png') }}" alt="Dr. Affendi bin Suhaili" />
        <strong>Dr. Affendi bin Suhaili</strong>
        <span>Session 5 Chairman · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Indra P. H. Sunjoto','Deputy Chief Conservator of Forests (Planning & Management)','Sabah Forestry Department','{{ asset('images/talker/INDRA PH SUNJOTO.png') }}','Indra Purwandita H. Sunjoto has been working in the Sabah Forestry Department for 30 years. He was assigned as District Forestry Officer and gained experiences in managing Forest Management Unit at several districts. He has experience in implementing sustainable forest management concepts, from planning, management, assessment and operation. He has been actively involved on forest conservation & protection programme, forest rehabilitation, wildlife monitoring and habitat management, forest fire management, timber legality assurance system, forest certification and payment for ecosystem services (PES). He is also responsible on forest protection programme, particularly on anti-poaching programme in Sabah.')">
        <img src="{{ asset('images/talker/INDRA PH SUNJOTO.png') }}" alt="Indra P. H. Sunjoto" />
        <strong>Indra P. H. Sunjoto</strong>
        <span>Session 6 Chairman · Sabah Forestry Department</span>
      </div>

    </div>

    <!-- ═══════════════════════════════════════════════════════ -->
    <!-- GROUP 2: PAPER PRESENTERS / SPEAKERS                     -->
    <!-- ═══════════════════════════════════════════════════════ -->
    <h3 class="group-title" style="margin-top:36px;">Speakers</h3>
    <div class="speakers-grid">

      <div class="speaker-card" onclick="showSpeakerModal('Hasnaliza B.A.','Senior Research Officer','Forest Department Sarawak','{{ asset('images/talker/HASNALIZA.png') }}','Hasanaliza Binti Bujang Abdillah is the Head of the Forest Supply Chain Operations and Compliance Section within the Revenue and Data Management Division at the Forest Department Sarawak, bringing over 16 years of expertise in forestry revenue management, supply chain compliance, and sustainable governance. She holds a Bachelor of Science in Aquatic Resource Science & Management and a Master of Science in Environmental Science from UNIMAS, along with a foundational background in forest plantation soil research. Throughout her career, Hasanaliza has managed revenue operations at local and headquarters levels and supported the development of key digital systems like LoTS, RBS, and REVLOG. Furthermore, in her role as Secretariat for the Sarawak Timber Legality Verification System (STLVS), she oversees certification and auditor renewals, leveraging her core strengths in compliance and digital transformation to advance transparent and sustainable forest administration.')">
        <img src="{{ asset('images/talker/HASNALIZA.png') }}" alt="Hasnaliza B.A." />
        <strong>Hasnaliza B.A.</strong>
        <span>Paper 1 Presenter · Forest Department Sarawak</span>
      </div>

      <!-- Dual-role duplicate: also Session 6 Chairman above -->
      <div class="speaker-card" onclick="showSpeakerModal('Indra P. H. Sunjoto','Deputy Chief Conservator of Forests (Planning & Management)','Sabah Forestry Department','{{ asset('images/talker/INDRA PH SUNJOTO.png') }}','Indra Purwandita H. Sunjoto has been working in the Sabah Forestry Department for 30 years. He was assigned as District Forestry Officer and gained experiences in managing Forest Management Unit at several districts. He has experience in implementing sustainable forest management concepts, from planning, management, assessment and operation. He has been actively involved on forest conservation & protection programme, forest rehabilitation, wildlife monitoring and habitat management, forest fire management, timber legality assurance system, forest certification and payment for ecosystem services (PES). He is also responsible on forest protection programme, particularly on anti-poaching programme in Sabah.')">
        <img src="{{ asset('images/talker/INDRA PH SUNJOTO.png') }}" alt="Indra P. H. Sunjoto" />
        <strong>Indra P. H. Sunjoto</strong>
        <span>Paper 2 Presenter · Sabah Forestry Department</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Zarin R.','Assistant Director Enforcement (Prevention)','Forestry Department of Peninsular Malaysia','{{ asset('images/talker/ZARIN R.png') }}','This highly experienced forestry professional holds a comprehensive academic background, including a Diploma of Forestry from UPM, a Bachelor of Science in Forestry from UMS, and a recently completed Master of Science in Conservation Biology from UKM (2025). They have built a diverse career within the Forestry Department of Peninsular Malaysia (FDPM), developing deep expertise through both administrative and field-based roles. Their foundational experience includes resource planning and silviculture management in Pahang, followed by a tenure as Assistant Director of Forest Eco-Park and State Park Forest. They went on to serve as the Jerantut District Forest Officer from 2017 to 2021 before moving into legal and enforcement roles, serving as Assistant Director of Legislation III and undertaking specialized training. Currently, they apply their extensive background in conservation, law, and field management as the Assistant Director of Enforcement (Prevention) within FDPM’s Forest Enforcement Division.')">
        <img src="{{ asset('images/talker/ZARIN R.png') }}" alt="Zarin R." />
        <strong>Zarin R.</strong>
        <span>Paper 3 Presenter · Forestry Department of Peninsular Malaysia</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Vilma Bodos','Research Officer','Forest Department Sarawak','{{ asset('images/talker/VILMA ANAK BODOS.png') }}','This experienced forestry and plant conservation professional possesses 19 years of expertise spanning forest ecology, tree diversity and High Conservation Value Area (HCVA) assessments, and sustainable forest management. After serving as an Environment Executive with the Sarawak Forestry Corporation from 2007 to 2020, they joined the Forest Department Sarawak in 2020 as a Research Officer in the Research & Development Division, where they focus on forest research and species conservation planning. A recognized expert in tree conservation and forestry policy, they are actively involved in national and international red listing and CITES initiatives, and contribute to global conservation frameworks as a member of the IUCN Global Tree Specialist Group.')">
        <img src="{{ asset('images/talker/VILMA ANAK BODOS.png') }}" alt="Vilma Bodos" />
        <strong>Vilma Bodos</strong>
        <span>Paper 4 Presenter · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Amsari Bin Mahmud','Deputy Director (Development) Selangor State Forestry Development','Selangor State Forestry Department','{{ asset('images/talker/AMSARI.png') }}','This highly experienced forestry officer brings over 20 years of expertise to his role, specializing in the sustainable management of tropical forests, development programmes, and ecological conservation. He has played a key role in regional environmental connectivity by overseeing the implementation of the Central Forest Spine (CFS) initiative in Selangor. A leader in large-scale ecological restoration, he has been responsible for planning and coordinating the 100 Million Tree-Planting Campaign (2021–2025) at the national level, alongside managing Selangor\'s 26 Million Tree-Planting Programme (2022–2026). Additionally, as the State Project Coordinator for the SMPEM Project, he leads localized project delivery to ensure strict compliance with grant requirements, optimal resource efficiency, and the successful achievement of national sustainability outcomes.')">
        <img src="{{ asset('images/talker/AMSARI.png') }}" alt="Amsari Bin Mahmud" />
        <strong>Amsari Bin Mahmud</strong>
        <span>Paper 5 Presenter · Forestry Department of Peninsular Malaysia</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Dr Malcom anak Demies','Head, Forest Carbon Unit','Forest Department Sarawak','{{ asset('images/talker/DR MALCOM DEMIES.png') }}','Dr. Malcom Anak Demies is the Head of the Forest Carbon Unit at the Forest Department Sarawak, bringing over 25 years of research and field experience in the state\'s diverse rainforests. He holds a BSc in Conservation Biology and Ecology of Tropical Forests, an MSc in Botany from UKM, and a PhD in Tropical Ecology and Forestry from UNIMAS. A pioneer in the region\'s forestry practices, Dr. Malcom introduced High Conservation Value Forest assessments to Sarawak—enabling the certification of over ten Forest Management Units—and served as the principal architect of the state\'s forest carbon management framework, which was instrumental in enacting the Forests (Forest Carbon Activity) Rules, 2022. His extensive technical expertise spans traditional and LiDAR-based carbon stock measurement, MRV systems, GIS, and carbon policy development, successfully bridging rigorous science with practical governance to position Sarawak as a leader in climate change mitigation.')">
        <img src="{{ asset('images/talker/DR MALCOM DEMIES.png') }}" alt="Dr Malcom anak Demies" />
        <strong>Dr Malcom anak Demies</strong>
        <span>Paper 6 Presenter · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Iqtie Qamar Laila Mohd Gani','Principle Assistant Director (Development)','Pahang State Forestry Department','{{ asset('images/talker/IQTIE.jpg') }}','This highly qualified forestry professional holds a Bachelor Degree in Forestry Science from Universiti Malaysia Sabah and a Master Degree in Forest Management and Economics from Beijing Forestry University. Over an extensive career with the Forestry Department of Peninsular Malaysia, they have held numerous key administrative and field positions, beginning in 2009 as Assistant Director of Extension before advancing through roles in planning, corporate communication, and enforcement across Pahang and Kelantan. After serving as Senior Assistant Director of International Affairs at the department\'s headquarters starting in 2019, they were appointed as the Principal Assistant Director of Development for the Pahang State Forestry Department in October 2025, bringing diverse expertise in enforcement, international relations, and regional forest development to their leadership.')">
        <img src="{{ asset('images/talker/IQTIE.jpg') }}" alt="Iqtie Qamar Laila Mohd Gani" />
        <strong>Iqtie Qamar Laila Mohd Gani</strong>
        <span>Paper 7 Presenter · Forestry Department of Peninsular Malaysia</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Rosila Anthony','Head of Division (Forest Sector Planning)','Sabah Forestry Department','{{ asset('images/talker/ROSILA ANTHONY.png') }}','Rosila Anthony is a key figure in the Sabah Forestry Department (SFD) and leads various important initiatives in forest management and climate change action. She holds a MSc holder in Tropical Forest Resource Management from Universiti Putra Malaysia (UPM) and has been with the Sabah Forestry Department (SFD) since 1992. As the Head of the Forest Sector Planning Division, she coordinates with government and international organizations on forestry matters and spearheads projects such as the EU funded Tackling Climate Change through Sustainable Forest Management and Community Development Project, Sustainable Use of Peatland and Haze Mitigation in ASEAN (SUPA) Project, Sustainable Management of Peatland Ecosystem in Malaysia (SMPEM), and the GEF-UNDP FOLUR Impact Program. Additionally, she plays a vital role in the Secretariat of the Sabah Climate Change Action Council (SCAC), focusing on climate-related forestry projects like REDDPlus, PES, and NBS.')">
        <img src="{{ asset('images/talker/ROSILA ANTHONY.png') }}" alt="Rosila Anthony" />
        <strong>Rosila Anthony</strong>
        <span>Paper 8 Presenter · Sabah Forestry Department</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Mijol R. M.','Head of Section Forest Audit, Sustainable Forest Management Division','Sabah Forestry Department','{{ asset('images/talker/MIJOL RM.png') }}','Robert Martin Mijol is the Head of the Forest Audit Section at the Sabah Forestry Department, holding a Bachelor’s Degree in Biotechnology from Universiti Malaysia Sabah and nearly two decades of forestry experience since joining the sector in 2007. He began his career with the Heart of Borneo Initiative focusing on transboundary conservation before stepping into the role of District Forestry Officer for the Ulu Segama-Malua Forest Reserve in 2016, where he championed sustainable forest management and FSC certification. Since 2021, he has overseen forest certification and Sabah Timber Legality Assurance System (Sabah TLAS) auditing under the Sustainable Forest Management Division. Notably, his recent efforts to align regional frameworks with international regulations like the EUDR and EU CS3D culminated in the launch of the enhanced Sabah TLAS+ in February 2026, reinforcing his ongoing commitment to credible forest governance, traceability, and responsible timber trade.')">
        <img src="{{ asset('images/talker/MIJOL RM.png') }}" alt="Mijol R. M." />
        <strong>Mijol R. M.</strong>
        <span>Paper 9 Presenter · Sabah Forestry Department</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Gana R. K.','Assistant Director of Forest Enforcement (Forensics)','Forestry Department of Peninsular Malaysia','{{ asset('images/talker/GANA R.png') }}','Gana Raj Anak Katharayan from Sentul, Kuala Lumpur. Holds a Diploma in Forestry from UPM, a Bachelor of Forestry Science from UPM, and a Master\'s Degree in Science, Technology, and Innovation Policy from UTM. Has served with the Forestry Department Peninsular Malaysia (JPSM) for 16 years, including 2 years with the Forest Enforcement Division in the Forest Forensics Section. Cooperates with the Department of Chemistry Malaysia and the Forest Research Institute Malaysia (FRIM) in an effort to establish a Malaysia plant DNA database and Document Security for forest operations.')">
        <img src="{{ asset('images/talker/GANA R.png') }}" alt="Gana R. K." />
        <strong>Gana R. K.</strong>
        <span>Paper 10 Presenter · Forestry Department of Peninsular Malaysia</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Hajah Meliza Binti Mohd Rizan','Senior Executive Forester','Forest Department Sarawak','{{ asset('images/talker/MELIZA.jpg') }}','Hajah Meliza Bt Mohd Rizan is the Head of the Remote Sensing and Geodata Section under the Forest Technology and Geospatial Division, Forest Department Sarawak, with over 15 years of experience in the forestry sector since joining the department in 2010. Her expertise includes geospatial technologies, remote sensing, spatial data management, digital transformation, and sustainable forest governance. Throughout her career, she has served in the Licences for Planted Forests (LPF), Nature Conservation and Constitution Division (NCCD), Regional Forest Office Miri, Preventive and Enforcement Division (PED), and the Systems Application and Development Unit (SADU). She currently leads strategic geospatial and digital transformation initiatives, oversees the Enterprise Forest Information Management System (EFIMS) and Continuous Monitoring and Surveillance (COMOS), and serves as the Data Custodian for national forest geospatial datasets. She also actively promotes innovation in the forestry sector as Team Leader of the ConservaTech Group and has represented the department at the Innovative and Creative Group (KIK) Convention 2024 and Malaysia Expo Trade (MTE) 2025 through the EcoHub project.')">
        <img src="{{ asset('images/talker/MELIZA.jpg') }}" alt="Meliza Binti Mohd Rizan" />
        <strong>Meliza Binti Mohd Rizan</strong>
        <span>Paper 11 Presenter · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Prof. Ts. Dr. Faisal Ali bin Anwarali Khan','Dean, Faculty of Resource Science and Technology','Universiti Malaysia Sarawak','{{ asset('images/talker/FAISAL ALI.jpg') }}','Professor Faisal is a zoologist specialising in the systematics, evolution and taxonomy of small mammals, with particular emphasis on bats in Malaysia. He holds a PhD and MSc in Zoology from Texas Tech University, and a BSc (Hons) in Biotechnology Resource from Universiti Malaysia Sarawak (UNIMAS). His research is strongly grounded in field-based biodiversity studies, contributing to the documentation of bat diversity, species distributions, and community assemblages across tropical ecosystems particularly in Sarawak and wider Malaysia. He has been actively involved in biodiversity surveys and taxonomic work that support regional efforts to better understand and conserve small mammal fauna, an ecologically significant yet understudied component of Southeast Asian biodiversity.')">
        <img src="{{ asset('images/talker/FAISAL ALI.jpg') }}" alt="Prof. Ts. Dr. Faisal Ali bin Anwarali Khan" />
        <strong>Prof. Ts. Dr. Faisal Ali bin Anwarali Khan</strong>
        <span>Paper 12 Presenter · Universiti Malaysia Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Siti Khatijah Othman','Head of Section (Forest Biodiversity)','Forestry Department of Peninsular Malaysia','{{ asset('images/talker/SITI KHATIJAH.png') }}','SITI KHATIJAH BINTI OTHMAN serves as the Head of Section (Forest Biodiversity) at the Forestry Department of Peninsular Malaysia (FDPM). She holds a Bachelor of Forestry Science from University Putra Malaysia. Her career with FDPM began in 2010 as Assistant Director of Macro and Micro Planning. In 2016, she advanced to Assistant Director of Water Catchment Forest Management and Monitoring, focusing on conserving water catchment areas within Permanent Reserved Forests (HSK). In 2020, she was appointed to lead the Forest Planning and Management Unit at the Terengganu State Forestry Department. Promoted to Senior Assistant Director in 2025, she now is responsible for forest biodiversity conservation across Peninsular Malaysia. Her current key responsibilities include overseeing scientific biodiversity expeditions to explore HSK areas, strengthening the nation\'s scientific database, and ensuring evidence-based, sustainable forest resource management.')">
        <img src="{{ asset('images/talker/SITI KHATIJAH.png') }}" alt="Siti Khatijah Othman" />
        <strong>Siti Khatijah Othman</strong>
        <span>Paper 13 Presenter · Forestry Department of Peninsular Malaysia</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Reuben Nilus','Forest Ecologist','Sabah Forestry Department','{{ asset('images/talker/REUBEN NILUS.png') }}','Reuben Nilus is a Malaysian forest ecologist with the Sabah Forestry Department, where he has served at the Forest Research Centre in Sandakan since October 1994. He holds a Bachelor of Science in Botany from the University of Malaya and a PhD in Tropical Plant Ecology from the University of Aberdeen. Over more than three decades, his expertise has spanned forest dynamics, rehabilitation, conservation biology, and biodiversity monitoring, with a strong focus on ecosystem integrity and sustainable landscape management in Sabah. An active researcher and author, he has contributed extensively to High Conservation Value (HCV) assessments, ecological monitoring, and forest management plans, leveraging his scientific work to support evidence-based decision-making for forest conservation and the protection of ecosystem services.')">
        <img src="{{ asset('images/talker/REUBEN NILUS.png') }}" alt="Reuben Nilus" />
        <strong>Reuben Nilus</strong>
        <span>Paper 14 Presenter · Sabah Forestry Department</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Bibian Anak Micheal Diway','Executive Forester','Forest Department Sarawak','{{ asset('images/talker/BIBIAN MICHAEL DIWAY.png') }}','Bibian Diway is an experienced forestry professional who holds a Bachelor of Science in Forestry from Universiti Putra Malaysia and a Master of Plant Science from Universiti Malaysia Sarawak. Since beginning her career in 2001, she has focused on forest ecology and forest inventory, actively leading research projects in forest resources assessment, structural analysis, and monitoring to support sustainable forest management in Sarawak. While her foundational work relied on conventional assessment methods, her current research interests focus on integrating advanced technologies, such as drone-based LiDAR, for biomass estimation, forest volume modeling, and modern forest resource assessments.')">
        <img src="{{ asset('images/talker/BIBIAN MICHAEL DIWAY.png') }}" alt="Bibian Anak Micheal Diway" />
        <strong>Bibian Anak Micheal Diway</strong>
        <span>Paper 15 Presenter · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Aliana Binti Affendi','Conservation Officer','Sarawak Forestry Corporation, SFC','{{ asset('images/talker/ALIANA.jpg') }}','Aliana Affendi is a Conservation Officer within the Biodiversity Conservation and Research Division at the Sarawak Forestry Corporation (SFC). A graduate of Universiti Malaysia Sarawak (UNIMAS), her research and professional practice focus on the ecology and protection of terrestrial fauna, with a primary specialization in primate conservation. Since 2022, she has been instrumental in bridging the gap between field-based research and conservation policy, particularly through her contributions to developing and implementing species-specific action plan. With over four years of experience in the field, she has developed technical skills in wildlife surveys and managing an integrated wildlife project. Her current interests lie in applying emerging technologies to conservation biology. Through her work with the SFC, she continues to drive essential efforts for the protection and conservation of primate species and the long-term preservation of Sarawak’s unique biodiversity.')">
        <img src="{{ asset('images/talker/ALIANA.jpg') }}" alt="Aliana Binti Affendi" />
        <strong>Aliana Binti Affendi</strong>
        <span>Paper 16 Presenter · Sarawak Forestry Corporation</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Jonathan J. Lucas','Research Officer','Sabah Forestry Department','{{ asset('images/talker/JONATHAN J LUCAS.jpg') }}','Jonathan Jimmey Lucas is a Research Officer with the Systematic Botany Section (Sandakan Herbarium), Forest Research Centre, Sabah Forestry Department. He graduated with a Bachelor’s Degree with Honours in Forestry Science (International Tropical Forestry) from Universiti Malaysia Sabah in 2021. With over four years of experience in botanical and forestry research, he has been developing his expertise in forest inventory, plant taxonomy, herbarium management, and biodiversity conservation. His work focuses on documenting and conserving Sabah’s rich flora through field surveys, taxonomic research, and conservation assessments, contributing to evidence-based forest management and biodiversity conservation initiatives.')">
        <img src="{{ asset('images/talker/JONATHAN J LUCAS.jpg') }}" alt="Jonathan J. Lucas" />
        <strong>Jonathan J. Lucas</strong>
        <span>Paper 17 Presenter · Sabah Forestry Department</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Zarina Shebli','Head, Restoration and Industrial Forest Division','Forest Department Sarawak','{{ asset('images/talker/ZARINA SHEBLI.png') }}','Zarina Binti Haji Shebli is the Head of the Restoration and Industrial Forest Division at the Forest Department Sarawak, bringing nearly three decades of experience to her leadership of forest landscape restoration, industrial forest management, and research. She holds a Bachelor of Science in Forestry from Universiti Pertanian Malaysia (1993) and joined the department in 1996, building a career focused on forest conservation, gazettement, and community development. Zarina has served as Chief Local Counterpart and Project Manager for several International Tropical Timber Organization (ITTO) projects, partnering with local communities to advance sustainable forest management. Currently, she drives Sarawak’s Forest Landscape Restoration (FLR) agenda and the Greening Sarawak Campaign, earning multiple state and national awards for innovation and establishing Sarawak as a leading contributor to large-scale tree planting and environmental stewardship in Malaysia.')">
        <img src="{{ asset('images/talker/ZARINA SHEBLI.png') }}" alt="Zarina Shebli" />
        <strong>Zarina Shebli</strong>
        <span>Paper 18 Presenter · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('M. Hafni','Senior Assistant Director (Natural Forest Silviculture)','Forestry Department of Peninsular Malaysia','{{ asset('images/talker/HAFNI.png') }}','Holder of a Bachelor\'s Degree in International Tropical Science (University of Malaysia Sabah, UMS). Started working at the Peninsular Malaysia Forestry Department (FDPM) since 2009. Previously worked at the Kedah State Forestry Department (2009-2011), Kelantan State Forestry Department (2011-2015), Terengganu State Forestry Department (2015-2020). Currently working at the Silviculture & Forest Biological Conservation Division, FDPM')">
        <img src="{{ asset('images/talker/HAFNI.png') }}" alt="M. Hafni" />
        <strong>M. Hafni</strong>
        <span>Paper 19 Presenter · Forestry Department of Peninsular Malaysia</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Heidi Henry William','Head of Forest Plantation Section Sustainable Forest Management Division','Sabah Forestry Department','{{ asset('images/talker/HEIDI HENRY.png') }}','Heidi Henry William is the Head of the Forest Plantation Section at the Sabah Forestry Department. She holds a Bachelor of Forestry Science Degree (Wood Fibre & Technology) from Universiti Malaysia Sabah (UMS), and Master of Forestry Science from University of Canterbury, New Zealand. She has served in the Sabah Forestry Department since 2007, beginning from the Forest Sector Planning Division, specialized on project collaboration with local and international partners. Since 2023, Heidi became the Head of Forest Plantation Section under the Sustainable Forest Management Division. Her current portfolio focuses on overseeing the progress of forest plantation development in Sabah, which is crucial to ensure the sustainability and viability of the wood-based industry ')">
        <img src="{{ asset('images/talker/HEIDI HENRY.png') }}" alt="Heidi Henry William" />
        <strong>Heidi Henry William</strong>
        <span>Paper 20 Presenter · Sabah Forestry Department</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Roger Tami','Senior Manager, R&D','Samling Reforestation (Bintulu) Sdn. Bhd.','{{ asset('images/talker/ROGER TAMI.jpg') }}','Roger Richard Tami is an industrial forestry R&D and containerized nursery specialist who brings nearly three decades of tropical forest plantation experience to his role as Senior Manager, Research and Development at Samling Reforestation (Bintulu) Sdn. Bhd. He holds a Bachelor of Science in Botany, Conservation Biology, and Ecology from the National University of Malaysia, and his career has focused heavily on Acacia and Eucalyptus research, tree breeding, clonal screening, vegetative propagation, and pest management. Throughout his career, Roger has contributed to major industrial plantation programmes across Sarawak, Sabah, and Indonesia, working with prominent organizations like Samling, Jaya Tiasa Holdings, Sabah Forest Industries, Acacia Forestry Industry, and Sinarmas APP. In his current position, he leads the strategic transition from seed-based plantations to high-productivity clonal forestry, prioritizing genetic improvement, operational excellence, and certification-aligned plantation innovation.')">
        <img src="{{ asset('images/talker/ROGER TAMI.jpg') }}" alt="Roger Tami" />
        <strong>Roger Tami</strong>
        <span>Paper 21 Presenter · Samling Reforestation (Bintulu) Sdn. Bhd.</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Suliman Bin Haji Jamahari','Senior Assistant Director (Social Forestry Division)','Forest Department Sarawak','{{ asset('images/talker/SULIMAN HAJI JAMAHARI.png') }}','Graduated from Universiti Pertanian Malaysia with a Bachelor of Science (Hons) in Forestry in 1995. He started his career as a Production Executive with the Samling Strategic Corporation in 1995 in Miri and joined the Forest Department Sarawak in 1996. He served in many roles, such as Warden of the Gunung Mulu World Heritage Area, Ramsar Site Manager, interim Project Manager of the Asia Pacific Forest Network (APFNet), Project Coordinator of the United Nations Development Programme-Global Environmental Facility (UNDP-GEF), and Head of the Enforcement Division. His current position is Senior Assistant Director of Forests in charge of the Social Forestry Division.')">
        <img src="{{ asset('images/talker/SULIMAN HAJI JAMAHARI.png') }}" alt="Suliman Bin Haji Jamahari" />
        <strong>Suliman Bin Haji Jamahari</strong>
        <span>Paper 22 Presenter · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('E. B. Johnlee','Head of Forest Socio-Economic Programme, Forest Research Centre','Sabah Forestry Department','{{ asset('images/talker/EB JOHNLEE.png') }}','ELNE BETRECE JOHNLEE is the Head of the Forest Socioeconomic Programme at the Forest Research Centre (FRC), Sabah Forestry Department (SFD). She holds a Bachelor of Science and a Master of Science in Forestry from Universiti Malaysia Sabah. Since joining SFD in 2011, she has served in various capacities, including as a FLEGT Officer under the Sustainable Forest Management (SFM) Division, where she was involved in Timber Legality Assurance System (TLAS) and Sustainable Forest Management License Agreement (SFMLA) audits. In 2013, she served as Assistant District Forest Officer in Beaufort, and since 2015 has been attached to the Forest Research Centre, focusing on research and development. Her research interests include social forestry, forest socioeconomics, community participation in SFM, ecosystem services assessment, social impact assessment, forest recreation and ecotourism, ethnobotany, and agroforestry, with a focus on integrating social dimensions into forest conservation, sustainable livelihoods, and evidence-based forest governance in Sabah.')">
        <img src="{{ asset('images/talker/EB JOHNLEE.png') }}" alt="E. B. Johnlee" />
        <strong>E. B. Johnlee</strong>
        <span>Paper 23 Presenter · Sabah Forestry Department</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Reanee Lee','Head, Forest Eco-Park & State Park Forest, FDPM','Forestry Department Peninsular Malaysia','{{ asset('images/talker/REANEE LEE.png') }}','This forestry and policy professional holds a Bachelor of Forestry Science with Honours in Nature Park & Recreation from Universiti Malaysia Sabah and a Master in Science, Technology, and Innovation Policy from Universiti Teknologi Malaysia. They began their career in 2009 as a Park and Recreation Planner at EKM Landscape Architect before joining the Forestry Department of Peninsular Malaysia (FDPM) in 2011, serving five years as Assistant Director in the Legal and Prosecution Division. They subsequently expanded their field experience as Assistant Director of Enforcement and Industrial Production at the Kedah State Forestry Department, followed by a five-year tenure managing in-situ and ex-situ conservation within FDPM\'s Silviculture & Forest Biodiversity Conservation Division. Currently, they leverage this extensive background in law, planning, and conservation to serve as the Head Section of Forest Eco-Park & State Park Forest at FDPM headquarters.')">
        <img src="{{ asset('images/talker/REANEE LEE.png') }}" alt="Reanee Lee" />
        <strong>Reanee Lee</strong>
        <span>Paper 24 Presenter · Forestry Department of Peninsular Malaysia</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal(
          'Madeline George Pau',
          'Head, Geopark Management Unit',
          'Forest Department Sarawak',
          '{{ asset('images/talker/MADELINE GEORGE PAU.png') }}',
          'Madeline holds a Bachelor of Science in Forestry (Hons) from Universiti Pertanian Malaysia (1993) and a Master of Environmental Science (Land Use and Water Resource Management) from Universiti Malaysia Sarawak (2024) then joining the department as an Executive Forester, beginning in Sustainable Forest Management. Over the years she has served as Coordinator of the Heart of Borneo Initiatives (2008-2010; 2018-2020) and the FAO-EU-FLEGT Project (2018-2019). From 2020 to 2023, she headed the Consitution and Conservation Division. In 2024, she pioneered the establishment and leading the Geopark Management Unit, coordination the management and development of the Sarawak Delta Geopark. Under her coordination, Sarawak Delta achience designation as a UNESCO Global Geopark in April 2026, marking a significant milestone for Sarawak and Malaysia'
        )">
        <img src="{{ asset('images/talker/MADELINE GEORGE PAU.png') }}" alt="Madeline George Pau" />
        <strong>Madeline George Pau</strong>
        <span>Paper 25 Presenter · Forest Department Sarawak</span>
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
                            @if($slide->pdf_path)
                                <a href="{{ asset('storage/' . $slide->pdf_path) }}" target="_blank" >↓ PDF</a>
                            @else
                                <span style="color:var(--text-soft); font-size:13px;">—</span>
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
                        <span class="contact-name">Wilma Anak Manchu</span>
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

            <div class="footer-group">
                <h3 class="group-title">Technical Support</h3>
                <div class="footer-contacts">
                    <a href="https://wa.me/60182804204" target="_blank" class="footer-contact-item">
                        <span class="contact-name">Adriana Ardi</span>
                        <span class="contact-number">018-2804204</span>
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
<div id="speakerModal" class="modal" style="display:none;">
      <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>

      <img id="modalImg" src="" alt="Speaker" class="modal-avatar" />

      <h2 id="modalName"></h2>
      <p id="modalTitle" class="modal-role"></p>
      <p id="modalCompany" class="modal-org"></p>

      <div class="modal-bio-wrap">
        <p id="modalBio" class="modal-bio"></p>
      </div>
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
    function showSpeakerModal(name, title, company, imgSrc, bio) {
      document.getElementById('modalImg').src = imgSrc;
      document.getElementById('modalName').textContent = name;
      document.getElementById('modalTitle').textContent = title;
      document.getElementById('modalCompany').textContent = company;

      const bioEl = document.getElementById('modalBio');
      const bioWrap = document.querySelector('.modal-bio-wrap');

      if (bio && bio.trim().length > 0) {
        bioEl.textContent = bio;
        bioWrap.style.display = 'block';
      } else {
        bioWrap.style.display = 'none'; // hide gracefully if no bio given
      }

      document.getElementById('speakerModal').style.display = 'flex';
      document.body.style.overflow = 'hidden'; // stop background scroll on mobile
    }

    function closeModal() {
      document.getElementById('speakerModal').style.display = 'none';
      document.body.style.overflow = '';
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
    document.body.style.overflow = 'hidden';   // lock background scroll, same as speaker modal
    document.body.style.position = 'fixed';    // iOS Safari needs this too, not just overflow
    document.body.style.width = '100%';
}

function closeAttendanceModal() {
    document.getElementById('attendanceModal').style.display = 'none';
    document.body.style.overflow = '';
    document.body.style.position = '';
    document.body.style.width = '';
}
    
document.querySelector('.attendance-input').addEventListener('focus', (e) => {
  setTimeout(() => {
    e.target.scrollIntoView({ block: 'center', behavior: 'smooth' });
  }, 300);
});

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


    const nextBtn = document.querySelector('.slider-arrow.next');

    nextBtn.addEventListener('click', () => {
      nextSlide();
      restartAutoplay();
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