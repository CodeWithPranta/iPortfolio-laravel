<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        h1, h2, h3, p {
            margin-top: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #3498db;
            color: #ffffff;
            padding: 10px;
            text-align: center;
        }

        .content {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 5px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #777;
        }
    </style>
    <title>Contact Form Submission</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Contact Form Submission</h2>
        </div>
        <div class="content">
            <p><strong>Name:</strong> {{ $name }}</p>
            <p><strong>Email:</strong> {{ $email }}</p>
            <p><strong>Subject:</strong> {{ $subject }}</p>
            <p><strong>Message:</strong> {{ $messageBody }}</p>
        </div>
        <div class="footer">
            <p>Thank you for using our contact form.</p>
        </div>
    </div>
</body>
</html>

