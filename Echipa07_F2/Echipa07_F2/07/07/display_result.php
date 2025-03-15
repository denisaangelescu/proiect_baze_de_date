<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Operation Result</title>
    <style>
        .checkmark {
            width: 100px;
            height: 100px;
            display: block;
            margin: 20px auto;
            background: url('https://upload.wikimedia.org/wikipedia/commons/thumb/7/73/Flat_tick_icon.svg/1200px-Flat_tick_icon.svg.png') no-repeat center center;
            background-size: contain;
        }
        .btn-back {
            display: block;
            width: 200px;
            padding: 10px;
            margin: 20px auto;
            text-align: center;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn-back:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="checkmark"></div>
    <p style="text-align: center;">
        <?php
        if (isset($_GET['message'])) {
            echo htmlspecialchars($_GET['message']);
        } else {
            echo "No message available.";
        }
        ?>
    </p>
    <a href="index.php" class="btn-back">Acasă</a>
</body>
</html>


