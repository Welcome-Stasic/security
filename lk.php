<?php
require('application/db.php');
$servis = $conn->prepare("SELECT `img`, `name`, `description` FROM `services`");
$servis->execute();
$result = $servis->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Охранное агенство</title>
    <link rel="icon" href="assets/logo.svg">
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <? include('patch/header.php'); ?>
    <main>
        <section id="servis">
            <div class="container">
                <?while($services = $result->fetch_assoc()):?>
                    <?if ($services):?>
                    <div class="service_card-elem">
                        <div class="content-card">
                            <img src="<?=$services['img']?>" alt="Услуга"/>
                            <div class="card-description">
                                <span><?=$services['name']?></span>
                                <span style="font-size: 18px"><?=$services['description']?></span>
                            </div>
                        </div>
                        <button>Подробнее</button>
                    </div>
                    <?else:?>
                        <div class="error-content">
                            <span>В данный момент услуг нет...</span>
                        </div>
                    <?endif;?>
                <?endwhile;?>
        </section>
    </main>
    <?include('patch/footer.php');?>
    <script src="js/script.js"></script>
</body>

</html>