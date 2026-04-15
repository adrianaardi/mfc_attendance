<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel — Malaysian Forestry Conference 2026</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

    <nav>
        <a href="/">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" onerror="this.style.display='none'" />
        </a>
        <a href="/">Home</a>
        <a href="/admin" class="nav-active">Admin</a>
        <form method="POST" action="/logout" style="display:inline;">
            @csrf
            <button type="submit" style="background:none; border:none; cursor:pointer; font-family:inherit; font-size:inherit; color:white;">Logout</button>
        </form>
    </nav>

    <section id="admin-panel">
        <span class="section-label">Admin Panel</span>
        <h2>Conference Dashboard</h2>

        <!-- Summary Cards -->
        <div class="admin-cards">
            <div class="admin-card">
                <span>Total Registrations</span>
                <strong>{{ $registrations->count() }}</strong>
            </div>
            <div class="admin-card">
                <span>Day 1 Attendance</span>
                <strong>{{ $day1->count() }}</strong>
            </div>
            <div class="admin-card">
                <span>Day 2 Attendance</span>
                <strong>{{ $day2->count() }}</strong>
            </div>
            <div class="admin-card">
                <span>Day 3 Attendance</span>
                <strong>{{ $day3->count() }}</strong>
            </div>
        </div>

        <!-- Tabs -->
        <div class="admin-tabs">
            <button onclick="showTab('registrations')" class="active" id="tab-registrations">Registrations</button>
            <button onclick="showTab('day1')" id="tab-day1">Day 1</button>
            <button onclick="showTab('day2')" id="tab-day2">Day 2</button>
            <button onclick="showTab('day3')" id="tab-day3">Day 3</button>
        </div>

        <!-- Registrations Table -->
        <div id="table-registrations" class="admin-table-section">
            <div class="table-header">
                <h3>All Registrations</h3>
                <a href="/admin/export/registrations" class="export-btn">Export CSV</a>            </div>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Designation</th>
                            <th>Agency</th>
                            <th>Registered At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registrations as $i => $reg)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $reg->name }}</td>
                            <td>{{ $reg->email }}</td>
                            <td>{{ $reg->phone }}</td>
                            <td>{{ $reg->designation }}</td>
                            <td>{{ $reg->agency }}</td>
                            <td>{{ $reg->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align:center; color:var(--text-soft);">No registrations yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Day 1 Table -->
        <div id="table-day1" class="admin-table-section" style="display:none;">
            <div class="table-header">
                <h3>Day 1 Attendance</h3>
<a href="/admin/export/1" class="export-btn">Export CSV</a>            </div>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Designation</th>
                            <th>Agency</th>
                            <th>Check-in Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($day1 as $i => $att)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $att->registration->name }}</td>
                            <td>{{ $att->registration->email }}</td>
                            <td>{{ $att->registration->phone }}</td>
                            <td>{{ $att->registration->designation }}</td>
                            <td>{{ $att->registration->agency }}</td>
                            <td>{{ \Carbon\Carbon::parse($att->checked_in_at)->format('d M Y, h:i A') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align:center; color:var(--text-soft);">No attendance recorded yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Day 2 Table -->
        <div id="table-day2" class="admin-table-section" style="display:none;">
            <div class="table-header">
                <h3>Day 2 Attendance</h3>
<a href="/admin/export/2" class="export-btn">Export CSV</a>            </div>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Designation</th>
                            <th>Agency</th>
                            <th>Check-in Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($day2 as $i => $att)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $att->registration->name }}</td>
                            <td>{{ $att->registration->email }}</td>
                            <td>{{ $att->registration->phone }}</td>
                            <td>{{ $att->registration->designation }}</td>
                            <td>{{ $att->registration->agency }}</td>
                            <td>{{ \Carbon\Carbon::parse($att->checked_in_at)->format('d M Y, h:i A') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align:center; color:var(--text-soft);">No attendance recorded yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Day 3 Table -->
        <div id="table-day3" class="admin-table-section" style="display:none;">
            <div class="table-header">
                <h3>Day 3 Attendance</h3>
<a href="/admin/export/3" class="export-btn">Export CSV</a>            </div>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Designation</th>
                            <th>Agency</th>
                            <th>Check-in Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($day3 as $i => $att)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $att->registration->name }}</td>
                            <td>{{ $att->registration->email }}</td>
                            <td>{{ $att->registration->phone }}</td>
                            <td>{{ $att->registration->designation }}</td>
                            <td>{{ $att->registration->agency }}</td>
                            <td>{{ \Carbon\Carbon::parse($att->checked_in_at)->format('d M Y, h:i A') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align:center; color:var(--text-soft);">No attendance recorded yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

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

    <script>
        function showTab(name) {
            document.querySelectorAll('.admin-table-section').forEach(el => el.style.display = 'none');
            document.querySelectorAll('.admin-tabs button').forEach(el => el.classList.remove('active'));
            document.getElementById('table-' + name).style.display = 'block';
            document.getElementById('tab-' + name).classList.add('active');
        }
    </script>

</body>
</html>