<?php
include('db.php');
session_start();
$username = false;
$password = false;
$email = false;
$prevPssword = false;
$alert_succes = false;
$alert_name = false;
$alert_email = false;
$alert_db = false;
$alert_empty = false;
$alert_password = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = !empty($_POST['username']) ? $conn->real_escape_string(trim($_POST['username'])) : null;
    $password = !empty($_POST['password']) ? $conn->real_escape_string(trim($_POST['password'])) : null;
    if ($username && $password) {
        $check_name = $conn->prepare("SELECT * FROM users WHERE name = ?");
        $check_name->bind_param('s', $username);
        $check_name->execute();
        $result = $check_name->get_result();
        if ($result->num_rows != 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $alert_succes = true;
                $_SESSION['auth'] = true;
            } else {
                $alert_password = true;
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
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <? //include('../patch/header.php');
    ?>
    <section id="registration">
        <div class="container">
            <div class="content-form-reg">
                <h1>Авторизация</h1>
                <form action="auth.php" method="POST">
                    <div class="label-content">
                        <label for="username">Логин</label>
                        <input class="input" type="text" name="username">
                        <?php if ($username === null) {
                            echo "<span style='color: red; font-size: 12px; position: absolute; left: 0; top: 50px;'>Заполните поле</span><br>";
                        }
                        ?>
                    </div>
                    <div class="label-content">
                        <label for="password">Пароль</label>
                        <input class="input" type="password" name="password">
                        <?php if ($password === null) {
                            echo "<span style='color: red; font-size: 12px; position: absolute; left: 0; top: 50px;'>Заполните поле</span><br>";
                        }
                        ?>
                    </div>
                    <button>Войти</button>
                </form>
                <span>Нет аккаунта? <a href="reg.php">создать</a></span>
            </div>
        </div>
    </section>
    <? //include('../patch/footer.php');
    ?>
</body>
<? if ($alert_succes === true) {
    echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Добро пожаловать!',
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                    willClose: () => {
                        window.location.href = '../index.php'; 
                    }
                });
            </script>";
}
if ($alert_password === true) {
    echo "<script>
       Swal.fire({
        icon: 'error',
        title: 'Пароли не верный!',
        });
       </script>";
}
if ($alert_name === true) {
    echo "<script>
       Swal.fire({
        icon: 'error',
        title: 'Этот логин уже занят',
        });
       </script>";
}
if ($alert_empty === true) {
    echo "<script>
       Swal.fire({
        icon: 'error',
        title: 'Заполните все поля',
        });
       </script>";
}
?>

</html>