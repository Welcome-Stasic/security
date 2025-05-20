<?
require('application/db.php');
if ($_SESSION['admin'] === '0') {
    header('Location: lk.php');
}
$file = false;
$name = false;
$descript = false;
$alert_succes = false;
$alert_name = false;
$alert_email = false;
$alert_db = false;
$price = 0;
$alert_empty = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = isset($_POST['file']) ? $conn->real_escape_string(trim($_POST['file'])) : null;
    $name = isset($_POST['name']) ? $conn->real_escape_string(trim($_POST['name'])) : null;
    $descript = isset($_POST['descript']) ? $conn->real_escape_string(trim($_POST['descript'])) : null;
    if ($file && $name && $descript) {
        $check_name = $conn->prepare("SELECT * FROM services WHERE name = ?");
        $check_name->bind_param('s', $name);
        $check_name->execute();
        $result = $check_name->get_result();
        if ($result->num_rows != 0) {
            $check_name = $conn->prepare("INSERT INTO services (img, name, description, price) VALUE (?,?,?,?)");
            $check_name->bind_param('sssi', $file, $name, $descript, $price);
            if ($check_name->execute()) {
                $alert_succes = true;
            } else {
                $alert_db = true;
            }
        } else {
            $alert_name = true;
        }
    } else {
        $alert_empty = true;
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
            <section>
                <div class="container" style="display: flex; flex-direction: column; width: 100%; align-items: center;" >
                    <h1 style="margin-bottom: 60px;">Добавить услугу</h1>
                    <form action="#" method="POST">
                    <div class="label-content">
                        <label for="file">Фотография</label>
                        <input class="input add" type="file" name="file">
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
                        <?php if ($descript === null) {
                            echo "<span style='color: red; font-size: 12px; position: absolute; left: 0; top: 253px;'>Заполните поле</span><br>";
                        }
                        ?>
                    </div>
                    <button>Добавить</button>
                </form>
                </div>
            </section>
        </main>
        <?include('patch/footer.php');?>   
    </body>
</html>