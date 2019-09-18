<?php include ROOT.'/views/layouts/header.php';?>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 col-xs-3">
                        <div class="left-sidebar">
                            <h2>Каталог</h2>
                            <div class="panel-group category-products">
                                <?php foreach ($categories as $category):?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title"><a href="/category/<?php echo $category['id'];?>"><?php echo $category['name'];?></a></h4>
                                        </div>
                                    </div>
                                <?php endforeach; ?>     
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-9 padding-right">
                        <div class="features_items"><!--features_items-->
                            <h2 class="title text-center">Последние товары</h2>
                            <?php foreach ($latestProducts as $product): ?>
                                <div class="col-sm-4 col-xs-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="<?php echo $product['image']?>" alt="" />
                                                <h2><?php echo $product['price']?>$</h2>
                                                <p><a href="/product/<?php echo $product['id']?>"><?php echo $product['name']?></a></p>
                                                <a href="/cart/add/<?php echo $product['id']; ?>" class="btn btn-default add-to-cart" data-id="<?php echo $product['id'];?>"><i class="fa fa-shopping-cart" ></i>В корзину</a>
                                            </div>
                                            <?php if ($product['is_new']):?>
                                                <img src="/../template/images/home/new.png" class="new" alt="" />
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div><!--features_items-->

                        <div class="recommended_items"><!--recommended_items-->
                            <h2 class="title text-center">Рекомендованные товары</h2>

                            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <?php foreach ($sliderProducts as $sliderProduct):?>
                                                        <div class="col-sm-4 col-xs-4">
                                                            <div class="product-image-wrapper">
                                                                <div class="single-products">
                                                                    <div class="productinfo text-center">
                                                                        <img src="<?php echo $sliderProduct['image']?>" alt="" />
                                                                        <h2><?php echo $sliderProduct['price']?>$</h2>
                                                                        <p><a href="/product/<?php echo $sliderProduct['id']?>"><?php echo $sliderProduct['name']?></a></p>
                                                                        <?php if ($sliderProduct['status']):?>
                                                                            <a href="/cart/add/<?php echo $sliderProduct['id']; ?>" class="btn btn-default add-to-cart" data-id="<?php echo $sliderProduct['id'];?>"><i class="fa fa-shopping-cart" ></i>В корзину</a>
                                                                        <?php else:?>
                                                                            <a href="#" class="btn btn-default">В корзину</a>
                                                                        <?php endif;?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                <?php endforeach;?>
                                            </div>
                                            <div class="item">
                                            <?php foreach ($sliderProducts as $sliderProduct):?>
                                                        <div class="col-sm-4 col-xs-4">
                                                            <div class="product-image-wrapper">
                                                                <div class="single-products">
                                                                    <div class="productinfo text-center">
                                                                        <img src="<?php echo $sliderProduct['image']?>" alt="" />
                                                                        <h2><?php echo $sliderProduct['price']?>$</h2>
                                                                        <p><a href="/product/<?php echo $sliderProduct['id']?>"><?php echo $sliderProduct['name']?></a></p>
                                                                        <?php if ($sliderProduct['status']):?>
                                                                            <a href="/cart/add/<?php echo $sliderProduct['id']; ?>" class="btn btn-default add-to-cart" data-id="<?php echo $sliderProduct['id'];?>"><i class="fa fa-shopping-cart" ></i>В корзину</a>
                                                                        <?php else:?>
                                                                            <a href="#" class="btn btn-default">В корзину</a>
                                                                        <?php endif;?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                    <?php endforeach;?>
                                                </div>
                                            </div>
                                            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>		
                                </div>
                            </div>
                        </div><!--/recommended_items-->

                    </div>
                </div>
            </div>
        </section>
<?php include ROOT.'/views/layouts/footer.php';?>