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
            color: black;
        }

        .header {
            text-align: center;
            margin-bottom: 8px;
            padding-bottom: 8px;
            border-bottom: 1px dashed black;
        }

        .header h1 {
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 2px;
            letter-spacing: 1px;
        }

        .pembatas {
            border-bottom: 1px dashed black;
            margin: 8px 0;
            height: 0;
        }

        .baris-info {
            margin: 3px 0;
            font-size: 9px;
            overflow: hidden;
        }

        .baris-info::after {
            content: '';
            display: table;
            clear: both;
        }

        .label-info {
            float: left;
            width: 45%;
        }

        .value-info {
            float: right;
            width: 55%;
            text-align: right;
            font-weight: bold;
        }

        .total-box {
            margin: 10px 0;
            padding: 8px 0;
            border-top: 2px solid black;
            border-bottom: 2px solid black;
        }

        .total-baris {
            overflow: hidden;
            font-size: 11px;
            font-weight: bold;
        }

        .total-baris::after {
            content: '';
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
            border-top: 1px dashed black;
        }

        .footer-terimakasih {
            font-weight: bold;
            font-size: 10px;
            margin-bottom: 3px;
        }

        .footer-text {
            font-size: 8px;
            line-height: 1.3;
        }

        .footer-waktu {
            font-size: 7px;
            margin-top: 5px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Struk Parkir</h1>
        <p>struk parkir #{{ $transaksi->id }}</p>
    </div>

    <div class="baris-info">
        <span class="label-info">No. Transaksi</span>
        <span class="value-info">#{{ str_pad($transaksi->id, 6, '0', STR_PAD_LEFT) }}</span>
    </div>
    <div class="baris-info">
        <span class="label-info">Petugas</span>
        <span class="value-info">{{ $transaksi->user->name }}</span>
    </div>

    <div class="pembatas"></div>

    <div class="baris-info">
        <span class="label-info">Plat Nomor</span>
        <span class="value-info">{{ $transaksi->kendaraan->plat_nomor }}</span>
    </div>
    <div class="baris-info">
        <span class="label-info">Jenis Kendaraan</span>
        <span class="value-info">{{ $transaksi->kendaraan->jenis_kendaraan }}</span>
    </div>
    <div class="baris-info">
        <span class="label-info">Warna</span>
        <span class="value-info">{{ $transaksi->kendaraan->warna }}</span>
    </div>
    <div class="baris-info">
        <span class="label-info">Area Parkir</span>
        <span class="value-info">{{ $transaksi->area->nama_area }}</span>
    </div>

    <div class="pembatas"></div>

    <div class="baris-info">
        <span class="label-info">Waktu Masuk</span>
        <span class="value-info">{{ $transaksi->waktu_masuk->format('d-m-Y H:i:s') }}</span>
    </div>
    <div class="baris-info">
        <span class="label-info">Waktu Keluar</span>
        <span class="value-info">{{ $transaksi->waktu_keluar ? $transaksi->waktu_keluar->format('d-m-Y H:i:s') : '-' }}</span>
    </div>
    <div class="baris-info">
        <span class="label-info">Durasi</span>
        <span class="value-info">{{ $transaksi->durasi_jam ?? '0' }} Jam</span>
    </div>
    <div class="baris-info">
        <span class="label-info">Tarif Per Jam</span>
        <span class="value-info">Rp. {{ number_format($transaksi->tarif->tarif_per_jam, 0, ',', '.') }}</span>
    </div>

    <div class="total-box">
        <div class="total-baris">
            <span class="total-label">BIAYA TOTAL</span>
            <span class="total-value">Rp. {{ number_format($transaksi->biaya_total, 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="footer">
        <p class="footer-terimakasih">*** TERIMA KASIH ***</p>
        <p class="footer-text">simpan struk ini sebagai bukti pembayaran yang sah</p>
        <p class="footer-waktu">
            Dicetak pada: {{ now()->format('d/m/Y H:i:s') }}
        </p>
    </div>

</body>

</html>