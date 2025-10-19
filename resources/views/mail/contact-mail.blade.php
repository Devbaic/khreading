<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
            color: #212529;
        }
        .container {
            background: #ffffff;
            border-radius: 6px;
            padding: 20px;
            max-width: 600px;
            margin: auto;
            border: 1px solid #dee2e6;
        }
        h1 {
            color: #0d6efd;
            font-size: 20px;
            margin-bottom: 20px;
        }
        p {
            line-height: 1.6;
            margin: 5px 0;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>You Have Received a New Contact Message</h1>

        <p><strong>Name:</strong> {{ $mailData['name'] }}</p>
        <p><strong>Email:</strong> {{ $mailData['email'] }}</p>

        <p><strong>Message:</strong></p>
        <p style="white-space: pre-line;">{{ $mailData['message'] }}</p>

        <p class="footer">— Thanks,<br>Your Website Contact Form</p>
    </div>
</body>
</html>
