<?php
session_start();
require('application/db.php');

if (!isset($_SESSION['auth'])) {
    header('Location: index.php');
}

$users_sub = $conn->prepare("SELECT `name` FROM `services`");
$users_sub->execute();
$result = $users_sub->get_result();

$name = $_GET['servis'];
$period = $_GET['period'];
$child = $_GET['child'];
$summ = 0;

if ($name && $period && $child) {
    $price_stmt = $conn->prepare("SELECT `price` FROM `services` WHERE `name` = ?");
    $price_stmt->bind_param("s", $name);
    $price_stmt->execute();
    $res = $price_stmt->get_result();
    $price_data = $res->fetch_assoc();

    if ($price_data) {
        $base_price = (float)$price_data['price'];

        switch ($period) {
            case 'hours':
                $summ = $base_price;
                break;
            case 'day':
                $summ = $base_price * 2;
                break;
            case 'days':
                $summ = $base_price * 1.5;
                break;
        }

        switch ($child) {
            case 'one':
                $summ += 0;
                break;
            case 'two':
                $summ += 200;
                break;
            case 'three':
                $summ += 400;
                break;
            case 'four':
                $summ += 600;
                break;
            case 'five':
                $summ += 800;
                break;
            case 'six':
                $summ += 1000;
                break;
            case 'seven':
                $summ += 1200;
                break;
            case 'eight':
                $summ += 1400;
                break;
            case 'nine':
                $summ += 1600;
                break;
            case 'ten':
                $summ += 1800;
                break;
        }
    }
}
?>

<html>
    <head>
    <link rel="icon" href="assets/logo.svg">
      <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?include('patch/header.php');?>
        <main>
            <section id="calculate">
                <div class="container">
                    <h1 style="margin-bottom: 20px;">Расчитать стоимость</h1>
                <form action="#" method="GET">
                    <div class="label-content">
                        <label>Услуга</label>
                        <select class="input" name="servis">
                            <? while ($user = $result->fetch_assoc()): ?>
                                <option value="<?=$user['name']?>"><?=$user['name']?></option>
                        <? endwhile; ?>
                        </select>
                    </div>
                    <div class="label-content">
                        <label for="email">Период</label>
                        <select class="input"  name="period">   
                            <option value="hours">Почасовая</option>
                            <option value="day">Один день</option>
                            <option value="days">Сутки</option>
                        </select>
                    </div>
                    <div class="label-content">
                        <label for="password">Количество охранников</label>
                        <select class="input"  name="child">   
                            <option value="one">1</option>
                            <option value="two">2</option>
                            <option value="three">3</option>
                            <option value="four">4</option>
                            <option value="five">5</option>
                            <option value="six">6</option>
                            <option value="seven">7</option>
                            <option value="eight">8</option>
                            <option value="nine">9</option>
                            <option value="ten">>10</option>
                        </select>
                    </div>
                    <div class="label-content">
                        <label for="password">Итоговая сумма: <?= htmlspecialchars($summ) . ' руб.'?></label>
                    </div>
                    <button style="width: fit-content;">Вычеслить</button>
                </form>
                </div>
            </section>
        </main>
        <?include('patch/footer.php');?>
        <script src="js/script.js"></script>
    </body>
</html>