<? session_start() ?>
<?php
if (!isset($_SESSION['auth'])) {
    header('Location: index.php');
}
?>
<html>

<head>
<link rel="icon" href="assets/logo.svg">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <? include('patch/header.php'); ?>
    <main>
        <section id="lk">
            <div class="container">
                <div class="rigth_btn">
                    <a href="application/out.php">
                        <div class="button_exit">Выйти</div>
                    </a>
                </div>
                <div class="personal_info">
                    <span>Ваш логин: <?= $_COOKIE['username']; ?></span><br>
                    <span class="pt-4">Ваша почта: <?= $_COOKIE['useremail']; ?></span><br>
                    <? if ($_SESSION['admin'] === '1'): ?>
                        <span style="background-color:black; border-radius: 5px; padding: 5px;">Вы админ</span>
                    <? endif; ?>
                </div>
                <div class="link-nav" style="padding-top: 30px;">
                    <? if ($_SESSION['admin'] === '1'): ?>
                        <a href="add-servis.php">Добавить услугу</a><br><br>
                        <a href="data-subscribe.php">Пользователи с подпиской</a><br><br>
                    <? endif; ?>

                    <a href="calc.php">Расчитать стоимость</a>
                </div>
            </div>
        </section>
    </main>
    <? include('patch/footer.php'); ?>

</body>
<script src="js/script.js"></script>

</html>