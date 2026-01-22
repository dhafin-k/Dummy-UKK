<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk Parkir #{{ $transaksi->id }}</title>
    <style>
        @page {
            margin: 0;
            size: 58mm auto;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 9px;
            line-height: 1.4;
            width: 58mm;
            margin: 0 auto;
            padding: 8px;
            background: white;
            color: #000;
        }
        .header {
            text-align: center;
            margin-bottom: 8px;
            padding-bottom: 8px;
            border-bottom: 1px dashed #000;
        }
        .header h1 {
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 2px;
            letter-spacing: 1px;
        }
        .header p {
            font-size: 8px;
            line-height: 1.3;
        }
        .divider {
            border-bottom: 1px dashed #000;
            margin: 8px 0;
            height: 0;
        }
        .info-row {
            margin: 3px 0;
            font-size: 9px;
            overflow: hidden;
        }
        .info-row::after {
            content: "";
            display: table;
            clear: both;
        }
        .info-label {
            float: left;
            width: 45%;
        }
        .info-value {
            float: right;
            width: 55%;
            text-align: right;
            font-weight: bold;
        }
        .total-box {
            margin: 10px 0;
            padding: 8px 0;
            border-top: 2px solid #000;
            border-bottom: 2px solid #000;
        }
        .total-row {
            font-size: 11px;
            font-weight: bold;
            overflow: hidden;
        }
        .total-row::after {
            content: "";
            display: table;
            clear: both;
        }
        .total-label {
            float: left;
        }
        .total-value {
            float: right;
        }
        .footer {
            text-align: center;
            margin-top: 8px;
            padding-top: 8px;
            border-top: 1px dashed #000;
        }
        .footer-thanks {
            font-weight: bold;
            font-size: 10px;
            margin-bottom: 3px;
        }
        .footer-text {
            font-size: 8px;
            line-height: 1.3;
        }
        .timestamp {
            font-size: 7px;
            color: #666;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>SISTEM PARKIR</h1>
        <p>Jl. Contoh No. 123, Kota</p>
        <p>Telp: (021) 12345678</p>
    </div>

    <div class="info-row">
        <span class="info-label">No. Transaksi</span>
        <span class="info-value">#{{ str_pad($transaksi->id, 6, '0', STR_PAD_LEFT) }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Petugas</span>
        <span class="info-value">{{ $transaksi->user->name }}</span>
    </div>

    <div class="divider"></div>

    <div class="info-row">
        <span class="info-label">Plat Nomor</span>
        <span class="info-value">{{ strtoupper($transaksi->kendaraan->plat_nomor) }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Jenis</span>
        <span class="info-value">{{ ucfirst($transaksi->kendaraan->jenis_kendaraan) }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Warna</span>
        <span class="info-value">{{ ucfirst($transaksi->kendaraan->warna) }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Area Parkir</span>
        <span class="info-value">{{ $transaksi->area->nama_area }}</span>
    </div>

    <div class="divider"></div>

    <div class="info-row">
        <span class="info-label">Waktu Masuk</span>
        <span class="info-value">{{ $transaksi->waktu_masuk->format('d/m/Y H:i') }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Waktu Keluar</span>
        <span class="info-value">{{ $transaksi->waktu_keluar ? $transaksi->waktu_keluar->format('d/m/Y H:i') : '-' }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Durasi</span>
        <span class="info-value">{{ $transaksi->durasi_jam ?? 0 }} Jam</span>
    </div>
    <div class="info-row">
        <span class="info-label">Tarif/Jam</span>
        <span class="info-value">Rp {{ number_format($transaksi->tarif->tarif_per_jam, 0, ',', '.') }}</span>
    </div>

    <div class="total-box">
        <div class="total-row">
            <span class="total-label">TOTAL BAYAR</span>
            <span class="total-value">Rp {{ number_format($transaksi->biaya_total ?? 0, 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="footer">
        <p class="footer-thanks">*** TERIMA KASIH ***</p>
        <p class="footer-text">Simpan struk ini sebagai bukti</p>
        <p class="footer-text">parkir yang sah</p>
        <div class="timestamp">
            Dicetak: {{ now()->format('d/m/Y H:i:s') }}
        </div>
    </div>
</body>
</html>