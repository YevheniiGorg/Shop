<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

?>


<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">

                    <div class="brands_products"><!--category-productsr-->
                        <h2>Категории</h2>
                        <div class="brands-name">
                            <ul class="catalog category-products"><!--Categoryyy-->
                                <?= \app\components\MenuWidget::widget(['tpl'=>'menu']) ?>
                            </ul>
                        </div>
                    </div><!--/category-productsr-->


                    <div class="price-range"><!--price-range-->
                        <h2>Ценовой диапазон</h2>
                        <div class="well">
                            <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="2000" data-slider-step="5" data-slider-value="[0,2000]" id="sl2" ><br />
                            <b>&#8372; 0</b> <b class="pull-right">&#8372; 2000</b>
                        </div>
                    </div><!--/price-range-->

                    <div class="shipping text-center"><!--shipping-->
                        <img src="/images/home/shipping.jpg" alt="" />
                    </div><!--/shipping-->

                </div>
            </div>


            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">
                        <?= $category->name ?></h2>
                   <?php if (!empty($products)): ?>
                       <?php foreach ($products as $product): ?>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <a href="<?= \yii\helpers\Url::to(['product/view','id'=>$product->id]) ?>">
                                    <?=\yii\helpers\Html::img($product->getImage()->getUrl(),['alt'=>$product['name']]);?>
                                    </a>

                                    <h2>&#8372;<?= $product->price ?></h2>
                                    <p><a href="<?= \yii\helpers\Url::to(['product/view','id'=>$product->id])?>"><?= $product->name ?></a></p>
                                    <a href="#"data-id="<?= $product->id ?>"class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Добавить а корзину</a>
                                </div>

                                <?php if ($product->new): ?>
                                    <?= Html::img("@web/images/home/new.png",['alt'=>'Новинка','class'=>'new']) ?>
                                <?php endif;?>
                                <?php if ($product->sale): ?>
                                    <?= Html::img("@web/images/home/sale.png",['alt'=>'Распродажа','class'=>'new']) ?>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                           <?php endforeach; ?>
                       <div class="clearfix"></div>
                       <?php
                            echo yii\widgets\LinkPager::widget([
                           'pagination' => $pages,
                       ]);
                       ?>
                       <?php  else:?>
                       <h2>Здесь товаров пока нет...</h2>
                    <?php endif; ?>


                    <form action="/category/view" method="get">
                        Выводить по:
                        <select id="limit" size="1" name="limit"  style="width: 50px; ">
                            <?php for ($i=6;$i<=50;$i+=6): ?>

                            <option name="val" <?php if ($i==$limit) echo 'selected="selected"'?> value="<?= $i ?>"><?= $i ?></option>

                            <?php endfor; ?>
                        </select>
                        <input type="text"name="id" style="visibility: hidden; margin-left: -150px;" value=" <?= $category->id ?>">
                        <input id="submit" style="visibility: hidden;" type="submit"  >
                    </form>
                    Показано товаров: <?= $limit ?> из <?= $pages->totalCount ?>

                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>