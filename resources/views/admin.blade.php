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
                <strong>{{ $registrations->count() }}</strong>
                <form method="POST" action="/admin/toggle/registration">
                    @csrf
                    <button type="submit" class="toggle-btn {{ $settings['registration'] ? 'toggle-on' : 'toggle-off' }}">
                        {{ $settings['registration'] ? '✅ Registration Open' : '🔴 Registration Closed' }}
                    </button>
                </form>
            </div>
            <div class="admin-card">
                <span>Day 1 Attendance</span>
                <strong>{{ $day1->count() }}</strong>
                <form method="POST" action="/admin/toggle/attendance_day1">
                    @csrf
                    <button type="submit" class="toggle-btn {{ $settings['attendance_day1'] ? 'toggle-on' : 'toggle-off' }}">
                        {{ $settings['attendance_day1'] ? '✅ Day 1 Open' : '🔴 Day 1 Closed' }}
                    </button>
                </form>
            </div>
            <div class="admin-card">
                <span>Day 2 Attendance</span>
                <strong>{{ $day2->count() }}</strong>
                <form method="POST" action="/admin/toggle/attendance_day2">
                    @csrf
                    <button type="submit" class="toggle-btn {{ $settings['attendance_day2'] ? 'toggle-on' : 'toggle-off' }}">
                        {{ $settings['attendance_day2'] ? '✅ Day 2 Open' : '🔴 Day 2 Closed' }}
                    </button>
                </form>
            </div>
            <div class="admin-card">
                <span>Day 3 Attendance</span>
                <strong>{{ $day3->count() }}</strong>
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
            <button onclick="showTab('at-least-two-days')" id="tab-at-least-two-days">2+ Days</button>
        </div>

        <!-- Registrations Table -->
        <div id="table-registrations" class="admin-table-section">
            <div class="table-header">
                <h3>All Registrations</h3>
                <div style="display:flex; gap:10px;">
                    <a href="/admin/export/registrations" class="export-btn">Export CSV</a>
                    @if(auth()->check() && auth()->user()->email === 'adollyana@email.com')
                    <button type="button" onclick="submitDelete('form-delete-registrations')" class="delete-btn">Delete Selected</button>
                    @endif
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
                            @forelse($registrations as $i => $reg)
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
                                        <button type="button" class="resend-btn" onclick="resend('/admin/registrations/{{ $reg->id }}/resend')">Resend</button>
                                    @endif
                                </td>
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
                    @if(auth()->check() && auth()->user()->email === 'adollyana@email.com')
                    <button type="button" onclick="submitDelete('form-delete-registrations')" class="delete-btn">Delete Selected</button>
                    @endif
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
                            @forelse($day1 as $i => $att)
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
                                        <button type="button" class="resend-btn" onclick="resend('/admin/attendances/{{ $att->id }}/resend')">Resend</button>
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
        </div>

        <!-- Day 2 Table -->
        <div id="table-day2" class="admin-table-section" style="display:none;">
            <div class="table-header">
                <h3>Day 2 Attendance</h3>
                <div style="display:flex; gap:10px;">
                    <a href="/admin/export/2" class="export-btn">Export CSV</a>
                    @if(auth()->check() && auth()->user()->email === 'adollyana@email.com')
                    <button type="button" onclick="submitDelete('form-delete-registrations')" class="delete-btn">Delete Selected</button>
                    @endif
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
                            @forelse($day2 as $i => $att)
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
                                        <button type="button" class="resend-btn" onclick="resend('/admin/attendances/{{ $att->id }}/resend')">Resend</button>
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
        </div>

        <!-- Day 3 Table -->
        <div id="table-day3" class="admin-table-section" style="display:none;">
            <div class="table-header">
                <h3>Day 3 Attendance</h3>
                <div style="display:flex; gap:10px;">
                    <a href="/admin/export/3" class="export-btn">Export CSV</a>
                    @if(auth()->check() && auth()->user()->email === 'adollyana@email.com')
                    <button type="button" onclick="submitDelete('form-delete-registrations')" class="delete-btn">Delete Selected</button>
                    @endif
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
                            @forelse($day3 as $i => $att)
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
                                        <span class="email-badge email-sent" title="Email sent successfully">✅ Sent</span>
                                    @elseif($att->email_status === 'failed')
                                        <span class="email-badge email-failed" title="{{ $att->email_error }}">❌ Failed</span>
                                    @else
                                        <span class="email-badge email-pending" title="Email not sent">⏳ Pending</span>
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
        </div>

        <!-- At Least 2 Days Table -->
        <div id="table-at-least-two-days" class="admin-table-section" style="display:none;">
            <div class="table-header">
                <h3>Attended At Least 2 Days</h3>
                <div style="display:flex; gap:10px; align-items:center;">
                    <div style="display:flex; gap:8px; align-items:center;">
                        <a href="/admin?tab=at-least-two-days" class="export-btn" style="{{ empty($twoDaysEmailStatus) ? 'opacity:1;' : 'opacity:.75;' }}">All</a>
                        <a href="/admin?tab=at-least-two-days&two_days_email_status=unsent" class="export-btn" style="{{ ($twoDaysEmailStatus ?? '') === 'pending' ? 'opacity:1;' : 'opacity:.75;' }}">Unsent</a>
                        <a href="/admin?tab=at-least-two-days&two_days_email_status=failed" class="export-btn" style="{{ ($twoDaysEmailStatus ?? '') === 'failed' ? 'opacity:1;' : 'opacity:.75;' }}">Failed</a>
                        <a href="/admin?tab=at-least-two-days&two_days_email_status=sent" class="export-btn" style="{{ ($twoDaysEmailStatus ?? '') === 'sent' ? 'opacity:1;' : 'opacity:.75;' }}">Sent</a>
                    </div>
                    <button id="send-two-days-btn" type="button" onclick="submitSendTwoDays()" class="export-btn">Send Email</button>
                </div>
            </div>
            <form id="form-send-two-days" method="POST" action="/admin/two-days/send-email">
                @csrf
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th><input type="checkbox" onclick="toggleAll(this, 'two-days-check')"></th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Designation</th>
                                <th>Agency</th>
                                <th>Days Attended</th>
                                <th>Email Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($atLeastTwoDays as $reg)
                            <tr>
                                <td><input type="checkbox" class="two-days-check" name="ids[]" value="{{ $reg->id }}"></td>
                                <td>{{ $reg->name }}</td>
                                <td>{{ $reg->email }}</td>
                                <td>{{ $reg->phone }}</td>
                                <td>{{ $reg->designation }}</td>
                                <td>{{ $reg->agency }}</td>
                                <td>{{ $reg->attendances_count }}</td>
                                <td>
                                    @if($reg->two_days_email_status === 'sent')
                                        <span class="email-badge email-sent">✅ Sent</span>
                                    @elseif($reg->two_days_email_status === 'failed')
                                        <span class="email-badge email-failed" title="{{ $reg->two_days_email_error }}">❌ Failed</span>
                                    @else
                                        <span class="email-badge email-pending">⏳ Not Sent</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" style="text-align:center; color:var(--text-soft);">No attendees with 2 or more days yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>
            <div id="two-days-send-progress" class="two-days-send-progress" style="display:none;"></div>
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

        async function submitSendTwoDays() {
            const form = document.getElementById('form-send-two-days');
            const checked = form.querySelectorAll('input.two-days-check:checked');
            const sendButton = document.getElementById('send-two-days-btn');
            const progress = document.getElementById('two-days-send-progress');
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

            if (checked.length === 0) {
                alert('Please select at least one record to send email.');
                return;
            }

            if (!confirm(`Send 2+ days email to ${checked.length} selected attendee(s)?`)) {
                return;
            }

            const ids = Array.from(checked).map((cb) => Number(cb.value)).filter(Boolean);
            const chunkSize = 3;
            let sentTotal = 0;
            let failedTotal = 0;
            let processedTotal = 0;

            sendButton.disabled = true;
            sendButton.style.opacity = '0.7';
            progress.style.display = 'block';
            progress.textContent = `Starting send process (0/${ids.length})...`;

            try {
                for (let i = 0; i < ids.length; i += chunkSize) {
                    const batchIds = ids.slice(i, i + chunkSize);
                    progress.textContent = `Sending ${Math.min(i + batchIds.length, ids.length)} / ${ids.length}...`;

                    const response = await fetch('/admin/two-days/send-email/batch', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({ ids: batchIds }),
                    });

                    const data = await response.json().catch(() => ({}));

                    if (!response.ok || data.ok === false) {
                        throw new Error(data.message || 'Failed while sending one of the batches.');
                    }

                    sentTotal += Number(data.sent || 0);
                    failedTotal += Number(data.failed || 0);
                    processedTotal += Number(data.processed || 0);
                }

                progress.textContent = `Completed. Sent: ${sentTotal}, Failed: ${failedTotal}, Processed: ${processedTotal}. Reloading...`;
                window.setTimeout(() => window.location.reload(), 900);
            } catch (error) {
                progress.textContent = `Stopped: ${error.message}`;
                sendButton.disabled = false;
                sendButton.style.opacity = '1';
            }
        }

        @if(request('tab') === 'at-least-two-days')
            showTab('at-least-two-days');
        @endif
    </script>

</body>
</html>