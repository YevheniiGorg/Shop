
<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\ltAppAsset;
use app\models\User;

ltAppAsset::register($this);
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
<?php $this->beginBody() ?>
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +380660000000</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="<?= \yii\helpers\Url::home() ?>"><?= Html::img
                            ('@web/images/home/logo.png',['alt'=>'E-SHOPPER']) ?></a>
                    </div>

                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">



<!--                            <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>-->
<!--                            <li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>-->
                            <li><a href="#" onclick="getCart()"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                            <?php if (!Yii::$app->user->isGuest): ?>
                                <li><a href="<?= \yii\helpers\Url::to(['/site/logout']) ?>"><i class="fa fa-user"></i>
                                        <?= Yii::$app->user->identity['username'] ?>(Выход)</a></li>
                                <li><a href="<?= \yii\helpers\Url::to(['/admin']) ?>"><i class="fa fa-user"></i>
                                        admin menu</a></li>
                                <? else: ?>
                                <li><a href="<?= \yii\helpers\Url::to(['/admin']) ?>"><i class="fa fa-lock"></i> Login</a></li>
                            <?php endif; ?>

                        </ul>
                    </div>
                </div>

            </div>

            <div class="search">
                <div class="search_box pull-right">
                    <form method="get" action="<?= \yii\helpers\Url::to
                    (['category/search'])?>">
                        <input type="text" placeholder="Search"name="q"/>
                    </form>
                </div>
            </div>

        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="navbar-header ">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="index.html" class="active">Home</a></li>
                            <li><a href="#">Новинки</a></li>
                            <li><a href="#">Распродажа</a></li>
                            <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="shop.html">Products</a></li>
                                </ul>
                            </li>

                            <li><a href="contact-us.html">Контакты</a></li>
                        </ul>
                    </div>
                </div>
<!--                <div class="col-sm-3">-->
<!--                    <div class="search_box pull-right">-->
<!--                        <form method="get" action="--><?//= \yii\helpers\Url::to
//                        (['category/search'])?><!--">-->
<!--                        <input type="text" placeholder="Search"name="q"/>-->
<!--                        </form>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
        </div>
    </div><!--/header-bottom-->




</header><!--/header-->

<?= $content; ?>

<footer id="footer"><!--Footer-->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="companyinfo">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <a href="<?= \yii\helpers\Url::home() ?>"><?= Html::img
                                    ('@web/images/home/logo.png',['alt'=>'E-SHOPPER']) ?></a></div>
                            <div class="col-lg-6 col-md-6"><h2 ><span>BABY</span><span class="footerlogo">-Shop</span></h2></div>

                        </div>


                        <p>Интернет магазин детской одежды и товаров для детей на все вкусы.
                            BabyShop предлагает одежду, обувь, коляски, автокресла, игрушки и другие товары для детей
                            от 0-10 лет. Он был основан в 2017 году, чтобы стать лучшим детским интернет-магазином.
                        </p>
                        <p>Наша цель – предложить вам качественный сервис и удовлетворить вашу потребность в качественной,
                            модной одежде, обуви и детских товарах. Высокие стандарты качества, безопасность, функциональность,
                            чувство юмора и стиля – наши основные ценности.</p>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="address">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d662.9791054050174!2d33.49521094970202!3d48.342911776336635!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2sua!4v1498739811833" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2><a href="#">О магазине</a></h2>
                    </div>
                    <div class="single-widget">
                        <h2><a href="#">Онлайн помощь</a></h2>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2><a href="#">Способы оплаты</a></h2>
                    </div>
                    <div class="single-widget">
                        <h2><a href="#">Наши контакты</a></h2>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2><a href="#">Условия доставки</a></h2>
                    </div>
                    <div class="single-widget">
                        <h2><a href="#">Время работы</a></h2>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2><a href="#">Вопросы и ответы</a></h2>
                    </div>
                </div>

                <div class="col-sm-3 col-sm-offset-1">
                    <div class="single-widget">
                        <h2>Оставь свой email</h2>
                        <form action="#" class="searchform">
                            <input type="text" placeholder="Your email address" />
                            <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                            <p>Получите информацию о  последних <br />скидках, акциях и поступлениях...</p>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2017 BABY-SHOP Inc. All rights reserved.</p>
                <p class="pull-right">Developer of the site: <span> gorg120208@gmail.com</a></span></p>
            </div>
        </div>
    </div>

</footer><!--/Footer-->

<?php
\yii\bootstrap\Modal::begin([
    'header'=>'<h2>Корзина</h2>',
    'id'=>'cart',
    'size'=> 'modal-lg',
    'footer'=>'
    <button type="button" class="btn btn-default" data-dismiss="modal"> Продолжить покупки</button>
    <a href="'. \yii\helpers\Url::to(['cart/view']).'" class="btn btn-success"> Оформить заказ </a>
    <button type="button" class="btn btn-danger" onclick="clearCart()"> Очистить корзину </button>'
    
]);
\yii\bootstrap\Modal::end();
?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>