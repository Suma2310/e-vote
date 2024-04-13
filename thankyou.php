<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .thank-you-container {
            text-align: center;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #51c71e;
        }

        p {
            color: #666666;
            margin-bottom: 10px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
        .check{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="thank-you-container">
        <div class="check" >
            <img src="./Check.png" height="60px" alt="check">
        </div>
        <?php if(isset($_SESSION['option']) && $_SESSION['option'] == 1) : ?>
            <h2>Registration Successfull</h2>
        <?php elseif(isset($_SESSION['option']) && $_SESSION['option'] == 2) : ?>
            <h2>You Have Already Voted</h2>
        <?php elseif(isset($_SESSION['option']) && $_SESSION['option'] == 3) : ?>
            <h2>Vote Cast Successfull</h2>
        <?php endif; ?>
        <p><a href="login.html">Back to Login</a></p>
    </div>
</body>
</html>
