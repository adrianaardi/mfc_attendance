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

  <!-- ── ANNOUNCEMENT MODAL ──────────────────────────────── -->
  @if($activeDay && $currentActivity)
  <div id="announcementModal" class="announcement-overlay">
      <div class="announcement-content">
          <div class="announcement-header">
              <span>🟢 Live Now — Day {{ $activeDay }}</span>
              <button class="close-announcement" onclick="closeAnnouncement()">&times;</button>
          </div>
          <div class="announcement-body">
              <h3>{{ $currentActivity['activity'] }}</h3>
              @if(isset($currentActivity['speaker']))
                  <p>🎤 <strong>{{ $currentActivity['speaker'] }}</strong></p>
              @endif
              <p class="announcement-time">
                  🕐 {{ \Carbon\Carbon::createFromFormat('H:i', $currentActivity['time_start'])->format('h:i A') }}
                  — {{ \Carbon\Carbon::createFromFormat('H:i', $currentActivity['time_end'])->format('h:i A') }}
              </p>
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

  <!-- ── HERO ────────────────────────────────────────────── -->
  <header id="header">
    <div class="hero-inner">
      <div class="hero-tag">21st Edition · 2026</div>
      <h1>Malaysian <em>Forestry</em><br>Conference 2026</h1>
      <p>Welcome to our official event. Please register before verifying your attendance.</p>
      @if($settings['registration'])
          <a href="/event-register" class="register_btn">Register Now</a>
      @else
          <button class="register_btn" disabled style="opacity:0.5; cursor:not-allowed;">Registration Closed</button>
      @endif    
    </div>
    <div class="scroll-hint">
      <p>Scroll</p>
      <span></span>
    </div>
  </header>

  <!-- ── AGENDA ───────────────────────────────────────────── -->
