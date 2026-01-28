<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Transaksi Parkir</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box; 
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 15px;
        }

        .header h1 {
            font-size: 24px;
            color: #1e40af;
            margin-bottom: 5px;
        }

        .header .subtitle {
            font-size: 14px;
            color: #6b7280;
            margin-top: 5px;
        }

        .period {
            text-align: center;
            margin-bottom: 20px;
            font-size: 13px;
            color: #4b5563;
        }

        .summary {
            display: table;
            width: 100%;
            margin-bottom: 25px;
        }

        .summary-row {
            display: table-row;
        }

        .summary-item {
            display: table-cell;
            width: 25%;
            padding: 12px;
            background: #f3f4f6;
            border: 1px solid #e5e7eb;
            text-align: center;
        }

        .summary-item .label {
            font-size: 10px;
            color: #6b7280;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .summary-item .value {
            font-size: 18px;
            font-weight: bold;
            color: #1f2937;
        }

        .summary-item.highlight .value {
            color: #16a34a;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #1e40af;
            margin: 25px 0 15px 0;
            padding-bottom: 8px;
            border-bottom: 2px solid #e5e7eb;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table thead {
            background: #1e40af;
            color: white;
        }

        table th {
            padding: 10px 8px;
            text-align: left;
            font-size: 11px;
            font-weight: 600;
        }

        table td {
            padding: 8px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 11px;
        }

        table tbody tr:nth-child(even) {
            background: #f9fafb;
        }

        table tbody tr:hover {
            background: #f3f4f6;
        }

        .status {
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status.masuk {
            background: #dbeafe;
            color: #1e40af;
        }

        .status.keluar {
            background: #dcfce7;
            color: #166534;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            margin-top: 40px;
            padding-top: 15px;
            border-top: 2px solid #e5e7eb;
            text-align: right;
            font-size: 11px;
            color: #6b7280;
        }

        .currency {
            font-family: 'Courier New', monospace;
        }

        .area-stats {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }

        .area-stats-row {
            display: table-row;
        }

        .area-stats-cell {
            display: table-cell;
            width: 33.33%;
            padding: 10px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
        }

        .area-stats-cell .area-name {
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 5px;
        }

        .area-stats-cell .stat {
            font-size: 10px;
            color: #6b7280;
            margin: 2px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>REKAP TRANSAKSI PARKIR</h1>
        <div class="subtitle">Sistem Manajemen Parkir</div>
    </div>

    <div class="period">
        <strong>Periode:</strong> {{ \Carbon\Carbon::parse($startDate)->format('d F Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}
    </div>

    <div class="summary">
        <div class="summary-row">
            <div class="summary-item">
                <div class="label">Total Transaksi</div>
                <div class="value">{{ number_format($totalTransaksi) }}</div>
            </div>
            <div class="summary-item">
                <div class="label">Kendaraan Masuk</div>
                <div class="value">{{ number_format($transaksiMasuk) }}</div>
            </div>
            <div class="summary-item">
                <div class="label">Kendaraan Keluar</div>
                <div class="value">{{ number_format($transaksiKeluar) }}</div>
            </div>
            <div class="summary-item highlight">
                <div class="label">Total Pendapatan</div>
                <div class="value currency">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    @if($statistikArea->count() > 0)
    <h2 class="section-title">Statistik Per Area Parkir</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Area</th>
                <th class="text-center">Kapasitas</th>
                <th class="text-center">Total Transaksi</th>
                <th class="text-right">Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($statistikArea as $area)
            <tr>
                <td>{{ $area->nama_area }}</td>
                <td class="text-center">{{ $area->kapasitas }}</td>
                <td class="text-center">{{ number_format($area->total_transaksi) }}</td>
                <td class="text-right currency">Rp {{ number_format($area->pendapatan_area, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <h2 class="section-title">Detail Transaksi</h2>
    <table>
        <thead>
            <tr>
                <th>Tanggal Masuk</th>
                <th>Plat Nomor</th>
                <th>Jenis</th>
                <th>Area</th>
                <th>Status</th>
                <th>Durasi</th>
                <th class="text-right">Biaya</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksis as $transaksi)
            <tr>
                <td>{{ $transaksi->waktu_masuk->format('d/m/Y H:i') }}</td>
                <td>{{ $transaksi->kendaraan->plat_nomor }}</td>
                <td>{{ ucfirst($transaksi->kendaraan->jenis_kendaraan) }}</td>
                <td>{{ $transaksi->area->nama_area }}</td>
                <td class="text-center">
                    <span class="status {{ $transaksi->status }}">{{ ucfirst($transaksi->status) }}</span>
                </td>
                <td class="text-center">
                    @if($transaksi->durasi_jam)
                        {{ $transaksi->durasi_jam }} jam
                    @else
                        -
                    @endif
                </td>
                <td class="text-right currency">
                    @if($transaksi->biaya_total)
                        Rp {{ number_format($transaksi->biaya_total, 0, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center" style="padding: 20px;">Tidak ada transaksi dalam periode ini</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ now()->format('d F Y H:i:s') }}
    </div>
</body>
</html>
