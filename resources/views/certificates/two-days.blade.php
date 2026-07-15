<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        @page {
            margin: 0;
            size: A4 portrait;
        }

        body {
            margin: 0;
            font-family: DejaVu Serif, Georgia, "Times New Roman", serif;
        }

        .certificate {
            font-size: 13pt;
            line-height: 1.2;
            width: 210mm;
            height: 297mm;
            letter-spacing: 1px;
            background: url('{{ public_path('images/bg5.jpg') }}') no-repeat center center;
            background-size: cover;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="content" style="text-align: center; padding: 20mm;gap:0;">
            <div class="logos" style="display: flex; justify-content: center; margin-top: 35mm;">
                <img src="{{ public_path('images/fds_logo.png') }}" alt="Logo" style="width: auto; height: 80px; flex:1;">
                <img src="{{ public_path('images/mfc_logo.png') }}" alt="Logo" style="width: auto; height: 80px; flex:1;">
            </div>
            <p style="font-weight: bold; letter-spacing: 1px; font-size: 8pt; margin-top: -2mm;">MALAYSIAN FORESTRY CONFERENCE</p>
            <h1 style="line-height: 0.8; font-size: 30pt; color: #7c5d26;">CERTIFICATE<br><span style="font-size: 22pt;">of Attendance</span></h1>
            <p>This is to certify</p>
            <h1 style="font-size: 22pt;">{{ mb_strtoupper($registration->name) }}</h1>
            <p>has attended the<br><strong>21ˢᵗ Malaysian Forestry Conference 2026<br><span style="font-style: italic; color: #305f45; line-height: 1.5;">"Forests as Catalyst for a Green Economy"</strong></span></p>
            <p style="color: #4e4e4e;">13-15ᵗʰ July 2026<br>Pullman Hotel, Kuching, Sarawak</p>
            <p>Organized by<br>Forest Department Sarawak</p>
            <img src="{{ public_path('images/signature.png') }}" alt="Signature of Datu Haji Hamden Bin Haji Mohammad" style="width: 150px; height: auto; margin-bottom: -5mm; margin-top: 10mm;">
            <p style="font-size: 11pt;"><strong>Datu Haji Hamden Bin Haji Mohammad</strong><br><span><strong>Director of Forests Sarawak</strong></span></p>
        </div>
    </div>
</body>
</html>
