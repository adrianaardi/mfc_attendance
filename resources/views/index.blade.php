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
    <!-- Temporarily hide the announcement layout if it exists so SweetAlert shows first -->
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
              <span>Live Now — Day {{ $activeDay }}</span>
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
            The Malaysian Forestry Conference (MFC) is the premier national forestry conference in Malaysia. Since its inception in 1966, the conference has been organised on a rotational basis among the forestry authorities of Peninsular Malaysia, Sabah and Sarawak.
          <span class="more-text">
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
        <h1>Post-conference tour packages title here</h1>
        <p>Full description goes here.... bla bla bla. To read view details, click the button below. user can view and decide to purchase weeee</p>
        <a href="#" class="register_btn">More on event here!</a>
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
        <button onclick="showDay(1)" class="active">Day 1</button>
        <button onclick="showDay(2)">Day 2</button>
        <button onclick="showDay(3)">Day 3</button>
    </div>

    <!-- DAY 1 -->
    <div id="day1" class="agenda-day">
      <table>
        <tr><th style="width: 40%;">Time</th><th>Activity</th></tr>
        <tr><td>8:15 AM – 10:15 AM</td><td><strong>Closed Session (For Members Only)</strong></td></tr>
        <tr><td>10:15 AM – 10:30 AM</td><td>Refreshments</td></tr>
        <tr><td>10:30 AM – 11:00 AM</td><td><strong>Keynote Address</strong><ul><li>Prof. Emeritus Dato Dr. Ibrahim Komoo</li></ul></td></tr>
        <tr><td colspan="2"><strong>Plenary Session: Main Working Paper</strong></td></tr>
        <tr><td>11:00 AM – 11:30 AM</td><td>Sabah Forestry Department</td></tr>
        <tr><td>11:30 AM – 12:00 PM</td><td>Forestry Department of Peninsular Malaysia</td></tr>
        <tr><td>12:00 AM – 12:30 PM</td><td>Forest Department Sarawak</td></tr>
        <tr><td>12:30 PM – 1:45 PM</td><td>Lunch</td></tr>
        <tr><td colspan="2"><strong>Subtheme 1: Policy and Governance</strong></td></tr>
        <tr><td>1:45 PM – 2:00 PM</td><td>Session Commencement</td></tr>
        <tr><td>2:00 PM – 2:20 PM</td><td><strong>Paper 1:</strong> Digital Governance in Forestry: Enhancing STLVS Integrity and Revenue Efficiency<ul><li>Semilan Ripot et al., Forest Department Sarawak</li></ul></td></tr>
        <tr><td>2:20 PM – 2:40 PM</td><td><strong>Paper 2:</strong> Unlocking Natural Capital: Sabah's Policy Frameworks for a Forest-Based Green Economy<ul><li>Indra P. H. Sunjoto et al., Sabah Forestry Department</li></ul></td></tr>
        <tr><td>2:40 PM – 3:00 PM</td><td><strong>Paper 3:</strong> Penetapan Pendengaran Awam Bagi Pewartaan Keluar Hutan Simpanan Kekal<ul><li>Zarin R. et al., Jabatan Perhutanan Semenanjung Malaysia</li></ul></td></tr>
        <tr><td>3:00 PM – 3:20 PM</td><td><strong>Paper 4:</strong> Science-Based Forest Policy: Integrating Dipterocarp Population Assessment into Sarawak's CITES Framework<ul><li>Vilma Bodos, Forest Department Sarawak</li></ul></td></tr>
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
        <tr><th style="width: 40%;">Time</th><th>Activity</th></tr>
        <tr><td colspan="2"><strong>Subtheme 2: Nature-Based Adaptation and Resolution</strong></td></tr>
        <tr><td>8:30 AM – 8:40 AM</td><td>Session Commencement</td></tr>
        <tr><td>8:40 AM – 9:00 AM</td><td><strong>Paper 1:</strong> Pengalaman dan Cabaran Pengurusan Kebakaran Hutan Paya Gambut di Selangor<ul><li>Azhar Ahmad et al., Jabatan Perhutanan Semenanjung Malaysia</li></ul></td></tr>
        <tr><td>9:00 AM – 9:20 AM</td><td><strong>Paper 2:</strong> Estimating Aboveground Forest Carbon Density through LiDAR and Geospatial Remote Sensing in Sarawak<ul><li>Dr Malcom anak Demies, Forest Department Sarawak</li></ul></td></tr>
        <tr><td>9:20 AM – 9:40 AM</td><td><strong>Paper 3:</strong> Ecological Dynamics of Tropical Highland Peat Ecosystems<ul><li>Zainuddin Jamaluddin et al., Jabatan Perhutanan Semenanjung Malaysia</li></ul></td></tr>
        <tr><td>9:40 AM – 10:00 AM</td><td><strong>Paper 4:</strong> Nature, Climate, and Economy: Sabah's Pathway Through Nature-Based Solutions<ul><li>Rosilia Anthony et al., Sabah Forestry Department</li></ul></td></tr>
        <tr><td>10:00 AM – 10:10 AM</td><td>Question and Answer Session</td></tr>
        <tr><td>10:10 AM – 10:30 AM</td><td>Refreshments</td></tr>
        <tr><td colspan="2"><strong>Subtheme 3: Partnership and Collaboration</strong></td></tr>
        <tr><td>10:30 AM – 10:40 AM</td><td>Session Commencement</td></tr>
        <tr><td>10:40 AM – 11:00 AM</td><td><strong>Paper 1:</strong> Sabah Timber Legality Assurance System Plus (TLAS+)<ul><li>Mijol R. M. et al., Sabah Forestry Department</li></ul></td></tr>
        <tr><td>11:00 AM – 11:20 AM</td><td><strong>Paper 2:</strong> Operasi Penguatkuasaan Bersepadu Jabatan Perhutanan Semenanjung Malaysia<ul><li>Gana R. K. et al., Jabatan Perhutanan Semenanjung Malaysia</li></ul></td></tr>
        <tr><td>11:20 AM – 11:40 AM</td><td><strong>Paper 3:</strong> Digitalizing Conservation Governance: HOBS Cross-Agency Project Management System<ul><li>Habibah binti Salleh, Forest Department Sarawak</li></ul></td></tr>
        <tr><td>11:40 AM – 12:00 PM</td><td><strong>Paper 4</strong><ul><li>Professor Ts. Dr. Faisal Ali bin Anwarali Khan, Unimas</li></ul></td></tr>
        <tr><td>12:00 PM – 12:10 PM</td><td>Question and Answer Session</td></tr>
        <tr><td>12:10 PM – 1:30 PM</td><td>Lunch</td></tr>
        <tr><td colspan="2"><strong>Subtheme 4: Biodiversity Research and Conservation</strong></td></tr>
        <tr><td>1:30 PM – 1:40 PM</td><td>Session Commencement</td></tr>
        <tr><td>1:40 PM – 2:00 PM</td><td><strong>Paper 1:</strong> Ekspedisi Saintifik Kepelbagaian Biologi Hutan: Pencapaian dan Hala Tuju<ul><li>Siti Khatijah Othman et al., Jabatan Perhutanan Semenanjung Malaysia</li></ul></td></tr>
        <tr><td>2:00 PM – 2:20 PM</td><td><strong>Paper 2:</strong> Developing a Forest Reference Level Monitoring System in Sabah<ul><li>Reuben Nilus et al., Sabah Forestry Department</li></ul></td></tr>
        <tr><td>2:20 PM – 2:40 PM</td><td><strong>Paper 3:</strong> The Use of UAV-based LiDAR for Forest Volume Modeling in Sarawak<ul><li>Bibian Anak Micheal Diway, Forest Department Sarawak</li></ul></td></tr>
        <tr><td>2:40 PM – 3:00 PM</td><td><strong>Paper 4</strong><ul><li>Sarawak Forestry Corporation</li></ul></td></tr>
        <tr><td>3:00 PM – 3:10 PM</td><td>Question and Answer Session</td></tr>
        <tr><td>3:10 PM – 3:20 PM</td><td>Refreshments</td></tr>
        <tr><td colspan="2"><strong>Subtheme 5: Forest Plantation and Restoration</strong></td></tr>
        <tr><td>3:20 PM – 3:30 PM</td><td>Session Commencement</td></tr>
        <tr><td>3:30 PM – 3:50 PM</td><td><strong>Paper 1:</strong> Forest Restoration and Rehabilitation: Experience and Insights<ul><li>Rohanie Bohan &amp; Zarina Shelbi, Forest Department Sarawak</li></ul></td></tr>
        <tr><td>3:50 PM – 4:10 PM</td><td><strong>Paper 2:</strong> Forest Landscape Restoration Approaches to Strengthen Forest Sustainability in Peninsular Malaysia<ul><li>M. Hafni &amp; A. Richard, Jabatan Perhutanan Semenanjung Malaysia</li></ul></td></tr>
        <tr><td>4:10 PM – 4:30 PM</td><td><strong>Paper 3:</strong> Shifting Dependency on Natural Forests to Forest Plantations<ul><li>Heidi Henry William et al., Sabah Forestry Department</li></ul></td></tr>
        <tr><td>4:30 PM – 4:50 PM</td><td><strong>Paper 4:</strong> Transforming Industrial Forest Plantations through R&amp;D and Certification<ul><li>Roger Tami, Samling Reforestation (Bintulu) Sdn. Bhd.</li></ul></td></tr>
        <tr><td>4:50 PM – 5:00 PM</td><td>Question and Answer Session</td></tr>
        <tr><td>5:00 PM</td><td>End of Day 2</td></tr>
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
        <tr><th style="width: 40%;">Time</th><th>Activity</th></tr>
        <tr><td colspan="2"><strong>Subtheme 6: Social Forestry &amp; Ecotourism</strong></td></tr>
        <tr><td>8:30 AM – 8:40 AM</td><td>Session Commencement</td></tr>
        <tr><td>8:40 AM – 9:00 AM</td><td><strong>Paper 1:</strong> Seridang Folia: A Community's Journey with Tongkat Ali in the Heart of Borneo<ul><li>Suliman Bin Haji Jamahari, Forest Department Sarawak</li></ul></td></tr>
        <tr><td>9:00 AM – 9:20 AM</td><td><strong>Paper 2:</strong> Beyond Conservation: Community Participation as a Driver of Green Economy in Sabah<ul><li>E. B. Johnlee et al., Sabah Forestry Department</li></ul></td></tr>
        <tr><td>9:20 AM – 9:40 AM</td><td><strong>Paper 3:</strong> Pengurusan Kawasan Pendakian Di Dalam Hutan Simpanan Kekal Di Semenanjung Malaysia<ul><li>Nor Zaidi Jusoh et al., Jabatan Perhutanan Semenanjung Malaysia</li></ul></td></tr>
        <tr><td>9:40 AM – 10:00 AM</td><td><strong>Paper 4:</strong> Community-based Tourism and its Contribution to Local Economies: Insights from Peros<ul><li>Madeline George Pau et al., Forest Department Sarawak</li></ul></td></tr>
        <tr><td>10:00 AM – 10:10 AM</td><td>Question and Answer Session</td></tr>
        <tr><td>10:10 AM – 11:00 AM</td><td>Refreshments</td></tr>
        <tr><td>11:00 AM – 11:05 AM</td><td>Session Commencement</td></tr>
        <tr><td>11:05 AM – 12:30 PM</td><td>Conference Resolution Presentation and Adoption</td></tr>
        <tr><td>12:30 AM – 1:30 PM</td><td><strong>Closing Ceremony</strong><ul><li>Datu Haji Abdullah Bin Julaihi, Permanent Secretary</li></ul></td></tr>
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
    <h2>Speaker Information</h2>
    <div class="speakers-grid">

      <div class="speaker-card" onclick="showSpeakerModal('Datu Haji Abdullah Bin Julaihi','Permanent Secretary','','{{ asset('images/talker/DATU HAJI ABDULLAH JULAIHI.png') }}')">
        <img src="{{ asset('images/talker/DATU HAJI ABDULLAH JULAIHI.png') }}" alt="Datu Haji Abdullah Bin Julaihi" />
        <strong>Datu Haji Abdullah Bin Julaihi</strong>
        <span>Permanent Secretary</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Prof. Emeritus Dato Dr. Ibrahim Komoo','Keynote Speaker','','{{ asset('images/talker/PROF EMERITUS DATO DR IBRAHIM KOMOO.png') }}')">
        <img src="{{ asset('images/talker/PROF EMERITUS DATO DR IBRAHIM KOMOO.png') }}" alt="Prof. Emeritus Dato Dr. Ibrahim Komoo" />
        <strong>Prof. Emeritus Dato Dr. Ibrahim Komoo</strong>
        <span>Keynote Speaker</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Semilan Ripot','Paper Presenter','Forest Department Sarawak','{{ asset('images/talker/SEMILAN RIPOT.png') }}')">
        <img src="{{ asset('images/talker/SEMILAN RIPOT.png') }}" alt="Semilan Ripot" />
        <strong>Semilan Ripot</strong>
        <span>Paper Presenter · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Indra P. H. Sunjoto','Paper Presenter','Sabah Forestry Department','https://ui-avatars.com/api/?name=Indra+Sunjoto&background=4a7c59&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Indra+Sunjoto&background=4a7c59&color=fff&size=150" alt="Indra P. H. Sunjoto" />
        <strong>Indra P. H. Sunjoto</strong>
        <span>Paper Presenter · Sabah Forestry Department</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Zarin R.','Paper Presenter','Jabatan Perhutanan Semenanjung Malaysia','https://ui-avatars.com/api/?name=Zarin+R&background=2d5a3d&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Zarin+R&background=2d5a3d&color=fff&size=150" alt="Zarin R." />
        <strong>Zarin R.</strong>
        <span>Paper Presenter · Jabatan Perhutanan Semenanjung Malaysia</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Vilma Bodos','Paper Presenter','Forest Department Sarawak','{{ asset('images/talker/VILMA ANAK BODOS.png') }}')">
        <img src="{{ asset('images/talker/VILMA ANAK BODOS.png') }}" alt="Vilma Bodos" />
        <strong>Vilma Bodos</strong>
        <span>Paper Presenter · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Azhar Ahmad','Paper Presenter','Jabatan Perhutanan Semenanjung Malaysia','https://ui-avatars.com/api/?name=Azhar+Ahmad&background=1a5c2e&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Azhar+Ahmad&background=1a5c2e&color=fff&size=150" alt="Azhar Ahmad" />
        <strong>Azhar Ahmad</strong>
        <span>Paper Presenter · Jabatan Perhutanan Semenanjung Malaysia</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Dr Malcom anak Demies','Paper Presenter','Forest Department Sarawak','{{ asset('images/talker/DR MALCOM DEMIES.png') }}')">
        <img src="{{ asset('images/talker/DR MALCOM DEMIES.png') }}" alt="Dr Malcom anak Demies" />
        <strong>Dr Malcom anak Demies</strong>
        <span>Paper Presenter · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Zainuddin Jamaluddin','Paper Presenter','Jabatan Perhutanan Semenanjung Malaysia','https://ui-avatars.com/api/?name=Zainuddin+Jamaluddin&background=2d5a3d&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Zainuddin+Jamaluddin&background=2d5a3d&color=fff&size=150" alt="Zainuddin Jamaluddin" />
        <strong>Zainuddin Jamaluddin</strong>
        <span>Paper Presenter · Jabatan Perhutanan Semenanjung Malaysia</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Rosilia Anthony','Paper Presenter','Sabah Forestry Department','https://ui-avatars.com/api/?name=Rosilia+Anthony&background=2e7d32&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Rosilia+Anthony&background=2e7d32&color=fff&size=150" alt="Rosilia Anthony" />
        <strong>Rosilia Anthony</strong>
        <span>Paper Presenter · Sabah Forestry Department</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Mijol R. M.','Paper Presenter','Sabah Forestry Department','https://ui-avatars.com/api/?name=Mijol+RM&background=1a5c2e&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Mijol+RM&background=1a5c2e&color=fff&size=150" alt="Mijol R. M." />
        <strong>Mijol R. M.</strong>
        <span>Paper Presenter · Sabah Forestry Department</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Gana R. K.','Paper Presenter','Jabatan Perhutanan Semenanjung Malaysia','https://ui-avatars.com/api/?name=Gana+RK&background=4a7c59&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Gana+RK&background=4a7c59&color=fff&size=150" alt="Gana R. K." />
        <strong>Gana R. K.</strong>
        <span>Paper Presenter · Jabatan Perhutanan Semenanjung Malaysia</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Habibah binti Salleh','Paper Presenter','Forest Department Sarawak','{{ asset('images/talker/HABIBAH BINTI SALLEH.png') }}')">
        <img src="{{ asset('images/talker/HABIBAH BINTI SALLEH.png') }}" alt="Habibah binti Salleh" />
        <strong>Habibah binti Salleh</strong>
        <span>Paper Presenter · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Prof. Ts. Dr. Faisal Ali bin Anwarali Khan','Paper Presenter','Unimas','https://ui-avatars.com/api/?name=Faisal+Khan&background=2e7d32&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Faisal+Khan&background=2e7d32&color=fff&size=150" alt="Prof. Ts. Dr. Faisal Ali bin Anwarali Khan" />
        <strong>Prof. Ts. Dr. Faisal Ali bin Anwarali Khan</strong>
        <span>Paper Presenter · Unimas</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Siti Khatijah Othman','Paper Presenter','Jabatan Perhutanan Semenanjung Malaysia','https://ui-avatars.com/api/?name=Siti+Khatijah&background=1a5c2e&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Siti+Khatijah&background=1a5c2e&color=fff&size=150" alt="Siti Khatijah Othman" />
        <strong>Siti Khatijah Othman</strong>
        <span>Paper Presenter · Jabatan Perhutanan Semenanjung Malaysia</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Reuben Nilus','Paper Presenter','Sabah Forestry Department','https://ui-avatars.com/api/?name=Reuben+Nilus&background=4a7c59&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Reuben+Nilus&background=4a7c59&color=fff&size=150" alt="Reuben Nilus" />
        <strong>Reuben Nilus</strong>
        <span>Paper Presenter · Sabah Forestry Department</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Bibian Anak Micheal Diway','Paper Presenter','Forest Department Sarawak','{{ asset('images/talker/BIBIAN MICHAEL DIWAY.JPG-no-bg.png') }}')">
        <img src="{{ asset('images/talker/BIBIAN MICHAEL DIWAY.JPG-no-bg.png') }}" alt="Bibian Anak Micheal Diway" />
        <strong>Bibian Anak Micheal Diway</strong>
        <span>Paper Presenter · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Rohanie Bohan','Paper Presenter','Forest Department Sarawak','{{ asset('images/talker/ROHANIE BOLHAN.png') }}')">
        <img src="{{ asset('images/talker/ROHANIE BOLHAN.png') }}" alt="Rohanie Bohan" />
        <strong>Rohanie Bohan</strong>
        <span>Paper Presenter · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Zarina Shelbi','Paper Presenter','Forest Department Sarawak','{{ asset('images/talker/ZARINA SHELBI.png') }}')">
        <img src="{{ asset('images/talker/ZARINA SHELBI.png') }}" alt="Zarina Shelbi" />
        <strong>Zarina Shelbi</strong>
        <span>Paper Presenter · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('M. Hafni','Paper Presenter','Jabatan Perhutanan Semenanjung Malaysia','https://ui-avatars.com/api/?name=M+Hafni&background=4a7c59&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=M+Hafni&background=4a7c59&color=fff&size=150" alt="M. Hafni" />
        <strong>M. Hafni</strong>
        <span>Paper Presenter · Jabatan Perhutanan Semenanjung Malaysia</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Heidi Henry William','Paper Presenter','Sabah Forestry Department','https://ui-avatars.com/api/?name=Heidi+William&background=2d5a3d&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Heidi+William&background=2d5a3d&color=fff&size=150" alt="Heidi Henry William" />
        <strong>Heidi Henry William</strong>
        <span>Paper Presenter · Sabah Forestry Department</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Roger Tami','Paper Presenter','Samling Reforestation (Bintulu) Sdn. Bhd.','https://ui-avatars.com/api/?name=Roger+Tami&background=2e7d32&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Roger+Tami&background=2e7d32&color=fff&size=150" alt="Roger Tami" />
        <strong>Roger Tami</strong>
        <span>Paper Presenter · Samling Reforestation (Bintulu) Sdn. Bhd.</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Suliman Bin Haji Jamahari','Paper Presenter','Forest Department Sarawak','{{ asset('images/talker/SULIMAN HAJI JAMAHARI.png') }}')">
        <img src="{{ asset('images/talker/SULIMAN HAJI JAMAHARI.png') }}" alt="Suliman Bin Haji Jamahari" />
        <strong>Suliman Bin Haji Jamahari</strong>
        <span>Paper Presenter · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('E. B. Johnlee','Paper Presenter','Sabah Forestry Department','https://ui-avatars.com/api/?name=EB+Johnlee&background=4a7c59&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=EB+Johnlee&background=4a7c59&color=fff&size=150" alt="E. B. Johnlee" />
        <strong>E. B. Johnlee</strong>
        <span>Paper Presenter · Sabah Forestry Department</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Nor Zaidi Jusoh','Paper Presenter','Jabatan Perhutanan Semenanjung Malaysia','https://ui-avatars.com/api/?name=Nor+Zaidi&background=2d5a3d&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Nor+Zaidi&background=2d5a3d&color=fff&size=150" alt="Nor Zaidi Jusoh" />
        <strong>Nor Zaidi Jusoh</strong>
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
        <button onclick="showSlideDay(1)" class="active" id="slide-tab-1">Day 1</button>
        <button onclick="showSlideDay(2)" id="slide-tab-2">Day 2</button>
        <button onclick="showSlideDay(3)" id="slide-tab-3">Day 3</button>
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
          <h2>Verify Attendance</h2>
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