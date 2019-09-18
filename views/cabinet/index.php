<?php include ROOT.'/views/layouts/header.php';?>

<section>
    <div class="container">
        <div class="row">
            <h1>Личный кабинет</h1>
            <h4>Здравствуй, <?php echo $user['name'];?></h4>
            <ul>
                <li><a href="/cabinet/edit/">Редактировать данные</a></li>
            </ul>
        </div>
    </div>
</section>

<?php include ROOT.'/views/layouts/footer.php';?>