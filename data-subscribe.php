<?
session_start();
require('application/db.php');
if ($_SESSION['admin'] === '0' || !isset($_SESSION['auth'])) {
    header('Location: lk.php');
    exit;
}
$users_sub = $conn->prepare("SELECT `id`, `email` FROM `subscribe_user`");
$users_sub->execute();
$result = $users_sub->get_result();
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
            <div class="container" style="display: flex; flex-direction: column;  width: 100%; align-items: center;">
                <h1 style="margin-bottom: 60px;">Подписки на рассылку пользователями</h1>
                <table>
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <? while ($user = $result->fetch_assoc()): ?>
                            <? if ($user): ?>
                                <tr>
                                    <th scope="row"><?= $user['id'] ?></th>
                                    <td><?= $user['email'] ?></td>
                                </tr>
                            <? else: ?>
                                <tr>
                                    <th scope="row">нет</th>
                                    <td>нет</td>
                                </tr>
                            <? endif; ?>
                        <? endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <? include('patch/footer.php'); ?>
    <script src="js/script.js"></script>
</body>

</html>