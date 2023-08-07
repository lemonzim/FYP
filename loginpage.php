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
                background-image: linear-gradient(120deg, #d4fc79 0%, #96e6a1 100%);
                height: 100%;
            }
            h1{
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
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
            button{
                padding:10px;
                border-radius: 20%;
            }
            .center{
                display: flex;
                align-items: center;
                justify-content: center;
            }
        </style>
    </head>
    <body>
    <h1>Dataran Cendekia Food Ordering System Student</h1>
    <div class="loginbox">
        <div class="box">
        <form action="student_enter.php" method="post">
            <label for="name">Student ID:</label><br>
            <input type="text" id="id" name="id"><br><br>
            <label for="pass">Password:</label><br>
            <input type="password" id="password" name="password"><br><br>
            <div class="center"><button class="button" name="login">Login</button></div>
        </form>
        <div > <a href="register_student.php">Register</a><br><br> <a href="loginstall.php">Login as stall</a></div>
        </div>
    </div>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        
        <script src="" async defer></script>
    </body>
</html>
