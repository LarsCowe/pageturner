<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            border-bottom: 2px solid #4f46e5;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #4f46e5;
            margin: 0;
            font-size: 24px;
        }
        .field {
            margin-bottom: 15px;
        }
        .field-label {
            font-weight: 600;
            color: #666;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .field-value {
            margin-top: 5px;
            color: #333;
        }
        .message-content {
            background-color: #f9fafb;
            border-left: 4px solid #4f46e5;
            padding: 15px;
            margin-top: 10px;
            white-space: pre-wrap;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #999;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Contact Message</h1>
        </div>

        <div class="field">
            <div class="field-label">From</div>
            <div class="field-value">{{ $contactName }}</div>
        </div>

        <div class="field">
            <div class="field-label">Email</div>
            <div class="field-value">
                <a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a>
            </div>
        </div>

        <div class="field">
            <div class="field-label">Subject</div>
            <div class="field-value">{{ $contactSubject }}</div>
        </div>

        <div class="field">
            <div class="field-label">Message</div>
            <div class="message-content">{{ $contactMessage }}</div>
        </div>

        <div class="footer">
            This message was sent via the contact form on PageTurner.<br>
            You can reply directly by responding to this email.
        </div>
    </div>
</body>
</html>
