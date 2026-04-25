<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pass Événement - COOPROM</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #333; margin: 0; padding: 0; }
        .pass-container { width: 100%; max-width: 600px; margin: 50px auto; border: 2px solid #ff3c36; border-radius: 15px; overflow: hidden; }
        .header { background-color: #ff3c36; color: white; padding: 20px; text-align: center; }
        .header h1 { margin: 0; font-size: 24px; text-transform: uppercase; }
        .header p { margin: 5px 0 0; font-size: 14px; opacity: 0.9; }
        .content { padding: 30px; position: relative; }
        .event-title { color: #ff3c36; font-size: 22px; font-weight: bold; margin-bottom: 20px; border-bottom: 1px solid #eee; pb: 10px; }
        .info-grid { width: 100%; margin-bottom: 30px; }
        .info-label { font-size: 12px; color: #888; text-transform: uppercase; margin-bottom: 5px; }
        .info-value { font-size: 16px; font-weight: bold; margin-bottom: 15px; }
        .qr-placeholder { position: absolute; top: 30px; right: 30px; width: 120px; height: 120px; border: 1px solid #ddd; padding: 5px; text-align: center; }
        .qr-text { font-size: 10px; color: #aaa; margin-top: 40px; }
        .footer { background-color: #f8f8f8; padding: 15px; text-align: center; border-top: 1px dashed #ddd; }
        .footer p { margin: 0; font-size: 12px; color: #666; }
        .watermark { position: absolute; bottom: 10px; right: 10px; opacity: 0.05; font-size: 80px; transform: rotate(-30deg); z-index: -1; }
    </style>
</head>
<body>
    <div class="pass-container">
        <div class="header">
            <h1>COOPROM</h1>
            <p>Coopérative pour la Promotion des Artistes de Côte d'Ivoire</p>
        </div>

        <div class="content">
            <div class="watermark">PASS</div>

            <div class="event-title">{{ $event->title }}</div>

            <div class="qr-placeholder">
                <div class="qr-text">QR CODE<br>VALIDATION</div>
                <div style="font-size: 8px; margin-top: 10px;">ID: {{ $registration->id }}-{{ substr($user->uuid, 0, 8) }}</div>
            </div>

            <table class="info-grid">
                <tr>
                    <td width="60%">
                        <div class="info-label">Nom de l'Adhérent</div>
                        <div class="info-value">{{ strtoupper($user->last_name) }} {{ $user->name }}</div>

                        <div class="info-label">Secteur Culturel</div>
                        <div class="info-value">{{ $user->culturalSector->name ?? 'Artiste' }}</div>

                        <div class="info-label">Date de l'événement</div>
                        <div class="info-value">
                            Du {{ $event->start_date->format('d/m/Y') }} à {{ $event->start_date->format('H:i') }}
                            @if($event->end_date)
                                <br>au {{ $event->end_date->format('d/m/Y') }} à {{ $event->end_date->format('H:i') }}
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="info-label">Lieu</div>
                        <div class="info-value">{{ $event->location }}</div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <p>Ce pass est strictement personnel et peut être contrôlé à l'entrée.<br>
            <strong>COOPROM - Valorisons notre culture.</strong></p>
        </div>
    </div>
</body>
</html>
