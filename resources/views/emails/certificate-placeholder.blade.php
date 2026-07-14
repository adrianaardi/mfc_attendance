<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Attendance</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            background: radial-gradient(circle at top, #e8f3ec 0%, #dcebdd 32%, #cadfcf 100%);
            font-family: "Palatino Linotype", "Book Antiqua", Palatino, Georgia, serif;
            color: #1f2f26;
        }

        .certificate-wrap {
            margin: 0 auto;
            width: 210mm;
            min-height: 297mm;
            background: #f7fbf7;
            border-radius: 0;
            padding: 10mm;
            box-sizing: border-box;
            box-shadow: 0 14px 34px rgba(31, 56, 41, 0.15);
        }

        .page {
            width: 100%;
            min-height: 277mm;
            border: 2px solid #5f7d62;
            border-radius: 14px;
            padding: 22mm 17mm;
            box-sizing: border-box;
            background:
                linear-gradient(145deg, rgba(221, 234, 222, 0.45), rgba(247, 251, 247, 0.95) 32%),
                linear-gradient(0deg, rgba(79, 109, 84, 0.06), rgba(79, 109, 84, 0.06));
            position: relative;
        }

        .page:before,
        .page:after {
            content: "";
            position: absolute;
            border: 1px solid rgba(63, 93, 68, 0.35);
            pointer-events: none;
        }

        .page:before {
            top: 12px;
            right: 12px;
            bottom: 12px;
            left: 12px;
            border-radius: 10px;
        }

        .page:after {
            top: 24px;
            right: 24px;
            bottom: 24px;
            left: 24px;
            border-radius: 8px;
            border-color: rgba(168, 133, 73, 0.45);
        }

        .header {
            text-align: center;
            margin-bottom: 12mm;
            position: relative;
            z-index: 1;
        }

        .logo {
            width: 26mm;
            height: auto;
            margin-bottom: 4mm;
        }

        .conference-name {
            margin: 0;
            font-size: 15px;
            letter-spacing: 2px;
            color: #244534;
            font-weight: 700;
            text-transform: uppercase;
        }

        .title {
            margin: 6mm 0 3mm;
            font-size: 56px;
            letter-spacing: 1.5px;
            line-height: 1.08;
            color: #1d3b2c;
            text-transform: uppercase;
            font-weight: 700;
        }

        .subtitle {
            margin: 0;
            font-size: 13px;
            letter-spacing: 3px;
            color: #6d5b3a;
            text-transform: uppercase;
            font-weight: 700;
        }

        .content {
            text-align: center;
            margin: 10mm auto 0;
            max-width: 155mm;
            position: relative;
            z-index: 1;
        }

        .intro {
            margin: 0;
            font-size: 23px;
            color: #30543e;
        }

        .recipient {
            margin: 7mm 0 6mm;
            font-size: 52px;
            line-height: 1.15;
            color: #173724;
            font-weight: 700;
            border-bottom: 2px solid rgba(74, 108, 79, 0.45);
            padding-bottom: 3mm;
            display: block;
            width: 100%;
            box-sizing: border-box;
            white-space: nowrap;
            overflow: hidden;
        }

        .description {
            margin: 5mm 0;
            font-size: 24px;
            line-height: 1.6;
            color: #2d4d39;
        }

        .theme {
            margin: 4mm 0 0;
            font-size: 26px;
            line-height: 1.4;
            color: #204433;
            font-style: italic;
            font-weight: 700;
        }

        .organizer {
            margin: 10mm 0 0;
            font-size: 18px;
            color: #325641;
        }

        .footer {
            margin-top: 20mm;
            display: table;
            width: 100%;
            position: relative;
            z-index: 1;
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
            font-size: 15px;
            letter-spacing: 0.4px;
            color: #45634d;
        }

        .signature {
            width: 52mm;
            height: auto;
            display: block;
            margin-left: auto;
            margin-bottom: 2mm;
        }

        .sign-name {
            margin: 0;
            font-size: 19px;
            color: #1f3f2d;
            font-weight: 700;
        }

        .sign-title {
            margin: 1mm 0 0;
            font-size: 15px;
            color: #3f5f49;
        }

        @media only screen and (max-width: 860px) {
            body {
                padding: 8px;
            }

            .page {
                min-height: auto;
                padding: 34px 22px;
            }

            .title {
                font-size: 32px;
            }

            .recipient {
                font-size: 30px;
            }

            .description,
            .theme {
                font-size: 18px;
            }

            .footer,
            .footer-cell {
                display: block;
                width: 100%;
                text-align: center;
            }

            .footer-cell.right {
                text-align: center;
                margin-top: 20px;
            }

            .signature {
                margin: 0 auto 6px;
            }
        }
    </style>
</head>
<body>
    <div class="certificate-wrap">
        <div class="page">
            <div class="header">
                <img class="logo" src="{{ asset('images/logo_mfc-no-bg.png') }}" alt="MFC Logo">
                <p class="conference-name">Malaysian Forestry Conference 2026</p>
                <h1 class="title">Certificate of Attendance</h1>
            </div>

            <div class="content">
                <p class="intro">This is to Certify</p>
                @php
                    $recipientName = trim((string) ($registration->name ?? ''));
                    $nameLength = mb_strlen($recipientName);
                    $nameFontSize = max(26, min(52, 52 - max(0, $nameLength - 20) * 1.25));
                @endphp
                <h2 class="recipient" style="font-size: {{ number_format($nameFontSize, 2, '.', '') }}px;">{{ $recipientName }}</h2>
                <p class="description">
                    successfully attended the conference
                    <strong>21st Malaysian Forestry Conference (MFC) 2026</strong>
                </p>
                <p class="theme">"Forests as Catalyst for a Green Economy"</p>
                <p class="subtitle">as held on 13-15 July 2026<br>in Pullman Hotel Kuching Sarawak</p>
                <p class="organizer">
                    Organized by <strong>Forest Department Sarawak</strong>
                </p>
            </div>

            <div class="footer">
                <div class="footer-cell">
                    <!--<p class="issue">Issued on {{ now()->format('d F Y') }}</p>-->
                </div>
                <div class="footer-cell right">
                    <img class="signature" src="{{ asset('images/signature.png') }}" alt="Director Signature">
                    <p class="sign-name">Datu Haji Hamden Bin Haji Mohammad</p>
                    <p class="sign-title">Director of Forests Sarawak</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
