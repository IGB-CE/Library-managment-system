<?php
session_start();
require_once 'lidhja.inc.php';
if(isset($_SESSION["roli"]))
{
    if ($_SESSION['roli']=='admin')
        header("location:admin/index.php");
    else
        header("location:student/index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> Regjistrimi </title>
    <script defer src="js/validimiRregjistrim.js"></script>
    <link rel="stylesheet" href="stili.css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700|Montserrat:300" rel="stylesheet">
</head>
<body>
<header>
    <div class="register-wrapper">
        <div class="register-block">
            <h3 class="register-title">Plotesoni te dhenat e meposhtme per t'u antarsuar ne bibliotek!</h3>
            <p>Aksesoni dhe rezervoni me dhjetra libra.</p>
            <form method="post" action="validoRegjistrim.php" name="reg" onsubmit="return validimiFormes()">
                <input type="text" name="emri" id="emri" placeholder="Vendosni emrin" required>
                <div class="err" id="emriE"></div>
                <input type="text" name="mbiemri" id="mbiemri" placeholder="Vendosni mbiemrin" required>
                <div class="err" id="mbiemriE"></div>
                <input type="email" name="email" id="email" placeholder="Vendosni email-in" required>
                <div class="err" id="emailE"></div>
                <input type="password" name="password"  id="password" placeholder="Vendosni passwordin" required/>
                <div class="err" id="passwordE"></div>
                <select name="niveli">
                    <option>Bachelor</option>
                    <option>Master</option>
                    <option>Doktorature</option>
                </select>
                <input type="number" id="viti" name="viti" min="1" max="3" placeholder="Vendosni vitin" value="1" required>
                <input type="submit" value="Regjistrohu" id="regj" name="submit">
                <div class="err" id="rregjE"></div>
            </form>
        </div>
    </div>
</header>
</body>
</html>