<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <title> Biblioteka Online-FTI </title>
    <link rel="stylesheet" href="stili.css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700|Montserrat:300" rel="stylesheet">
</head>
<body onload="document.login.email.focus();">
<header>
    <div class="register-wrapper">
        <div class="register-block">
            <h3 class="register-title">Mireserdhet ne librarine online te FTI!</h3>
            <p>Aksesoni dhe rezervoni me dhjetra libra.</p>
            <form method="post" action="validoLogim.php">
                <input type="email" placeholder="Vendosni email-in" name="email"required/>
                <input type="password" name="password" placeholder="Vendosni password-in" required/>
                <input type="submit" name="submit" value="Login si Student"/>
                <input type="submit" name="submita" value="Login si Admin">
                <p>Nuk jeni akoma anetare?</p>
                <a href="rregjistrim.php"><input type="button" value="Regjistrohu"></a>
            </form>
        </div>
    </div>
</header>
</body>
</html>