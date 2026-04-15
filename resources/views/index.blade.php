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
</head>
<body>

  <!-- ── ANNOUNCEMENT MODAL ──────────────────────────────── -->
  <div id="announcementModal" class="announcement-overlay">
    <div class="announcement-content">
      <div class="announcement-header">
        <span>📢 Announcement</span>
        <button class="close-announcement" onclick="closeAnnouncement()">&times;</button>
      </div>
      <div class="announcement-body">
        <h3>Welcome to the Conference!</h3>
        <p>Please remember to <strong>verify your attendance</strong> for Day 1 before the opening session at 9:00 AM.</p>
        <button class="announcement-btn" onclick="closeAnnouncement()">Got it!</button>
      </div>
    </div>
  </div>

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
      <a href="/event-register" class="register_btn" >Register here</a>
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

    <nav class="agenda-tabs">
      <button onclick="showDay(1)" class="active">Day 1</button>
      <button onclick="showDay(2)">Day 2</button>
      <button onclick="showDay(3)">Day 3</button>
    </nav>

    <!-- DAY 1 -->
    <div id="day1" class="agenda-day">
      <table>
        <tr><th>Time</th><th>Activity</th></tr>
        <tr>
          <td>9:00 – 10:30 AM</td>
          <td>
            <strong>Closed Session</strong>
            <ul>
              <li>Appointment of the Conference's Chairman</li>
              <li>Appointment of the Conference's Officials</li>
              <li>Reporting: Actions taken on 20th MFC Resolutions</li>
              <li>Discussion</li>
              <li>Amendment of the Standing Orders of Malaysian Forestry Conference</li>
            </ul>
          </td>
        </tr>
        <tr><td>10:30 – 10:50 AM</td><td>☕ Refreshments</td></tr>
        <tr><td colspan="2">Plenary Session: Main Working Paper</td></tr>
        <tr><td>11:00 – 11:30 AM</td><td>Sabah Forestry Department</td></tr>
        <tr><td>11:30 AM – 12:00 PM</td><td>Forest Department Sarawak</td></tr>
        <tr><td>12:00 – 12:30 PM</td><td>Forest Department of Peninsular Malaysia</td></tr>
        <tr>
          <td>12:30 – 1:30 PM</td>
          <td>🍽 Luncheon <ul><li>Venue: Sipadan Hall I</li></ul></td>
        </tr>
        <tr><td colspan="2">Concurrent Session 1: Policy &amp; Governance Frameworks</td></tr>
        <tr>
          <th>Chairperson</th>
          <th>Tn Zulkifli Suara <ul><li>Sabah Forestry Department</li></ul></th>
        </tr>
        <tr>
          <td>2:30 – 2:45 PM</td>
          <td>
            <strong>Paper 1:</strong> Protection and Conservation of Biodiversity Outside Permanent Forest Estates (PFE) in Sabah: What are the Possibilities?
            <ul><li>Siti Zubaidah S. Abdullah, Sabah Forestry Department</li></ul>
          </td>
        </tr>
        <tr>
          <td>2:45 – 3:00 PM</td>
          <td>
            <strong>Paper 2:</strong> Sustainable Forest Management: Sarawak's Perspectives
            <ul><li>Semilan Anak Ripot, Forest Department Sarawak</li></ul>
          </td>
        </tr>
        <tr>
          <td>3:00 – 3:15 PM</td>
          <td>
            <strong>Paper 3:</strong> Pelaksanaan SMART Patrol di Jabatan Perhutanan Semenanjung Malaysia
            <ul><li>Abd Ramlizauyahhudin bin Mahli, Forestry Department of Peninsular Malaysia</li></ul>
          </td>
        </tr>
      </table>
      <div class="punch-in-container">
          <button onclick="openAttendanceModal(1)" class="punch-btn">Verify Attendance — Day 1</button>
      </div>
    </div>

    <!-- DAY 2 -->
    <div id="day2" class="agenda-day" style="display:none;">
      <table>
        <tr><th>Time</th><th>Activity</th></tr>
        <tr><td>9:00 AM</td><td>Morning Workshop: Advanced QR Techniques</td></tr>
        <tr><td>10:30 AM</td><td>Panel Discussion</td></tr>
        <tr><td>11:30 AM</td><td>Session 3: QR in Marketing</td></tr>
        <tr><td>12:30 PM</td><td>🍽 Networking Lunch</td></tr>
      </table>
      <div class="punch-in-container">
          <button onclick="openAttendanceModal(2)" class="punch-btn">Verify Attendance — Day 2</button>
      </div>
    </div>

    <!-- DAY 3 -->
    <div id="day3" class="agenda-day" style="display:none;">
      <table>
        <tr><th>Time</th><th>Activity</th></tr>
        <tr><td>9:00 AM</td><td>Hands-on Lab</td></tr>
        <tr><td>11:00 AM</td><td>Case Studies</td></tr>
        <tr><td>12:00 PM</td><td>Closing Remarks</td></tr>
        <tr><td>12:30 PM</td><td>🎓 Certificate Distribution</td></tr>
      </table>
      <div class="punch-in-container">
          <button onclick="openAttendanceModal(3)" class="punch-btn">Verify Attendance — Day 3</button>
      </div>
    </div>
  </section>

  <!-- ── SPEAKERS ─────────────────────────────────────────── -->
  <section id="speakers">
    <span class="section-label">Our Presenters</span>
    <h2>Speaker Information</h2>
    <div class="speakers-grid">
      <div class="speaker-card" onclick="showSpeakerModal('Akmal Nizam','IT Director','LTAT','https://ui-avatars.com/api/?name=Akmal+Nizam&background=2e7d32&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Akmal+Nizam&background=2e7d32&color=fff&size=150" alt="Akmal Nizam" />
        <strong>Akmal Nizam</strong>
        <span>IT Director · LTAT</span>
      </div>
      <div class="speaker-card" onclick="showSpeakerModal('G Saravan','Group CIO','Thomson Hospital','https://ui-avatars.com/api/?name=G+Saravan&background=1a5c2e&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=G+Saravan&background=1a5c2e&color=fff&size=150" alt="G Saravan" />
        <strong>G Saravan</strong>
        <span>Group CIO · Thomson Hospital</span>
      </div>
      <div class="speaker-card" onclick="showSpeakerModal('Eric Tan','Regional Sales Engineer','Txone','https://ui-avatars.com/api/?name=Eric+Tan&background=4a7c59&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Eric+Tan&background=4a7c59&color=fff&size=150" alt="Eric Tan" />
        <strong>Eric Tan</strong>
        <span>Sales Engineer · Txone</span>
      </div>
      <div class="speaker-card" onclick="showSpeakerModal('Jeremy Jorrot','Regional SASE Specialist','Cloudflare ASEAN','https://ui-avatars.com/api/?name=Jeremy+Jorrot&background=2d5a3d&color=fff&size=150')">
        <img src="https://ui-avatars.com/api/?name=Jeremy+Jorrot&background=2d5a3d&color=fff&size=150" alt="Jeremy Jorrot" />
        <strong>Jeremy Jorrot</strong>
        <span>SASE Specialist · Cloudflare</span>
      </div>
    </div>
  </section>

  <!-- ── SLIDES ───────────────────────────────────────────── -->
  <section id="slides">
    <span class="section-label">Resources</span>
    <h2>Presentation Slides</h2>
    <p>Download the official presentation slides below:</p>
    <button class="download-btn">↓ &nbsp;Download PDF</button>
  </section>

  <!-- ── FOOTER ───────────────────────────────────────────── -->
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

    // Hide announcement if already closed this session
    if (sessionStorage.getItem('announcementClosed') === 'true') {
        const modal = document.getElementById('announcementModal');
        modal.style.display = 'none';
    }

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
      document.querySelectorAll('.agenda-tabs button').forEach((btn, i) => {
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
        sessionStorage.setItem('announcementClosed', 'true');
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
  </script>
</body>
</html>