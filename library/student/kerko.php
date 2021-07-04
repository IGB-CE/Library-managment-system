<!DOCTYPE html>
<?php
require_once '../lidhja.inc.php';
session_start();
if (!isset($_SESSION["roli"])) {
    header("location:../index.php");
}
else{
    if ($_SESSION["roli"]=='admin'){
        header("location:../admin/index.php");
    }
}
?>
<html>
<head>
    <meta charset="utf-8">
    <title> Index </title>
    <link rel="stylesheet" href="../stili.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="libri.css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700|Montserrat:300" rel="stylesheet">
</head>
<body>
<?php
include_once '../navbar.php';
?>
<script language="javascript" type="text/javascript">
    function ajaxFunction() {
        var ajaxRequest;
        try {
            ajaxRequest = new XMLHttpRequest();
        } catch (e) {
            try {
                ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try {
                    ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {
                    alert("Your browser broke!");
                    return false;
                }
            }
        }
        ajaxRequest.onreadystatechange = function () {
            if (ajaxRequest.readyState == 4) {
                var ajaxDisplay = document.getElementById('ajaxDiv');
                ajaxDisplay.innerHTML = ajaxRequest.responseText;
            }
        }
        var src = document.getElementById('src').value;
        var aut = document.getElementById('autori').value;
        var kat = document.getElementById('kategoria').value;
        var queryString = "?src=" + src;
        if (aut != "")
            queryString += "&aut=" + aut;
        if (kat != "")
            queryString += "&kat=" + kat;
        ajaxRequest.open("GET", "kerkoLibra.php" + queryString, true);
        ajaxRequest.send(null);
    }
</script>

    <div class="register-block">
        <form action="kerko.php">
            <input type="search" name="src" id="src" placeholder="Jepni titullin e librit">
            <label> Zgjidhni autorin:
                <select name="autori" id="autori">
                    <option></option>
                    <?php
                    $zgjidh = 'SELECT autori FROM autori_librit';
                    $result = mysqli_query($con, $zgjidh);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option>" . $row['autori'] . "</option>";
                    }
                    ?>
                </select>
            </label>
            <label> Zgjidhni kategorine:
                <select name="kategoria" id="kategoria">
                    <option></option>
                    <?php
                    $zgjidh = 'SELECT kategoria FROM kategoria_librit';
                    $result = mysqli_query($con, $zgjidh);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option>" . $row['kategoria'] . "</option>";
                    }
                    ?>
                </select>
            </label>
            <input class="button" style="float:right;" type='button' onclick='ajaxFunction()' value='Kerko'/>
        </form>
    </div>

<div id="large-th">
    <div class="container">
        <div class="choose">
            <a href="#list-th"><i class="fa fa-th-list" aria-hidden="true"></i></a>
            <a href="#large-th"><i class="fa fa-th-large" aria-hidden="true"></i></a>
        </div>
        <div id="list-th">
            <div id = 'ajaxDiv'></div>
        </div>
    </div>
</div>
</body>
</html>