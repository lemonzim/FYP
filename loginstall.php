<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dataran Cendekia Food Ordering System</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <style>
            *{box-sizing: border-box;}
            body{
                background-color:#30b762;
                height: 100%;
            }
            h1{
                color:white;
                display:flex;
                align-items: center;
                justify-content: center;
                font-size: 5vw;
                text-align: center;
            }
            .loginbox {
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .box{
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                width: 600px;
                height: 350px;
                border: solid white;
                border-radius: 10%;
            }
            input[type=text], [type=password] {
                width: 500px;
                padding: 12px 20px;
                margin: 8px 0;
                }
        </style>
    </head>
    <body>
    <h1>Dataran Cendekia Food Ordering System Stall</h1>
    <div class="loginbox">
        <div class="box">
        <form action="stall_enter.php" method="post">
            <label for="name">Stall ID:</label><br>
            <input type="text" id="id" name="id"><br><br>
            <label for="pass">Password:</label><br>
            <input type="password" id="password" name="password"><br><br>
            <button class="button" name="login">Login</button>
        </form>
        <div> <a href="register_stall.php">Register Stall</a><br><br> <a href="loginpage.php">Login as Student</a></div>
        </div>
    </div>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        
        <script src="" async defer></script>
    </body>
</html>