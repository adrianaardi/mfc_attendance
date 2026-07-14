<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Certificate of Attendance</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            background: #eef3ec;
            font-family: DejaVu Serif, Georgia, "Times New Roman", serif;
            color: #1f2f26;
        }

        .certificate-wrap {
            margin: 0 auto;
            width: 210mm;
            height: 297mm;
            background: #f8fbf7;
            padding: 10mm;
            box-sizing: border-box;
        }

        .page {
            width: 100%;
            height: 100%;
            border: 1.2mm solid #4f6d54;
            padding: 8mm;
            box-sizing: border-box;
            background: #f6faf4;
            position: relative;
        }

        .frame {
            width: 100%;
            height: 100%;
            border: 0.5mm solid #6f866f;
            padding: 16mm 13mm;
            box-sizing: border-box;
            position: relative;
        }

        .header {
            text-align: center;
            margin: 0 0 9mm;
        }

        .conference-name {
            margin: 0;
            font-size: 13px;
            letter-spacing: 1.2px;
            color: #244534;
            font-weight: 700;
            text-transform: uppercase;
        }

        .title {
            margin: 4mm 0 2mm;
            font-size: 42px;
            letter-spacing: 1px;
            line-height: 1.1;
            color: #1d3b2c;
            text-transform: uppercase;
            font-weight: 700;
        }

        .subtitle {
            margin: 0;
            font-size: 11px;
            letter-spacing: 2px;
            color: #6d5b3a;
            text-transform: uppercase;
            font-weight: 700;
        }

        .divider {
            width: 78mm;
            height: 0;
            border: 0;
            border-top: 0.5mm solid #7d936f;
            margin: 7mm auto;
        }

        .content {
            text-align: center;
            margin: 0 auto;
            max-width: 150mm;
        }

        .intro {
            margin: 0 0 3mm;
            font-size: 18px;
            color: #30543e;
        }

        .recipient {
            margin: 0 auto 4mm;
            font-size: 28px;
            line-height: 1.15;
            color: #173724;
            font-weight: 700;
            border-bottom: 2px solid rgba(74, 108, 79, 0.45);
            padding-bottom: 2.5mm;
            display: block;
            width: 100%;
            box-sizing: border-box;
        }

        .description {
            margin: 4mm 0;
            font-size: 17px;
            line-height: 1.5;
            color: #2d4d39;
        }

        .theme {
            margin: 3mm 0 0;
            font-size: 21px;
            line-height: 1.35;
            color: #204433;
            font-style: italic;
            font-weight: 700;
        }

        .venue {
            margin: 4mm 0 0;
            font-size: 13px;
            color: #3e5f47;
            line-height: 1.45;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .organizer {
            margin: 8mm 0 0;
            font-size: 15px;
            color: #325641;
        }

        .footer {
            margin-top: 14mm;
            display: table;
            width: 100%;
        }

        .footer-cell {
            display: table-cell;
            vertical-align: bottom;
            width: 50%;
        }

        .footer-cell.right {
            text-align: right;
        }

        .issue {
            margin: 0;
            font-size: 12px;
            letter-spacing: 0.3px;
            color: #45634d;
        }

        .sign-name {
            margin: 0 0 1.2mm;
            font-size: 17px;
            color: #1f3f2d;
            font-weight: 700;
        }

        .sign-title {
            margin: 0;
            font-size: 13px;
            color: #3f5f49;
        }
    </style>
</head>
<body>
    @php
        $recipientName = trim((string) data_get($registration ?? null, 'name', 'Participant'));
    @endphp

    <div class="certificate-wrap">
        <div class="page">
            <div class="frame">
                <div class="header">
                    <p class="conference-name">Forest Department Sarawak</p>
                    <p class="subtitle">Malaysian Forestry Conference 2026</p>
                    <h1 class="title">Certificate of Attendance</h1>
                    <hr class="divider">
                </div>

                <div class="content">
                    <p class="intro">This is to certify</p>
                    <h2 class="recipient">{{ $recipientName }}</h2>
                    <p class="description">
                        has attended the conference <br>
                        <strong>21st Malaysian Forestry Conference (MFC) 2026</strong>
                    </p>
                    <p class="theme">"Forests as Catalyst for a Green Economy"</p>
                    <p class="venue">13-15 July 2026<br>Pullman Hotel, Kuching, Sarawak</p>
                    <p class="organizer">Organized by <strong>Forest Department Sarawak</strong></p>
                </div>

                <div class="footer">
                    <div class="footer-cell">
                        <p class="issue">Issued on {{ now()->format('d F Y') }}</p>
                    </div>
                    <div class="footer-cell right">
                        <p class="sign-name">Datu Haji Hamden Bin Haji Mohammad</p>
                        <p class="sign-title">Director of Forests Sarawak</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
