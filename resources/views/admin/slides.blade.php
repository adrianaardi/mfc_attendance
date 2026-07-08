<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Slides — MFC 2026</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="icon" href="{{ asset('images/logo-icon.png')}}">
    <style>
        body {
            background: var(--cream);
        }
</style>
</head>
<body>

<nav>
    <a href="/">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" onerror="this.style.display='none'" />
    </a>
    <a href="/">Home</a>
    <a href="/admin">Admin</a>
    <a href="/admin/slides" class="nav-active">Slides</a>
    <form method="POST" action="/logout" style="display:inline;">
        @csrf
        <button type="submit" style="background:none; border:none; cursor:pointer; font-family:inherit; font-size:inherit; color:white;">Logout</button>
    </form>
</nav>

<section id="admin-panel">
    <span class="section-label">Admin Panel</span>
    <h2>Manage Slides</h2>

    @if(session('slide_success'))
        <div class="flash-success">{{ session('slide_success') }}</div>
    @endif

    {{-- ADD SLIDE FORM --}}
    <div class="admin-table-section" style="margin-bottom: 32px;">
        <div class="table-header">
            <h3>Add New Slide</h3>
        </div>
        <form method="POST" action="/admin/slides" enctype="multipart/form-data" style="background:#fff; padding:24px; border-radius:var(--radius); box-shadow:var(--shadow);">
            @csrf
            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap:16px; margin-bottom:16px;">
                <div class="form-group">
                    <label>Day</label>
                    <select name="day" required style="padding:11px 14px; border:1.5px solid var(--mist); border-radius:10px; font-family:'DM Sans',sans-serif; font-size:14px; color:var(--text); background:#fafcfb; outline:none;">
                        <option value="1">Day 1</option>
                        <option value="2">Day 2</option>
                        <option value="3">Day 3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Speaker</label>
                    <input type="text" name="speaker" placeholder="e.g. Semilan Ripot, Forest Department Sarawak" required value="{{ old('speaker') }}">
                </div>
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" placeholder="Paper/presentation title" required value="{{ old('title') }}">
                </div>
                <div class="form-group">
                    <label>Upload PDF Slide <span style="color:var(--text-soft); font-weight:400;">(optional)</span></label>
                    <input type="file" name="pdf_file" accept=".pdf" style="padding: 8px 0;">
                </div>
            </div>
            @if($errors->any())
                <div class="flash-error" style="margin-bottom:12px;">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <button type="submit" class="export-btn">+ Add Slide</button>
        </form>
    </div>

    {{-- SLIDES TABLE --}}
    <div class="admin-tabs">
        <button onclick="showSlideTab(1)" class="active" id="stab-1">Day 1</button>
        <button onclick="showSlideTab(2)" id="stab-2">Day 2</button>
        <button onclick="showSlideTab(3)" id="stab-3">Day 3</button>
    </div>

    @foreach([1, 2, 3] as $day)
    <div id="slide-table-{{ $day }}" class="admin-table-section" style="{{ $day !== 1 ? 'display:none;' : '' }}">
        <div class="table-header">
            <h3>Day {{ $day }} Slides</h3>
            <span style="font-size:13px; color:var(--text-soft);">{{ isset($slides[$day]) ? $slides[$day]->count() : 0 }} entries</span>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Speaker</th>
                        <th>Title</th>
                        <th>PDF</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($slides[$day] ?? [] as $slide)
                    <tr id="row-{{ $slide->id }}">
                        <td>{{ $slide->speaker }}</td>
                        <td>{{ $slide->title }}</td>
                        <td>
                            @if($slide->pdf_path)
                                <a href="{{ asset('storage/' . $slide->pdf_path) }}" target="_blank" style="color:var(--moss); font-weight:600; font-size:13px; text-decoration:none;">📄 View PDF</a>
                            @else
                                <span style="color:var(--text-soft); font-size:13px;">—</span>
                            @endif
                        </td>
                        <td style="white-space:nowrap;">
                            <button onclick="openEdit({{ $slide->id }}, '{{ addslashes($slide->speaker) }}', '{{ addslashes($slide->title) }}', '{{ $slide->pdf_path }}', {{ $slide->day }})" class="export-btn" style="padding:6px 12px; font-size:12px; margin-right:6px;">Edit</button>
                            <form method="POST" action="/admin/slides/{{ $slide->id }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" style="padding:6px 12px; font-size:12px;" onclick="return confirm('Delete this slide?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align:center; color:var(--text-soft);">No slides added yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endforeach

</section>

{{-- EDIT MODAL --}}
<div id="editModal" class="modal" style="display:none;">
    <div class="modal-content" style="max-width:480px;">
        <span class="close" onclick="closeEdit()">&times;</span>
        <h2 style="font-family:'Playfair Display',serif; font-size:20px; color:var(--forest); margin-bottom:20px;">Edit Slide</h2>
        <form id="edit-form" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Day</label>
                <select name="day" id="edit-day" style="padding:11px 14px; border:1.5px solid var(--mist); border-radius:10px; font-family:'DM Sans',sans-serif; font-size:14px; width:100%; outline:none;">
                    <option value="1">Day 1</option>
                    <option value="2">Day 2</option>
                    <option value="3">Day 3</option>
                </select>
            </div>
            <div class="form-group">
                <label>Speaker</label>
                <input type="text" name="speaker" id="edit-speaker" style="padding:11px 14px; border:1.5px solid var(--mist); border-radius:10px; font-family:'DM Sans',sans-serif; font-size:14px; width:100%; outline:none; background:#fafcfb;">
            </div>
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" id="edit-title" style="padding:11px 14px; border:1.5px solid var(--mist); border-radius:10px; font-family:'DM Sans',sans-serif; font-size:14px; width:100%; outline:none; background:#fafcfb;">
            </div>
            <div class="form-group">
                <label>Replace PDF File <span style="color:var(--text-soft); font-weight:400;">(Leave blank to keep current)</span></label>
                <input type="file" name="pdf_file" accept=".pdf" style="padding:8px 0;">
                <span id="current-pdf-label" style="font-size:11px; color:var(--text-soft); display:block; margin-top:2px;"></span>
            </div>
            <button type="submit" class="export-btn" style="width:100%; justify-content:center; margin-top:8px;">Save Changes</button>
        </form>
    </div>
</div>

<script>
    function showSlideTab(n) {
        document.querySelectorAll('[id^="slide-table-"]').forEach(el => el.style.display = 'none');
        document.querySelectorAll('.admin-tabs button').forEach(el => el.classList.remove('active'));
        document.getElementById('slide-table-' + n).style.display = 'block';
        document.getElementById('stab-' + n).classList.add('active');
    }

    function openEdit(id, speaker, title, pdfPath, day) {
        document.getElementById('edit-form').action = '/admin/slides/' + id;
        document.getElementById('edit-speaker').value = speaker;
        document.getElementById('edit-title').value = title;
        document.getElementById('edit-day').value = day;
        
        // Show file presence feedback inside modal script
        const label = document.getElementById('current-pdf-label');
        if (pdfPath && pdfPath !== 'null' && pdfPath !== '') {
            label.innerText = "Current file: " + pdfPath.split('/').pop();
        } else {
            label.innerText = "No file currently attached.";
        }

        document.getElementById('editModal').style.display = 'flex';
    }

    function closeEdit() {
        document.getElementById('editModal').style.display = 'none';
    }

    window.addEventListener('click', e => {
        if (e.target === document.getElementById('editModal')) closeEdit();
    });
</script>

</body>
</html>