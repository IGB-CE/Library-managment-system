<header>
    <div class="navbar">
        <a href="index.php" class="logo"> FTI-LIBRARIA ONLINE </a>
        <ul class="nav">
            <li><a href="http://www.fti.edu.al/">Faqja FTI</a></li>
            <li><a href="kerkesa.php">Kerkesat</a></li>
            <?php if ($_SESSION['roli'] == 'admin') { ?>
                <li><a href="anetare.php">Anetaret</a></li>
            <?php }
            if ($_SESSION['roli'] == 'student') { ?>
                <li><a href="kerko.php">Kerko</a></li>
                <li><a href="profili.php"><?php echo $_SESSION['emri'] ?></a></li>
            <?php } ?>
            <li><a href="../logout.php">Dilni</a></li>
        </ul>
</header>