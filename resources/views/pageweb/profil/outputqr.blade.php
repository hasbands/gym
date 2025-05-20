<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Member</title>
    <style>
        @page {
            size: 85.6mm 53.98mm; /* Ukuran kartu standar */
            margin: 0;
        }
        body {
            margin: 0;
            padding: 0;
            width: 85.6mm;
            height: 53.98mm;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #1a237e, #0d47a1);
            color: white;
            padding: 5mm;
            box-sizing: border-box;
            position: relative;
        }
        .card-header {
            text-align: center;
            margin-bottom: 2mm;
        }
        .card-header h1 {
            margin: 0;
            font-size: 14px;
            text-transform: uppercase;
        }
        .card-body {
            background-color: rgba(255,255,255,0.1);
            padding: 3mm;
            border-radius: 3mm;
        }
        .info-row {
            margin-bottom: 2mm;
            display: flex;
            justify-content: space-between;
            font-size: 10px;
        }
        .info-label {
            font-weight: bold;
            color: #b3e5fc;
        }
        .info-value {
            text-align: right;
        }
        .card-footer {
            position: absolute;
            bottom: 2mm;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 8px;
            color: #b3e5fc;
        }
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h1>Kartu Member</h1>
        </div>
        <div class="card-body">
            <div class="info-row">
                <span class="info-label">Nama:</span>
                <span class="info-value">{{ $member->user->nama }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Paket:</span>
                <span class="info-value">{{ $member->masterPaket->nama_paket }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Mulai:</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($member->mulai)->isoFormat('D MMMM Y') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Selesai:</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($member->selesai)->isoFormat('D MMMM Y') }}</span>
            </div>
        </div>
        <div class="card-footer">
            © {{ date('Y') }} Gym Membership Card
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>
</html>
