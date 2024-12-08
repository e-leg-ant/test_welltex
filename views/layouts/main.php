<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\web\View;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);

    $nav_items = [
            ['label' => 'Регистрация', 'url' => ['/account/registration']],
        ];

    if (!Yii::$app->user->isGuest) {
        $nav_items[] = ['label' => 'Мои заказы', 'url' => ['/account/order']];
        $nav_items[] = ['label' => 'Настройки', 'url' => ['/account/settings']];
        $nav_items[] = '<li class="nav-item">'
            . Html::beginForm(['/site/logout'])
            . Html::submitButton(
                'Выйти (' . Yii::$app->user->identity->username . ')',
                ['class' => 'nav-link btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    } else {
        $nav_items[] = ['label' => 'Вход', 'url' => ['/site/login']];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $nav_items
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; My Company <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>

<?php if ('site' == Yii::$app->controller->id) : ?>
<div class="basket rounded border p-2"></div>
<?php endif; ?>

<?php

$initBasketTotal = <<< JS
    $.ajax({
        url: '/cart/totals',
        success: function(data) {
                $('.basket').html(data);
        }
    });
JS;

$this->registerJs($initBasketTotal, View::POS_READY, 'initBasketTotal');

$initBuyBtn = <<< JS

    $('body').on('click', '.buy-btn', function () {

        let owner = $(this);
  
        $.ajax({
            url: this.href,
            data: {key: owner.data('key')},
            success: function(data) {
                
                owner.clone().css({'position' : 'absolute', 'z-index' : '1000', 'width' : '100px', top: owner.offset().top, left:owner.offset().left})
                     .appendTo("body")
                     .animate({opacity: 0.3,
                            left: $('.basket').offset()['left'],
                            top: $('.basket').offset()['top'],
                            width: 60,
                            height: 20}, 1000, function() {
                                $(this).remove();
                            });
                
                $.ajax({ url: '/cart/totals', success: function(data) { $('.basket').html(data); } });

            },
            error: function(data) {
                alert('Не удалось добавить товар в корзину')
            }
        });

        return false;
    });
JS;

$this->registerJs($initBuyBtn, View::POS_READY, 'initBuyBtn');

?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>