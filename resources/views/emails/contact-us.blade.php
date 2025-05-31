<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Srikandi Merch</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #2563eb;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background-color: #f8f9fa;
            padding: 30px;
            border: 1px solid #e5e7eb;
        }
        .footer {
            background-color: #374151;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 0 0 8px 8px;
            font-size: 14px;
        }
        .info-box {
            background-color: white;
            padding: 20px;
            margin: 15px 0;
            border-left: 4px solid #2563eb;
            border-radius: 4px;
        }
        .label {
            font-weight: bold;
            color: #374151;
            margin-bottom: 5px;
        }
        .value {
            color: #6b7280;
            margin-bottom: 15px;
        }
        .message-content {
            background-color: white;
            padding: 20px;
            border-radius: 6px;
            border: 1px solid #d1d5db;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Pesan Baru dari Contact Us</h1>
    </div>
    
    <div class="content">
        <p>Anda menerima pesan baru dari halaman Contact Us website Anda.</p>
        
        <div class="info-box">
            <div class="label">Nama Pengirim:</div>
            <div class="value">{{ $senderName }}</div>
            
            <div class="label">Email Pengirim:</div>
            <div class="value">{{ $senderEmail }}</div>
            
            <div class="label">Waktu Pengiriman:</div>
            <div class="value">{{ now()->setTimezone('Asia/Jakarta')->format('d F Y, H:i:s') }} WIB</div>
        </div>
        
        <div class="label">Pesan:</div>
        <div class="message-content">{{ $messageContent }}</div>
        
        <p style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 14px;">
            <strong>Catatan:</strong> Anda dapat membalas email ini secara langsung untuk merespon pengirim.
        </p>
    </div>
    
    <div class="footer">
        <p>&copy; {{ date('Y') }} Srikandi Merch. Email otomatis dari sistem Contact Us.</p>
    </div>
</body>
</html>