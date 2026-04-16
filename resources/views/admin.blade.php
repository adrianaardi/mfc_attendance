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

        @if(session('admin_success'))
            <div class="flash-success">{{ session('admin_success') }}</div>
        @endif
        @if(session('admin_error'))
            <div class="flash-error">{{ session('admin_error') }}</div>
        @endif
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
                <div style="display:flex; gap:10px;">
                    <a href="/admin/export/registrations" class="export-btn">Export CSV</a>
                    <button type="button" onclick="submitDelete('form-delete-registrations')" class="delete-btn">Delete Selected</button>
                </div>
            </div>
            <form id="form-delete-registrations" method="POST" action="/admin/registrations">
                @csrf
                @method('DELETE')
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th><input type="checkbox" onclick="toggleAll(this, 'reg-check')"></th>
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
                                <td><input type="checkbox" class="reg-check" name="ids[]" value="{{ $reg->id }}"></td>
                                <td>{{ $reg->name }}</td>
                                <td>{{ $reg->email }}</td>
                                <td>{{ $reg->phone }}</td>
                                <td>{{ $reg->designation }}</td>
                                <td>{{ $reg->agency }}</td>
                                <td>{{ $reg->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" style="text-align:center; color:var(--text-soft);">No registrations yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>
        </div>

        <!-- Day 1 Table -->
        <div id="table-day1" class="admin-table-section" style="display:none;">
            <div class="table-header">
                <h3>Day 1 Attendance</h3>
                <div style="display:flex; gap:10px;">
                    <a href="/admin/export/1" class="export-btn">Export CSV</a>
                    <button type="button" onclick="submitDelete('form-delete-day1')" class="delete-btn">Delete Selected</button>
                </div>
            </div>
            <form id="form-delete-day1" method="POST" action="/admin/attendances">
                @csrf
                @method('DELETE')
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th><input type="checkbox" onclick="toggleAll(this, 'day1-check')"></th>
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
                                <td><input type="checkbox" class="day1-check" name="ids[]" value="{{ $att->id }}"></td>
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
                                <td colspan="8" style="text-align:center; color:var(--text-soft);">No attendance recorded yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>
        </div>

        <!-- Day 2 Table -->
        <div id="table-day2" class="admin-table-section" style="display:none;">
            <div class="table-header">
                <h3>Day 1 Attendance</h3>
                <div style="display:flex; gap:10px;">
                    <a href="/admin/export/1" class="export-btn">Export CSV</a>
                    <button type="button" onclick="submitDelete('form-delete-day2')" class="delete-btn">Delete Selected</button>
                </div>
            </div>
            <form id="form-delete-day2" method="POST" action="/admin/attendances">
                @csrf
                @method('DELETE')
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th><input type="checkbox" onclick="toggleAll(this, 'day2-check')"></th>
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
                                <td><input type="checkbox" class="day2-check" name="ids[]" value="{{ $att->id }}"></td>
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
                                <td colspan="8" style="text-align:center; color:var(--text-soft);">No attendance recorded yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>
        </div>

        <!-- Day 3 Table -->
        <div id="table-day3" class="admin-table-section" style="display:none;">
            <div class="table-header">
                <h3>Day 1 Attendance</h3>
                <div style="display:flex; gap:10px;">
                    <a href="/admin/export/1" class="export-btn">Export CSV</a>
                    <button type="button" onclick="submitDelete('form-delete-day3')" class="delete-btn">Delete Selected</button>
                </div>
            </div>
            <form id="form-delete-day3" method="POST" action="/admin/attendances">
                @csrf
                @method('DELETE')
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th><input type="checkbox" onclick="toggleAll(this, 'day3-check')"></th>
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
                                <td><input type="checkbox" class="day3-check" name="ids[]" value="{{ $att->id }}"></td>
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
                                <td colspan="8" style="text-align:center; color:var(--text-soft);">No attendance recorded yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>
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

        function toggleAll(source, className) {
            document.querySelectorAll('.' + className).forEach(cb => cb.checked = source.checked);
        }

        function submitDelete(formId) {
            const form = document.getElementById(formId);
            const checked = form.querySelectorAll('input[type="checkbox"]:checked');
            if (checked.length === 0) {
                alert('Please select at least one record to delete.');
                return;
            }
            if (confirm(`Delete ${checked.length} selected record(s)? This cannot be undone.`)) {
                form.submit();
            }
        }
    </script>

</body>
</html>