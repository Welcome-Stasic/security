<? include('application/subscribe.php'); ?>
<footer>
    <div class="container">
        <div class="footer-content">
            <div class="footer-up_content">
                <ul class="footer_menu">
                    <li>Юридический</li>
                    <li><a href="#">Политика конфиденциальности</a></li>
                    <li><a href="#">Условия и положения</a></li>
                    <li><a href="#">О нас</a></li>
                </ul>
                <div class="footer_line"></div>
                <div class="footer-center_content">
                    <img class="img" src="assets/logo.svg" alt="Логотип">
                    <div class="link_img">
                        <img src="assets/icon/Vector (3).svg" alt="Твиттер">
                        <img src="assets/icon/akar-icons_instagram-fill.svg" alt="Инстаграм">
                        <img src="assets/icon/brandico_linkedin.svg" alt="Ин">
                    </div>
                    <div class="footer-line_center"></div>

                </div>
                <ul class="footer_menu">
                    <li>Навигация</li>
                    <li><a href="index.php">Дом</a></li>
                    <li><a href="blog.php">Блог</a></li>
                    <? if ($_SESSION['auth'] === true): ?>
                        <?= '<li><a href="calc.php">Рассчитать</a></li>' ?>
                    <? else: ?>
                        <?= '<li><a href="application/auth.php">Рассчитать</a></li>' ?>
                    <? endif; ?>
                    <li><a href="about.php">Наша команда</a></li>
                </ul>
            </div>
            <div class="footer-down_content">
                <form action="#" id="form" method="POST" style="position: relative;">
                    <input type="email" placeholder="E-mail" name="email_sub">
                    <input type="submit">
                    <?php if ($alert_sub === true) {
                        echo "<span style='color: green; font-size: 12px; position: absolute; left: 5px; top: 50px;'>Вы успешно подписались на рассылку!</span><br>";
                    } ?>
                    <?php if ($alert_empty === true) {
                        echo "<span style='color: red; font-size: 12px; position: absolute; left: 5px; top: 50px;'>Заполните поле</span><br>";
                    } ?>
                    <?php if ($alert_email === true) {
                        echo "<span style='color: red; font-size: 12px; position: absolute; left: 5px; top: 50px;'>На этот email уже подписана рассылка!</span><br>";
                    } ?>
                    <?php if ($alert_db === true) {
                        echo "<span style='color: red; font-size: 12px; position: absolute; left: 5px; top: 50px;'>Ошибка при выполнении запроса</span><br>";
                    } ?>
                </form>
            </div>
        </div>
    </div>
</footer>