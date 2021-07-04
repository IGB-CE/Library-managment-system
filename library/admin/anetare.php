<?php
require_once '../lidhja.inc.php';
session_start();
if (!isset($_SESSION["roli"])) {
    header("location:../index.php");
}
else{
    if ($_SESSION["roli"]=='student'){
        header("location:../student/index.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> Anetare biblioteke </title>
    <link rel="stylesheet" href="../stili.css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700|Montserrat:300" rel="stylesheet">
</head>
<body>
<?php
include_once '../navbar.php';
?>
<div class="register-wrapper">
    <?php
    $sql = "SELECT * FROM student  ";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result)==0) {
        echo '<h3>Nuk ka studente te rregjistruar!</h3>';
    }
    else {
        $src_rez = ' <table class="styled-table" border="1"><thead> 
                 <tr>
                 <th>Id</th>
                 <th>Emri</th>
                 <th>Mbiemri</th>
                 <th>Niveli</th>
                 <th>Viti</th>
                 <th>Email</th>
                 <th>Statusi i llogarise</th>
                 <th>Veprime</th>
                 </tr>
            </thead>
            <tbody>';
        while ($row = mysqli_fetch_array($result)) {
            $src_rez .= '<tr><td>' . $row['id'] . '</td>';
            $src_rez .= '<td>' . $row['emri'] . '</td>';
            $src_rez .= '<td>' . $row['mbiemri'] . '</td>';
            $src_rez .= '<td>' . $row['niveli'] . '</td>';
            $src_rez .= '<td>' . $row['viti'] . '</td>';
            $src_rez .= '<td>' . $row['email'] . '</td>';
            if ($row['aktivizuar']==1){
            $src_rez .= '<td>Aktivizuar</td>';
            $src_rez .= '<td><button class="button" onclick="document.location=\'caktivizo.php?id=' . $row['id'] . '&mode=c\'">Caktivizo</button></td>';
            }
            else{
                $src_rez .= '<td>Jo aktiv</td>';
            $src_rez .= '<td><button class="button" onclick="document.location=\'caktivizo.php?id=' . $row['id'] . '&mode=a\'">Aktivizo</button></td>';
        }
            $src_rez .= '</tr>';
        }
        $src_rez.='</tbody></table>';
        echo $src_rez;
    }
    ?>
</div>
</body>
</html>