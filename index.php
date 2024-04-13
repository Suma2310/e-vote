<!DOCTYPE html>
<html lang="en">
<head>
    <title>E-voting</title>
    <link rel="shortcut icon" href="./Store/Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./styles.css">
    <style>
        body{
            background: aliceblue;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .logo{
            border-radius: 50%;
            overflow: hidden;
            max-width: 100%;
            height: 300px;
            padding: 30px;
        }
        .lgd , .slogan{
            margin: 20px auto;
            text-align: center;
        }
        .slogan p{
            font-size: 40px;
            font-weight: 800;
            color: #316299;
            margin: 0;
        }
        .login{
            display: flex;
            padding: 30px 200px;
            justify-content: space-evenly;
            align-items: center;
            margin-top: 20px;
        }
        .login a{
            border-style: none;
            border-radius: 20px;
            background-color: #316299;
            color: white;
            padding: 10px 50px;
            text-decoration: none;
            font-size: 25px;
            font-weight: bolder;
            transition: background-color 0.3s ease;
        }
        .login a:hover{
            background-color: #1D2E41;
        }

        @media screen and (max-width: 600px) {
            .login {
                flex-direction: column;
            }
            .login a {
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
    <section class="lgd" >
        <img class="logo" src="./Store/Logo.png" alt="logo">
    </section>
    <div class="slogan">
        <p>Vote for Change, Vote for Progress!</p>
    </div>
    <div class="login">
        <a href="./login.html">Voter</a>
        <a href="./login.html">Admin</a>
    </div>
</body>
</html>
