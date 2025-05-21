<?session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Связаться</title>
    <link rel="icon" href="assets/logo.svg">
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?include('patch/header.php');?>
    <main>
        <section id="form">
            <div class="container">
                <div class="content_product">
                    <div class="title_product">
                        <div class="h1">
                            Как с нами
                            <span style="color: red">связаться</span>
                        </div>
                        <span>Бывают моменты, когда медлить нельзя — свяжитесь с
                            нами удобным для вас способом.</span>
                    </div>
                    <div class="content-form">
                        <div class="content-form_left">
                            <div class="container-form_derc">
                                <div class="info-element">
                                    <img src="assets/icon/Vector (1).svg"
                                        alt="Иконка" width="41px" height="33px">
                                    <div class="info-desc">
                                        <span>Пообщайтесь с нами в чате</span>
                                        <span>nsgsecurity@gmail.com</span>
                                    </div>
                                </div>
                                <div class="info-element">
                                    <img src="assets/icon/Vector (2).svg"
                                        alt="Иконка" width="41px" height="41px">
                                    <div class="info-desc">
                                        <span>Телефон</span>
                                        <span>+91 9835467289</span>
                                    </div>
                                </div>
                                <div class="info-element">
                                    <img src="assets/icon/Group (3).svg"
                                        alt="Иконка" width="33px" height="41px">
                                    <div class="info-desc">
                                        <span>Офис</span>
                                        <span>W-9, Промышленная зона, около 200<br>
                                            кварталов, Ямунанагар,
                                            Харьяна-135001</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="/" method="POST">
                            <div class="label-cont">
                                <label class="span">Ваше имя</label>
                                <input type="text" name="username">
                            </div>
                            <div class="label-cont">
                                <label class="span">E-mail</label>
                                <input type="email" name="email">
                            </div>
                            <div class="label-cont">
                                <label class="span">Сообшение</label>
                                <textarea name="message" cols=""
                                    rows=""></textarea>
                            </div>
                            <button type="submit">Отправить</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?include('patch/footer.php');?>
    <script src="js/script.js"></script>

</body>
</html>