<section id="agenda">
    <span class="section-label">Schedule</span>
    <h2>Conference Agenda</h2>
    <p>Attendance button is at the end of agendas.</p>

    <div class="agenda-tabs" id="agenda-day-tabs">
        <button onclick="showDay(1)" class="active">Day 1</button>
        <button onclick="showDay(2)">Day 2</button>
        <button onclick="showDay(3)">Day 3</button>
    </div>

    <!-- DAY 1 -->
    <div id="day1" class="agenda-day">
      <table>
        <tr><th>Time</th><th>Activity</th></tr>
        <tr><td>8:15 – 10:15 AM</td><td><strong>Closed Session (For Members Only)</strong></td></tr>
        <tr><td>10:15 – 10:30 AM</td><td>☕ Refreshments</td></tr>
        <tr><td>10:30 – 11:00 AM</td><td><strong>Keynote Address</strong><ul><li>Prof. Emeritus Dato Dr. Ibrahim Komoo</li></ul></td></tr>
        <tr><td colspan="2"><strong>Plenary Session: Main Working Paper</strong></td></tr>
        <tr><td>11:00 – 11:30 AM</td><td>Sabah Forestry Department</td></tr>
        <tr><td>11:30 AM – 12:00 PM</td><td>Forestry Department of Peninsular Malaysia</td></tr>
        <tr><td>12:00 – 12:30 PM</td><td>Forest Department Sarawak</td></tr>
        <tr><td>12:30 – 1:45 PM</td><td>🍽 Lunch</td></tr>
        <tr><td colspan="2"><strong>Subtheme 1: Policy and Governance</strong></td></tr>
        <tr><td>1:45 – 2:00 PM</td><td>Session Commencement</td></tr>
        <tr><td>2:00 – 2:20 PM</td><td><strong>Paper 1:</strong> Digital Governance in Forestry: Enhancing STLVS Integrity and Revenue Efficiency<ul><li>Semilan Ripot et al., Forest Department Sarawak</li></ul></td></tr>
        <tr><td>2:20 – 2:40 PM</td><td><strong>Paper 2:</strong> Unlocking Natural Capital: Sabah's Policy Frameworks for a Forest-Based Green Economy<ul><li>Indra P. H. Sunjoto et al., Sabah Forestry Department</li></ul></td></tr>
        <tr><td>2:40 – 3:00 PM</td><td><strong>Paper 3:</strong> Penetapan Pendengaran Awam Bagi Pewartaan Keluar Hutan Simpanan Kekal<ul><li>Zarin R. et al., Jabatan Perhutanan Semenanjung Malaysia</li></ul></td></tr>
        <tr><td>3:00 – 3:20 PM</td><td><strong>Paper 4:</strong> Science-Based Forest Policy: Integrating Dipterocarp Population Assessment into Sarawak's CITES Framework<ul><li>Vilma Bodos, Forest Department Sarawak</li></ul></td></tr>
        <tr><td>3:20 – 3:30 PM</td><td>Question and Answer Session</td></tr>
        <tr><td>3:30 PM</td><td>☕ Refreshments &amp; End of Day 1</td></tr>
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
        <tr><th>Time</th><th>Activity</th></tr>
        <tr><td colspan="2"><strong>Subtheme 2: Nature-Based Adaptation and Resolution</strong></td></tr>
        <tr><td>8:30 – 8:40 AM</td><td>Session Commencement</td></tr>
        <tr><td>8:40 – 9:00 AM</td><td><strong>Paper 1:</strong> Pengalaman dan Cabaran Pengurusan Kebakaran Hutan Paya Gambut di Selangor<ul><li>Azhar Ahmad et al., Jabatan Perhutanan Semenanjung Malaysia</li></ul></td></tr>
        <tr><td>9:00 – 9:20 AM</td><td><strong>Paper 2:</strong> Estimating Aboveground Forest Carbon Density through LiDAR and Geospatial Remote Sensing in Sarawak<ul><li>Dr Malcom anak Demies, Forest Department Sarawak</li></ul></td></tr>
        <tr><td>9:20 – 9:40 AM</td><td><strong>Paper 3:</strong> Ecological Dynamics of Tropical Highland Peat Ecosystems<ul><li>Zainuddin Jamaluddin et al., Jabatan Perhutanan Semenanjung Malaysia</li></ul></td></tr>
        <tr><td>9:40 – 10:00 AM</td><td><strong>Paper 4:</strong> Nature, Climate, and Economy: Sabah's Pathway Through Nature-Based Solutions<ul><li>Rosilia Anthony et al., Sabah Forestry Department</li></ul></td></tr>
        <tr><td>10:00 – 10:10 AM</td><td>Question and Answer Session</td></tr>
        <tr><td>10:10 – 10:30 AM</td><td>☕ Refreshments</td></tr>
        <tr><td colspan="2"><strong>Subtheme 3: Partnership and Collaboration</strong></td></tr>
        <tr><td>10:30 – 10:40 AM</td><td>Session Commencement</td></tr>
        <tr><td>10:40 – 11:00 AM</td><td><strong>Paper 1:</strong> Sabah Timber Legality Assurance System Plus (TLAS+)<ul><li>Mijol R. M. et al., Sabah Forestry Department</li></ul></td></tr>
        <tr><td>11:00 – 11:20 AM</td><td><strong>Paper 2:</strong> Operasi Penguatkuasaan Bersepadu Jabatan Perhutanan Semenanjung Malaysia<ul><li>Gana R. K. et al., Jabatan Perhutanan Semenanjung Malaysia</li></ul></td></tr>
        <tr><td>11:20 – 11:40 AM</td><td><strong>Paper 3:</strong> Digitalizing Conservation Governance: HOBS Cross-Agency Project Management System<ul><li>Habibah binti Salleh, Forest Department Sarawak</li></ul></td></tr>
        <tr><td>11:40 AM – 12:00 PM</td><td><strong>Paper 4</strong><ul><li>Professor Ts. Dr. Faisal Ali bin Anwarali Khan, Unimas</li></ul></td></tr>
        <tr><td>12:00 – 12:10 PM</td><td>Question and Answer Session</td></tr>
        <tr><td>12:10 – 1:30 PM</td><td>🍽 Lunch</td></tr>
        <tr><td colspan="2"><strong>Subtheme 4: Biodiversity Research and Conservation</strong></td></tr>
        <tr><td>1:30 – 1:40 PM</td><td>Session Commencement</td></tr>
        <tr><td>1:40 – 2:00 PM</td><td><strong>Paper 1:</strong> Ekspedisi Saintifik Kepelbagaian Biologi Hutan: Pencapaian dan Hala Tuju<ul><li>Siti Khatijah Othman et al., Jabatan Perhutanan Semenanjung Malaysia</li></ul></td></tr>
        <tr><td>2:00 – 2:20 PM</td><td><strong>Paper 2:</strong> Developing a Forest Reference Level Monitoring System in Sabah<ul><li>Reuben Nilus et al., Sabah Forestry Department</li></ul></td></tr>
        <tr><td>2:20 – 2:40 PM</td><td><strong>Paper 3:</strong> The Use of UAV-based LiDAR for Forest Volume Modeling in Sarawak<ul><li>Bibian Anak Micheal Diway, Forest Department Sarawak</li></ul></td></tr>
        <tr><td>2:40 – 3:00 PM</td><td><strong>Paper 4</strong><ul><li>Sarawak Forestry Corporation</li></ul></td></tr>
        <tr><td>3:00 – 3:10 PM</td><td>Question and Answer Session</td></tr>
        <tr><td>3:10 – 3:20 PM</td><td>☕ Refreshments</td></tr>
        <tr><td colspan="2"><strong>Subtheme 5: Forest Plantation and Restoration</strong></td></tr>
        <tr><td>3:20 – 3:30 PM</td><td>Session Commencement</td></tr>
        <tr><td>3:30 – 3:50 PM</td><td><strong>Paper 1:</strong> Forest Restoration and Rehabilitation: Experience and Insights<ul><li>Rohanie Bohan &amp; Zarina Shebli, Forest Department Sarawak</li></ul></td></tr>
        <tr><td>3:50 – 4:10 PM</td><td><strong>Paper 2:</strong> Forest Landscape Restoration Approaches to Strengthen Forest Sustainability in Peninsular Malaysia<ul><li>M. Hafni &amp; A. Richard, Jabatan Perhutanan Semenanjung Malaysia</li></ul></td></tr>
        <tr><td>4:10 – 4:30 PM</td><td><strong>Paper 3:</strong> Shifting Dependency on Natural Forests to Forest Plantations<ul><li>Heidi Henry William et al., Sabah Forestry Department</li></ul></td></tr>
        <tr><td>4:30 – 4:50 PM</td><td><strong>Paper 4:</strong> Transforming Industrial Forest Plantations through R&amp;D and Certification<ul><li>Roger Tami, Samling Reforestation (Bintulu) Sdn. Bhd.</li></ul></td></tr>
        <tr><td>4:50 – 5:00 PM</td><td>Question and Answer Session</td></tr>
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
        <tr><th>Time</th><th>Activity</th></tr>
        <tr><td colspan="2"><strong>Subtheme 6: Social Forestry &amp; Ecotourism</strong></td></tr>
        <tr><td>8:30 – 8:40 AM</td><td>Session Commencement</td></tr>
        <tr><td>8:40 – 9:00 AM</td><td><strong>Paper 1:</strong> Seridang Folia: A Community's Journey with Tongkat Ali in the Heart of Borneo<ul><li>Suliman Bin Haji Jamahari, Forest Department Sarawak</li></ul></td></tr>
        <tr><td>9:00 – 9:20 AM</td><td><strong>Paper 2:</strong> Beyond Conservation: Community Participation as a Driver of Green Economy in Sabah<ul><li>E. B. Johnlee et al., Sabah Forestry Department</li></ul></td></tr>
        <tr><td>9:20 – 9:40 AM</td><td><strong>Paper 3:</strong> Pengurusan Kawasan Pendakian Di Dalam Hutan Simpanan Kekal Di Semenanjung Malaysia<ul><li>Nor Zaidi Jusoh et al., Jabatan Perhutanan Semenanjung Malaysia</li></ul></td></tr>
        <tr><td>9:40 – 10:00 AM</td><td><strong>Paper 4:</strong> Community-based Tourism and its Contribution to Local Economies: Insights from Peros<ul><li>Madeline George Pau et al., Forest Department Sarawak</li></ul></td></tr>
        <tr><td>10:00 – 10:10 AM</td><td>Question and Answer Session</td></tr>
        <tr><td>10:10 – 11:00 AM</td><td>☕ Refreshments</td></tr>
        <tr><td>11:00 – 11:05 AM</td><td>Session Commencement</td></tr>
        <tr><td>11:05 AM – 12:30 PM</td><td>Conference Resolution Presentation and Adoption</td></tr>
        <tr><td>12:30 – 1:30 PM</td><td><strong>Closing Ceremony</strong><ul><li>Datu Haji Abdullah Bin Julaihi, Permanent Secretary</li></ul></td></tr>
        <tr><td>1:30 PM</td><td>🍽 Lunch and End of Conference</td></tr>
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

      <div class="speaker-card" onclick="showSpeakerModal('Prof. Emeritus Dato Dr. Ibrahim Komoo','Keynote Speaker','','https://ui-avatars.com/api/?name=Ibrahim+Komoo&background=2e7d32&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Ibrahim+Komoo&background=2e7d32&color=fff&size=150" alt="Prof. Emeritus Dato Dr. Ibrahim Komoo" />
        <strong>Prof. Emeritus Dato Dr. Ibrahim Komoo</strong>
        <span>Keynote Speaker</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Semilan Ripot','Paper Presenter','Forest Department Sarawak','https://ui-avatars.com/api/?name=Semilan+Ripot&background=1a5c2e&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Semilan+Ripot&background=1a5c2e&color=fff&size=150" alt="Semilan Ripot" />
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

      <div class="speaker-card" onclick="showSpeakerModal('Vilma Bodos','Paper Presenter','Forest Department Sarawak','https://ui-avatars.com/api/?name=Vilma+Bodos&background=2e7d32&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Vilma+Bodos&background=2e7d32&color=fff&size=150" alt="Vilma Bodos" />
        <strong>Vilma Bodos</strong>
        <span>Paper Presenter · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Azhar Ahmad','Paper Presenter','Jabatan Perhutanan Semenanjung Malaysia','https://ui-avatars.com/api/?name=Azhar+Ahmad&background=1a5c2e&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Azhar+Ahmad&background=1a5c2e&color=fff&size=150" alt="Azhar Ahmad" />
        <strong>Azhar Ahmad</strong>
        <span>Paper Presenter · Jabatan Perhutanan Semenanjung Malaysia</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Dr Malcom anak Demies','Paper Presenter','Forest Department Sarawak','https://ui-avatars.com/api/?name=Malcom+Demies&background=4a7c59&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Malcom+Demies&background=4a7c59&color=fff&size=150" alt="Dr Malcom anak Demies" />
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

      <div class="speaker-card" onclick="showSpeakerModal('Habibah binti Salleh','Paper Presenter','Forest Department Sarawak','https://ui-avatars.com/api/?name=Habibah+Salleh&background=2d5a3d&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Habibah+Salleh&background=2d5a3d&color=fff&size=150" alt="Habibah binti Salleh" />
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

      <div class="speaker-card" onclick="showSpeakerModal('Bibian Anak Micheal Diway','Paper Presenter','Forest Department Sarawak','https://ui-avatars.com/api/?name=Bibian+Diway&background=2d5a3d&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Bibian+Diway&background=2d5a3d&color=fff&size=150" alt="Bibian Anak Micheal Diway" />
        <strong>Bibian Anak Micheal Diway</strong>
        <span>Paper Presenter · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Rohanie Bohan','Paper Presenter','Forest Department Sarawak','https://ui-avatars.com/api/?name=Rohanie+Bohan&background=2e7d32&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Rohanie+Bohan&background=2e7d32&color=fff&size=150" alt="Rohanie Bohan" />
        <strong>Rohanie Bohan</strong>
        <span>Paper Presenter · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Zarina Shebli','Paper Presenter','Forest Department Sarawak','https://ui-avatars.com/api/?name=Zarina+Shebli&background=1a5c2e&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Zarina+Shebli&background=1a5c2e&color=fff&size=150" alt="Zarina Shebli" />
        <strong>Zarina Shebli</strong>
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

      <div class="speaker-card" onclick="showSpeakerModal('Suliman Bin Haji Jamahari','Paper Presenter','Forest Department Sarawak','https://ui-avatars.com/api/?name=Suliman+Jamahari&background=1a5c2e&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Suliman+Jamahari&background=1a5c2e&color=fff&size=150" alt="Suliman Bin Haji Jamahari" />
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

      <div class="speaker-card" onclick="showSpeakerModal('Madeline George Pau','Paper Presenter','Forest Department Sarawak','https://ui-avatars.com/api/?name=Madeline+Pau&background=2e7d32&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Madeline+Pau&background=2e7d32&color=fff&size=150" alt="Madeline George Pau" />
        <strong>Madeline George Pau</strong>
        <span>Paper Presenter · Forest Department Sarawak</span>
      </div>

      <div class="speaker-card" onclick="showSpeakerModal('Datu Haji Abdullah Bin Julaihi','Permanent Secretary','','https://ui-avatars.com/api/?name=Abdullah+Julaihi&background=1a5c2e&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Abdullah+Julaihi&background=1a5c2e&color=fff&size=150" alt="Datu Haji Abdullah Bin Julaihi" />
        <strong>Datu Haji Abdullah Bin Julaihi</strong>
        <span>Permanent Secretary</span>
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
    <div class="footer-container">
        <div class="footer-section">
            <h2 class="footer-title">Contact Us</h2>
            <p class="footer-subtitle">Do you need help?</p>
            <div class="footer-contacts">
                <a href="tel:+60123456789" class="footer-contact-item">
                    <span class="contact-role">Transportation</span>
                    <span class="contact-name">Encik Ali</span>
                    <span class="contact-number">012-3456789</span>
                </a>
                <a href="tel:+60123456789" class="footer-contact-item">
                    <span class="contact-role">Accommodation</span>
                    <span class="contact-name">Encik Abu</span>
                    <span class="contact-number">012-3456789</span>
                </a>
                <a href="tel:+60123456789" class="footer-contact-item">
                    <span class="contact-role">Registration</span>
                    <span class="contact-name">Encik Azam</span>
                    <span class="contact-number">012-3456789</span>
                </a>
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
    
//slides
function showSlideDay(n) {
    document.querySelectorAll('.slides-day').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.slides-tabs button').forEach(el => el.classList.remove('active'));
    document.getElementById('slides-day' + n).style.display = 'block';
    document.getElementById('slide-tab-' + n).classList.add('active');
}

  </script>
  @if(session('success'))
    <script>
        Swal.fire({
            title: 'Success!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
@endif
</body>
</html>