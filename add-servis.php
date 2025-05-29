<?php
session_start();
require('application/db.php');
if ($_SESSION['admin'] === '0' || !isset($_SESSION['auth'])) {
    header('Location: lk.php');
    exit;
}
$name = false;
$description = false;
$imageData = false;
$file = false;
$alert_success = false;
$alert_db = false;
$alert_empty = false;
$price = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? $conn->real_escape_string(trim($_POST['name'])) : null;
    $description = isset($_POST['descript']) ? $conn->real_escape_string(trim($_POST['descript'])) : null;
    $price = isset($_POST['price']) ? $conn->real_escape_string(trim($_POST['price'])) : null;
    if ($name && $description) {
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $imageData = file_get_contents($_FILES['file']['tmp_name']);
            $stmt = $conn->prepare("INSERT INTO services (img, name, description, price) VALUES (?, ?, ?, ?)");
            $empty = '';
            $stmt->bind_param("bssi", $empty, $name, $description, $price);
            $stmt->send_long_data(0, $imageData);
            if ($stmt->execute()) {
                $_SESSION['auth'] = true;
                $alert_s = true;
            } else {
                $a_db = true;
            }
            $stmt->close();
        } else {
            $a_empty = true;
        }
    } else {
        $a_empty = true;
    }
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
        <section>
            <div class="container" style="display: flex; flex-direction: column; width: 100%; align-items: center;">
                <h1 style="margin-bottom: 60px;">Добавить услугу</h1>
                <form action="#" method="POST" enctype="multipart/form-data">
                    <div class="label-content">
                        <label for="file">Фотография</label>
                        <input class="input add" type="file" name="file" required />
                        <?php if ($file === null) {
                            echo "<span style='color: red; font-size: 12px; position: absolute; left: 0; top: 65px;'>Выберите файл</span><br>";
                        }
                        ?>
                    </div>
                    <div class="label-content">
                        <label for="name">Название</label>
                        <input class="input" type="text" name="name">
                        <?php if ($name === null) {
                            echo "<span style='color: red; font-size: 12px; position: absolute; left: 0; top: 50px;'>Введите название</span><br>";
                        }
                        ?>
                    </div>
                    <div class="label-content">
                        <label for="descript">Описание</label>
                        <textarea name="descript"></textarea>
                        <?php if ($description === null) {
                            echo "<span style='color: red; font-size: 12px; position: absolute; left: 0; top: 253px;'>Заполните поле</span><br>";
                        }
                        ?>
                    </div>
                    <div class="label-content">
                        <label for="price">Цена</label>
                        <input class="input" type="number" name="price">
                        <?php if ($price === null) {
                            echo "<span style='color: red; font-size: 12px; position: absolute; left: 0; top: 253px;'>Заполните поле</span><br>";
                        }
                        ?>
                    </div>
                    <div class="label-content">
                    <button>Добавить</button>
                    <?php if ($alert_s === true) {
                            echo "<span style='color: green; font-size: 12px; position: absolute; left: 0; top: 53px;'>Успешно загрузили!</span><br>";
                        }
                    ?>
                    <?php if ($a_db === true) {
                            echo "<span style='color: red; font-size: 12px; position: absolute; left: 0; top: 53px;'>Ошибка при выполнении запроса!</span><br>";
                        }
                    ?>
                    <?php if ($a_empty === true) {
                            echo "<span style='color: red; font-size: 12px; position: absolute; left: 0; top: 53px;'>Заполните поля!</span><br>";
                        }
                    ?>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <? include('patch/footer.php'); ?>
    <script src="js/script.js"></script>
</body>

</html>