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
    $email = !empty($_POST['email']) ? $conn->real_escape_string(trim($_POST['email'])) : null;
    $prevPssword = !empty($_POST['prevPassword']) ? $conn->real_escape_string(trim($_POST['prevPassword'])) : null;
    $create_at = date("Y-m-d H:i:s");
    if ($username && $password && $email && $prevPssword) {
        if ($password !== $prevPssword) {
            $alert_password = true;
        } else {
            $check_name = $conn->prepare("SELECT * FROM users WHERE name = ?");
            $check_name->bind_param('s', $username);
            $check_name->execute();
            $res_check_name = $check_name->get_result();
            if ($res_check_name->num_rows == 0) {
                $check_email = $conn->prepare("SELECT * FROM users WHERE email = ?");
                $check_email->bind_param('s', $email);
                $check_email->execute();
                $res_check_email = $check_email->get_result();
                if ($res_check_email->num_rows == 0) {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO users (name, password, email, create_at) VALUES (?,?,?,?)");
                    $stmt->bind_param('ssss', $username, $passwordHash, $email, $create_at);
                    if ($stmt->execute()) {
                        $alert_succes = true;
                        $_SESSION['auth'] = true;
                    } else {
                        $alert_db = true;
                        error_log("Ошибка MySQL: " . $stmt->error);
                    }
                } else {
                    $alert_email = true;
                }
            } else {
                $alert_name = true;
            }
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
                <h1>Регистрация</h1>
                <form action="reg.php" method="POST">
                    <div class="label-content">
                        <label>Логин</label>
                        <input class="input" type="text" name="username">
                        <?php if ($username === null) {
                            echo "<span style='color: red; font-size: 12px; position: absolute; left: 0; top: 50px;'>Заполните поле</span><br>";
                        }
                        ?>
                    </div>
                    <div class="label-content">
                        <label for="email">E-mail</label>
                        <input class="input" type="email" name="email">
                        <?php if ($email === null) {
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
                    <div class="label-content">
                        <label for="prevPassword">Подтверждение пароля</label>
                        <input class="input mb-5" type="password" name="prevPassword">
                        <?php if ($prevPssword === null) {
                            echo "<span style='color: red; font-size: 12px; position: absolute; left: 0; top: 50px;'>Заполните поле</span><br>";
                        }
                        ?>
                    </div>
                    <button>Зарегистрироваться</button>
                </form>
                <span>Есть аккаунт? <a href="auth.php">войти</a></span>
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
        title: 'Пароли не совпадают!',
        });
       </script>";
}
if ($alert_db === true) {
    echo "<script>
       Swal.fire({
        icon: 'error',
        title: 'Ошибка при выполнении запроса',
        });
       </script>";
}
if ($alert_email === true) {
    echo "<script>
       Swal.fire({
        icon: 'error',
        title: 'Этот E-mail уже занят',
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