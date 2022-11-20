<!DOCTYPE html>
<html>

<head>
    <title>{{ $settings["SETTINGS_WEBSITE_NAME"] }}</title>
</head>

<body>
    <h1>{{ $details['title'] }}</h1>
    <p>{{ $details['body'] }}</p>
    <?php
        $qrCodeAsPng = base64_encode(QrCode::format('png')->size(250)->generate("my text for the QR code"));
    ?>
    <img src="data:image/png;base64, {!! $qrCodeAsPng !!}" />
    <p>Thank you</p>
    
</body>

</html>