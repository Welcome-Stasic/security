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
$_SESSION['auth'] = false; 
if ($_SERVER['REQUEST_METHOD'] === 'POST')  {
    $username = !empty($_POST['username']) ? $conn->real_escape_string(trim($_POST['username'])) : null;
    $password = !empty($_POST['password']) ? $conn->real_escape_string(trim($_POST['password'])) : null;
    $email = !empty($_POST['email']) ? $conn->real_escape_string(trim($_POST['email'])) : null;
    $prevPssword = !empty($_POST['prevPassword']) ? $conn->real_escape_string(trim($_POST['prevPassword'])) : null;
    $create_at = date("Y-m-d H:i:s");
    if ($username && $password && $email && $prevPssword) {
        $check_name = "SELECT * FROM users WHERE name = '$username'";
        $res_check_name = $conn->query($check_name);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        if ($res_check_name->num_rows == 0) {
            $check_email = "SELECT * FROM users WHERE email = '$email'";
            $res_check_email = $conn->query($check_email);
            if ($res_check_email->num_rows == 0) {
                $stmt = $conn->prepare("INSERT INTO users (name, password, email, create_at) VALUES (?,?,?,?)");
                $stmt->bind_param('ssss', $username, $passwordHash, $email, $create_at);
                if ($stmt->execute()) {
                    if ($password === $prevPssword) {
                        $alert_succes = true;
                        $_SESSION['auth'] = true;
                    } else {
                        $alert_password = true;
                    }
                } else {
                    $alert_db = true; 
                }
            } else {
                $alert_email = true;
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
        <?//include('../patch/header.php');?>
        <section id="registration">
            <div class="container">
        <h1>Регистрация</h1>
        <form action="#" method="POST">
            <label for="username">Логин</label><br>
            <input type="text" name="username"><br>
            <?php if ($username === null) {
                echo "<span style='color: red; font-size: 12px;'>Заполните поле</span><br>";
            }
            ?>

            <label for="email">E-mail</label><br>
            <input type="email" name="email"><br>
            <?php if ($email === null) {
                echo "<span style='color: red; font-size: 12px;'>Заполните поле</span><br>";
            }
            ?>

            <label for="password">Пароль</label><br>
            <input type="password" name="password"><br>
            <?php if ($password === null) {
                echo "<span style='color: red; font-size: 12px;'>Заполните поле</span><br>";
            }
            ?>

            <label for="prevPassword">Подтверждение пароля</label><br>
            <input type="password" name="prevPassword"><br>
            <?php if ($prevPssword === null) {
                echo "<span style='color: red; font-size: 12px;'>Заполните поле</span><br>";
            }
            ?>
            <input type="submit">
            <span>Есть аккаунт? <a href="auth.php">войти</a></span>
        </form>
        </div>
        </section>
        <?//include('../patch/footer.php');?>
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
