<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .email-content {
            margin-bottom: 20px;
        }
        .email-signature {
            text-align: right;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email-header">
        <img src="https://cdn.pixabay.com/photo/2020/05/11/22/31/cat-5160456_960_720.png" alt="Logo" width="30px; height 30px">
        <h2>Xin chào, {{ $reply->commentable->user->name }}</h2>
    </div>
    <div class="email-content">
        <p>Bạn đã được hệ thống trả lời:</p>
        <p>{{ $reply->content }}</p>
    </div>
    <img src="https://i.pinimg.com/custom_covers/222x/734790564142559148_1588646204.jpg">
    <div class="email-signature">
        <p>Trân trọng,</p>
    </div>
</div>
</body>
</html>
