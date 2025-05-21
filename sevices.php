<?php
session_start();
require('application/db.php');
$servis = $conn->prepare("SELECT img, name, description FROM services");
$servis->execute();
$result = $servis->get_result();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
<link rel="icon" href="assets/logo.svg">
    <meta charset="UTF-8">
    <title>Услуги</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <? include('patch/header.php'); ?>
    <main>
        <section id="servis">
            <div class="container">
                <? while ($services = $result->fetch_assoc()): ?>
                    <? if ($services): ?>
                        <div class="service_card-elem">
                            <div class="content-card">
                                <?php
                                $imgData = base64_encode($services['img']);
                                $src = 'data:image/jpeg;base64,' . $imgData;
                                ?>
                                <img src="<?= $src ?>" alt="Услуга" />
                                <div class="card-description">
                                    <span><?= htmlspecialchars($services['name']) ?></span>
                                    <span style="font-size: 18px"><?= htmlspecialchars($services['description']) ?></span>
                                </div>
                            </div>
                            <button>Подробнее</button>
                        </div>
                    <? else: ?>
                        <h1>К сожаление услуг в данный момент нет</h1>
                    <? endif; ?>
                <? endwhile; ?>
            </div>
        </section>
    </main>
    <? include('patch/footer.php'); ?>
    <script src="js/script.js"></script>
</body>

</html>