<? session_start() ?>
<header>
    <div class="container">
        <div class="content-header">
            <a href="index.php"><img src="assets/logo.svg" alt="Логотип" /></a>
            <nav class="menu" id="menu-header">
                <ul>
                    <li><a href="index.php">Главная</a></li>
                    <li><a href="sevices.php">Наши Услуги</a></li>
                    <li><a href="about.php">О нас</a></li>
                    <li><a href="contact.php">Связаться</a></li>
                    <li><a href="blog.php">Блог</a></li>
                    <? if ($_SESSION['auth'] === true): ?>
                        <li><a href="lk.php">Личный кабинет</a></li>
                    <? else: ?>
                        <li><a href="application/auth.php">Войти</a></li>
                    <? endif; ?>
                </ul>
            </nav>
            <div class="burger" id="burger">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
        </div>
    </div>
</header>
<script src="https://code.jquery.com/jquery-2.2.0.min.js"
    type="text/javascript"></script>
<script src="slick-rep/slick/slick.js" type="text/javascript"
    charset="utf-8"></script>