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
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> Index </title>
    <link rel="stylesheet" href="../stili.css">
    <script defer src="d.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700|Montserrat:300" rel="stylesheet">
    <style>
        .butoni {
            width: 100%;
            line-height: 60px;
            height: 50px;
            max-width: 500px;
            border-radius: 5px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            display: inline-block;
            padding: 0 20px;
            background-color: #7c8291;
            background-size: 100%;
            border: solid 1px #7e8086;
            border-bottom-width: 3px;
            color: white;
            outline: none;
            cursor: pointer;
            -webkit-transition: all 0.3s ease;
            transition: all 0.3s ease;

        }
    </style>
</head>
<body>
<?php
include_once '../navbar.php';
?>
<div class="register-wrapper">
    <div class="register-block">
        <?php
        $id = $_GET['id'];
        $query = mysqli_query($con, "SELECT * FROM libri
   INNER JOIN autori_librit ON libri.id_autorit=autori_librit.id_autor WHERE id_librit=" . $id . "");
        while ($row = mysqli_fetch_assoc($query)) {
            $k = $row['kopertina'];
            if ($k == '') {
                $k = "default_book_cover.jpg";
            }
            echo "<img style='float: left; margin:5%;' src='../upload/" . $k . "' width='150px' height='200px'/><br/>";
            echo "<p><b>Titulli</b>: " . $row["titulli_librit"] . "</p>";
            echo "<p><b>Autori</b>: " . $row["autori"] . "</p>";
            echo "<p><b>ISBN</b>: " . $row["isbn"] . "</p>";
            echo "<p><b>Botimi</b>: " . $row["botimi"] . "</p>";
            echo "<p><b>Numri i faqeve</bold>: " . $row["nr_faqeve"] . "</p>";
            echo "<br><p><b>Pershkrimi</b>: " . $row["permbledhje"] . "</p>";
        }
        ?>
    </div>
</div>
<div class="register-block">
    <p>Ju sugjerojme te beni kerkesen per rezervimin e librave te pakten nje dite para dates se terheqjes.</p>
    <form method="get" action="rezervoLiber.php" onsubmit="return valdata()">
        Data e terheqjes:
        <input type="date" name="datater" id="d1" min= <?php echo date('Y-m-d'); ?>>
        <p>Data e leshimit:
            <input type="date" name="datalesh" id="d2">
        </p>
        <div class="err" style="padding-bottom: 10px" id="dE"></div>
        <input type='hidden' name='id_lib' value='<?php echo $id;?>'>
        <button name='rezervo' class='butoni' value='Rezervo'>Rezervo</button>
    </form>
</div>
<?php
include_once '../footer.php';
?>
</body>
</html>