<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #fa584d;
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
        }
        .footer {
            background-color: #f9f9f9;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
        .button {
            display: inline-block;
            padding: 12px 25px;
            background-color: #fa584d;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 30px;
            font-weight: bold;
            margin-top: 20px;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>COOPROM</h1>
        </div>
        <div class="content">
            <h2>{{ $notifTitle ?? 'Notification de la COOPROM' }}</h2>
            <p>{{ $notifMessage ?? '' }}</p>

            @if(isset($url))
                <div style="text-align: center;">
                    <a href="{{ $url }}" class="button">{{ $buttonText ?? 'Consulter mon espace' }}</a>
                </div>
            @endif

            <p style="margin-top: 30px;">
                Cordialement,<br>
                L'équipe COOPROM
            </p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} COOPROM - Promotion des Artistes. Tous droits réservés.</p>
            <p>Abidjan, Côte d'Ivoire | contact@cooprom.org</p>
        </div>
    </div>
</body>
</html>
