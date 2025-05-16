<? session_start() ?>
<?php

if (!isset($_SESSION['auth'])) {
    header('Location: index.php');
}

?>
<html>

<head>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <? include('patch/header.php'); ?>
    <main>
        <section id="lk">
            <div class="container">
                <div class="rigth_btn">
                    <a href="application/out.php"><div class="button_exit">Выйти</div></a>
                </div>
                <div class="personal_info">
                    <span>Ваш логин: <?= $_COOKIE['username'];?></span><br>
                    <span class="pt-4">Ваша почта: <?= $_COOKIE['useremail'];?></span>
                </div>
                <div class="link-nav" style="padding-top: 30px;">
                    <a href="calc.php" >Расчитать стоимость</a>
                </div>
            </div>
        </section>
    </main>
    <? include('patch/footer.php'); ?>
</body>
<script src="js/script.js"></script>

</html>