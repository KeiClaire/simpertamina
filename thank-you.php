<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #f0f4f8;
        }
        .thank-you-container {
            text-align: center;
            background: #ffffff;
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }
        .thank-you-container h1 {
            font-size: 48px;
            margin-bottom: 20px;
            color: #333333;
        }
        .thank-you-container p {
            font-size: 18px;
            color: #555555;
            margin-bottom: 30px;
        }
        .thank-you-container a {
            display: inline-block;
            text-decoration: none;
            background: #007bff;
            color: #ffffff;
            padding: 12px 30px;
            border-radius: 5px;
            font-weight: 600;
            transition: background 0.3s;
        }
        .thank-you-container a:hover {
            background: #0056b3;
        }
        .thank-you-container .success-icon {
            font-size: 80px;
            color: #28a745;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="thank-you-container">
        <div class="success-icon">✔</div>
        <h1>Thank You!</h1>
        <p>Your submission has been received successfully.</p>
        <a href="index.php">Go Back to Home</a>
    </div>
</body>
</html>
