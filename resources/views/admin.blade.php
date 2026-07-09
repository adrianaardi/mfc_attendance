<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel — Malaysian Forestry Conference 2026</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="icon" href="{{ asset('images/logo-icon.png')}}">
    <style>
        .email-badge { display:inline-block; padding:2px 8px; border-radius:10px; font-size:0.8em; font-weight:600; }
        .email-sent { background:#d3f3dc; color:#166534; }
        .email-failed { background:#fbdada; color:#991b1b; }
        .email-pending { background:#f0eadf; color:#7a6a4f; }
        .resend-btn { background:none; border:1px solid var(--text-soft,#999); border-radius:6px; padding:2px 8px; font-size:0.8em; cursor:pointer; margin-left:6px; }
        .table-search { padding:6px 10px; border:1px solid #ccc; border-radius:6px; font-family:inherit; min-width:220px; }
        .pagination-wrapper { margin-top:14px; }
        .pagination-wrapper ul { display:flex; gap:4px; list-style:none; padding:0; flex-wrap:wrap; }
        .pagination-wrapper li a, .pagination-wrapper li span { display:inline-block; padding:4px 10px; border:1px solid #ddd; border-radius:6px; text-decoration:none; color:inherit; }
        .pagination-wrapper li.active span { background:#333; color:#fff; }
    </style>
</head>
<body>

    <nav>
        <a href="/">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" onerror="this.style.display='none'" />
        </a>
        <a href="/">Home</a>
        <a href="/admin" class="nav-active">Admin</a>
        <a href="/admin/slides">Manage Slides</a>
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
                <strong>{{ $counts['registrations'] }}</strong>
                <form method="POST" action="/admin/toggle/registration">
                    @csrf
                    <button type="submit" class="toggle-btn {{ $settings['registration'] ? 'toggle-on' : 'toggle-off' }}">
                        {{ $settings['registration'] ? '✅ Registration Open' : '🔴 Registration Closed' }}
                    </button>
                </form>
            </div>
            <div class="admin-card">
                <span>Day 1 Attendance</span>
                <strong>{{ $counts['day1'] }}</strong>
                <form method="POST" action="/admin/toggle/attendance_day1">
                    @csrf
                    <button type="submit" class="toggle-btn {{ $settings['attendance_day1'] ? 'toggle-on' : 'toggle-off' }}">
                        {{ $settings['attendance_day1'] ? '✅ Day 1 Open' : '🔴 Day 1 Closed' }}
                    </button>
                </form>
            </div>
            <div class="admin-card">
                <span>Day 2 Attendance</span>
                <strong>{{ $counts['day2'] }}</strong>
                <form method="POST" action="/admin/toggle/attendance_day2">
                    @csrf
                    <button type="submit" class="toggle-btn {{ $settings['attendance_day2'] ? 'toggle-on' : 'toggle-off' }}">
                        {{ $settings['attendance_day2'] ? '✅ Day 2 Open' : '🔴 Day 2 Closed' }}
                    </button>
                </form>
            </div>
            <div class="admin-card">
                <span>Day 3 Attendance</span>
                <strong>{{ $counts['day3'] }}</strong>
                <form method="POST" action="/admin/toggle/attendance_day3">
                    @csrf
                    <button type="submit" class="toggle-btn {{ $settings['attendance_day3'] ? 'toggle-on' : 'toggle-off' }}">
                        {{ $settings['attendance_day3'] ? '✅ Day 3 Open' : '🔴 Day 3 Closed' }}
                    </button>
                </form>
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
                <form method="GET" action="{{ url()->current() }}" style="display:flex; gap:8px;">
                    <input type="hidden" name="tab" value="registrations">
                    <input type="text" name="reg_search" class="table-search" placeholder="Search name, email, phone, agency…" value="{{ $regSearch }}">
                    <button type="submit" class="export-btn">Search</button>
                    @if($regSearch)
                        <a href="{{ url()->current() }}?tab=registrations" class="export-btn">Clear</a>
                    @endif
                </form>
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
                                <th>Email Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($registrations as $reg)
                            <tr>
                                <td><input type="checkbox" class="reg-check" name="ids[]" value="{{ $reg->id }}"></td>
                                <td>{{ $reg->name }}</td>
                                <td>{{ $reg->email }}</td>
                                <td>{{ $reg->phone }}</td>
                                <td>{{ $reg->designation }}</td>
                                <td>{{ $reg->agency }}</td>
                                <td>{{ $reg->created_at->format('d M Y, h:i A') }}</td>
                                <td>
                                    @if($reg->email_status === 'sent')
                                        <span class="email-badge email-sent">✅ Sent</span>
                                    @elseif($reg->email_status === 'failed')
                                        <span class="email-badge email-failed" title="{{ $reg->email_error }}">❌ Failed</span>
                                    @else
                                        <span class="email-badge email-pending">⏳ Pending</span>
                                    @endif
                                    @if($reg->email_status !== 'sent')
                                        <button type="button" class="resend-btn" onclick="resend('/admin/registrations/{{ $reg->id }}/resend')">
                                            Resend
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" style="text-align:center; color:var(--text-soft);">No registrations found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>
            <div class="pagination-wrapper">{{ $registrations->appends(['tab' => 'registrations'])->links() }}</div>
        </div>

        <!-- Day 1 Table -->
        <div id="table-day1" class="admin-table-section" style="display:none;">
            <div class="table-header">
                <form method="GET" action="{{ url()->current() }}" style="display:flex; gap:8px;">
                    <input type="hidden" name="tab" value="day1">
                    <input type="text" name="day1_search" class="table-search" placeholder="Search name, email, phone, agency…" value="{{ $day1Search }}">
                    <button type="submit" class="export-btn">Search</button>
                    @if($day1Search)
                        <a href="{{ url()->current() }}?tab=day1" class="export-btn">Clear</a>
                    @endif
                </form>
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
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Designation</th>
                                <th>Agency</th>
                                <th>Check-in Time</th>
                                <th>Email Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($day1 as $att)
                            <tr>
                                <td><input type="checkbox" class="day1-check" name="ids[]" value="{{ $att->id }}"></td>
                                <td>{{ $att->registration->name }}</td>
                                <td>{{ $att->registration->email }}</td>
                                <td>{{ $att->registration->phone }}</td>
                                <td>{{ $att->registration->designation }}</td>
                                <td>{{ $att->registration->agency }}</td>
                                <td>{{ \Carbon\Carbon::parse($att->checked_in_at)->format('d M Y, h:i A') }}</td>
                                <td>
                                    @if($att->email_status === 'sent')
                                        <span class="email-badge email-sent">✅ Sent</span>
                                    @elseif($att->email_status === 'failed')
                                        <span class="email-badge email-failed" title="{{ $att->email_error }}">❌ Failed</span>
                                    @else
                                        <span class="email-badge email-pending">⏳ Pending</span>
                                    @endif
                                    @if($att->email_status !== 'sent')
                                        <button type="button" class="resend-btn" onclick="resend('/admin/attendances/{{ $att->id }}/resend')">
                                            Resend
                                        </button>
                                    @endif
                                </td>
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
            <div class="pagination-wrapper">{{ $day1->appends(['tab' => 'day1'])->links() }}</div>
        </div>

        <!-- Day 2 Table -->
        <div id="table-day2" class="admin-table-section" style="display:none;">
            <div class="table-header">
                <form method="GET" action="{{ url()->current() }}" style="display:flex; gap:8px;">
                    <input type="hidden" name="tab" value="day2">
                    <input type="text" name="day2_search" class="table-search" placeholder="Search name, email, phone, agency…" value="{{ $day2Search }}">
                    <button type="submit" class="export-btn">Search</button>
                    @if($day2Search)
                        <a href="{{ url()->current() }}?tab=day2" class="export-btn">Clear</a>
                    @endif
                </form>
                <div style="display:flex; gap:10px;">
                    <a href="/admin/export/2" class="export-btn">Export CSV</a>
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
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Designation</th>
                                <th>Agency</th>
                                <th>Check-in Time</th>
                                <th>Email Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($day2 as $att)
                            <tr>
                                <td><input type="checkbox" class="day2-check" name="ids[]" value="{{ $att->id }}"></td>
                                <td>{{ $att->registration->name }}</td>
                                <td>{{ $att->registration->email }}</td>
                                <td>{{ $att->registration->phone }}</td>
                                <td>{{ $att->registration->designation }}</td>
                                <td>{{ $att->registration->agency }}</td>
                                <td>{{ \Carbon\Carbon::parse($att->checked_in_at)->format('d M Y, h:i A') }}</td>
                                <td>
                                    @if($att->email_status === 'sent')
                                        <span class="email-badge email-sent">✅ Sent</span>
                                    @elseif($att->email_status === 'failed')
                                        <span class="email-badge email-failed" title="{{ $att->email_error }}">❌ Failed</span>
                                    @else
                                        <span class="email-badge email-pending">⏳ Pending</span>
                                    @endif
                                    @if($att->email_status !== 'sent')
                                        <button type="button" class="resend-btn" onclick="resend('/admin/attendances/{{ $att->id }}/resend')">
                                            Resend
                                        </button>
                                    @endif
                                </td>
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
            <div class="pagination-wrapper">{{ $day2->appends(['tab' => 'day2'])->links() }}</div>
        </div>

        <!-- Day 3 Table -->
        <div id="table-day3" class="admin-table-section" style="display:none;">
            <div class="table-header">
                <form method="GET" action="{{ url()->current() }}" style="display:flex; gap:8px;">
                    <input type="hidden" name="tab" value="day3">
                    <input type="text" name="day3_search" class="table-search" placeholder="Search name, email, phone, agency…" value="{{ $day3Search }}">
                    <button type="submit" class="export-btn">Search</button>
                    @if($day3Search)
                        <a href="{{ url()->current() }}?tab=day3" class="export-btn">Clear</a>
                    @endif
                </form>
                <div style="display:flex; gap:10px;">
                    <a href="/admin/export/3" class="export-btn">Export CSV</a>
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
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Designation</th>
                                <th>Agency</th>
                                <th>Check-in Time</th>
                                <th>Email Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($day3 as $att)
                            <tr>
                                <td><input type="checkbox" class="day3-check" name="ids[]" value="{{ $att->id }}"></td>
                                <td>{{ $att->registration->name }}</td>
                                <td>{{ $att->registration->email }}</td>
                                <td>{{ $att->registration->phone }}</td>
                                <td>{{ $att->registration->designation }}</td>
                                <td>{{ $att->registration->agency }}</td>
                                <td>{{ \Carbon\Carbon::parse($att->checked_in_at)->format('d M Y, h:i A') }}</td>
                                <td>
                                    @if($att->email_status === 'sent')
                                        <span class="email-badge email-sent">✅ Sent</span>
                                    @elseif($att->email_status === 'failed')
                                        <span class="email-badge email-failed" title="{{ $att->email_error }}">❌ Failed</span>
                                    @else
                                        <span class="email-badge email-pending">⏳ Pending</span>
                                    @endif
                                    @if($att->email_status !== 'sent')
                                        <button type="button" class="resend-btn" onclick="resend('/admin/attendances/{{ $att->id }}/resend')">
                                            Resend
                                        </button>
                                    @endif
                                </td>
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
            <div class="pagination-wrapper">{{ $day3->appends(['tab' => 'day3'])->links() }}</div>
        </div>

    </section>

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

        function resend(url) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = url;
            form.style.display = 'none';

            const token = document.createElement('input');
            token.type = 'hidden';
            token.name = '_token';
            token.value = document.querySelector('meta[name="csrf-token"]')?.content;
            form.appendChild(token);

            document.body.appendChild(form);
            form.submit();
        }

        // Restore active tab after a search/pagination reload
        document.addEventListener('DOMContentLoaded', () => {
            const params = new URLSearchParams(window.location.search);
            const tab = params.get('tab');
            if (tab) showTab(tab);
        });
    </script>

</body>
</html>