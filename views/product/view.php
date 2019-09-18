<?php include ROOT.'/views/layouts/header.php';?>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 col-xs-3">
                        <div class="left-sidebar">
                            <h2>Каталог</h2>
                            <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            <?php foreach ($categories as $category):?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a href="/category/<?php echo $category['id'];?>" class="<?php if ($categoryId == $category['id']) echo 'active';?>"><?php echo $category['name'];?></a>
                                            </h4>
                                        </div>
                                    </div>
                                <?php endforeach; ?> 
                            </div><!--/category-products-->
   
                        </div>
                    </div>

                    <div class="col-sm-9 padding-right">
                        <div class="product-details"><!--product-details-->
                            <div class="row">
                                <div class="col-sm-5 col-xs-5">
                                    <div class="view-product">
                                        <img src="<?php echo $product['image'];?>" alt="" />
                                    </div>
                                </div>
                                <div class="col-sm-7 col-xs-7">
                                    <div class="product-information"><!--/product-information-->
                                        <?php if ($product['is_new']):?>
                                            <img src="/../template/images/product-details/new.jpg" class="newarrival" alt="" />
                                        <?php endif;?>
                                        <h2><?php echo $product['name'];?></h2>
                                        <p>Код товара: <?php echo $product['code'];?></p>
                                        <span>
                                            <span>Цена: <?php echo $product['price'];?>$</span>
                                        </span>
                                        <?php if ($product['availability']):?>
                                        <p><b>Наличие:</b> На складе</p>
                                            <p><b>Производитель:</b> <?php echo $product['brand'];?></p>
                                            <a href="/cart/add/<?php echo $product['id']; ?>" class="btn btn-default add-to-cart" data-id="<?php echo $product['id'];?>"><i class="fa fa-shopping-cart"></i>В корзину</a>
                                        <?php else: ?>
                                            <p><b>Наличие:</b> Отсутствует на складе</p>
                                            <p><b>Производитель:</b> <?php echo $product['brand'];?></p>
                                        <?php endif;?>
                                    </div><!--/product-information-->
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="col-sm-12 col-xs-12">
                                    <h5>Описание товара</h5>
                                    <p><?php echo $product['description'];?></p>
                                </div>
                            </div>
                        </div><!--/product-details-->

                    </div>
                </div>
            </div>
        </section>

<?php include ROOT.'/views/layouts/footer.php';?>

