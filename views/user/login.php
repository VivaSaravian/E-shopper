<?php include ROOT.'/views/layouts/header.php';?>


<section>
    <div class="container">
        <div class="row wrapper">
            <div class="col-sm-4 col-sm-offset-4 padding-right content">
                <?php if ($result):?>
                    <p>Вы зарегестрированы!</p>
                <?php else:?>
                <?php if (isset($errors) && is_array($errors)): ?>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li>- <?php echo $error?></li>
                        <?php endforeach;?>
                    </ul>
                <?php endif;?>
                <div class="signup-form">
                    <h2>Вход на сайт</h2>
                    <form action="#" method="post">
                        <input type="email" name="email" placeholder="Почта" value="<?php echo $email;?>"/>
                        <input type="password" name="password" placeholder="Пароль" value="<?php echo $password;?>"/>
                        <input type="submit" name="submit" class="btn btn-default" value="Подтвердить"/>
                        <a href="/user/register/" class="btn btn-default col-md-6">Зарегистрироваться</a>
                    </form>
                </div>
            <?php endif;?>
            </div>
        </div>
    </div>
</section>



<?php include ROOT.'/views/layouts/footer.php';?>