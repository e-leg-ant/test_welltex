<?php

use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\jui\Spinner;
use app\models\Order;

$title = 'Корзина';

$this->title = $title;
$this->params['breadcrumbs'] = [$title];

?>

<section id="cart" class="cart d-flex flex-column">

    <div class="w-100 text-center">
        <h2 class="">Корзина</h2>
    </div>

    <?php if (Yii::$app->cart->getIsEmpty()) : ?>

        <div class="w-100 text-center">
            <div class="bi bi-basket fs-1"></div>
            <div class="fs-3">Ваша корзина пуста</div>
        </div>

    <?php else : ?>

    <noindex>

    <?= Html::beginForm(['cart/index'], 'post', ['class' => 'cart-form', 'style' => 'width: 100%;']) ?>

    <div class="table-responsive">

        <table class="table table-striped table-hover">

            <thead class="table-light">

                <tr class="text-center"><th>Артикул</th><th class="mobile_hidden">Наименование</th><th style="min-width:100px;">Кол-во</th><th>Цена</th><th>Стоимость</th><th></th></tr>

            </thead>

            <tbody class="table-group-divider">

            <?php foreach (Yii::$app->cart->getPositions() as /** @var CatalogItem $position */ $position) : ?>

                <tr class="cart__item">

                    <td class="">
                        <?= $position->code; ?>
                    </td>

                    <td class="mobile_hidden">
                        <?= $position->name; ?>
                    </td>

                    <?php
                        $price = $position->getPrice();
                        $sum_price = $position->getCost();
                        $min_count = 1;
                    ?>

                    <td class="">

                        <?= Spinner::widget([
                                'name'  => 'quantity[' . $position->getId() . ']',
                                'value' => $position->getQuantity(),
                                'clientOptions' => [
                                    'min' => $min_count,
                                    'step' => $min_count,
                                    'disabled' => false,
                                    'classes' => [
                                        'ui-spinner-down' => 'ui-icon ui-icon-triangle-1-s',
                                        'ui-spinner-up' => 'ui-icon ui-icon-triangle-1-n'
                                    ]
                                ],
                                'options' => [
                                    'id' => $position->getId(),
                                    'class' => 'cart__item-number m-1 p-0',
                                    'style' => 'height:20px;',
                                    'size' => 1,
                                    'data-name' => $position->name,
                                    'data-price' => $position->price,
                                    'data-item-id' => $position->id,
                                ]
                            ]);
                        ?>

                    </td>

                    <td class="mobile_hidden"><?= \Yii::$app->formatter->asDecimal($price, 0); ?> ₽</td>

                    <td class=""><?= \Yii::$app->formatter->asDecimal($sum_price, 0); ?> ₽</td>

                    <td>
                        <a href="<?= Url::to(['/cart/remove/', 'id' => $position->getId()]); ?>" class="btn btn-sm btn-outline-danger bi bi-trash basket__order-remove" data-item-id="<?= $position->id; ?>" data-name="<?= Html::encode($position->name); ?>"><span class="mobile_hidden"> Удалить</span></a>
                    </td>
                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

    <?= Html::endForm() ?>

    </noindex>

    <noindex>

    <div class="d-flex flex-wrap justify-content-between">

        <div class="">

            <a href="<?= Url::to(['/cart/empty']); ?>" class="btn btn-outline-danger clear-basket-btn m-2 p-2 lh-lg bi bi-trash" >Очистить корзину</a>

        </div>

        <div class="d-inline-flex justify-content-end cart-total-wrap">

            <div class="m-2 fs-2 ln-2">
                Итого <span><?= \Yii::$app->formatter->asDecimal(Yii::$app->cart->getCost(), 0); ?></span> ₽
            </div>

            <a href="<?= Url::to(['/cart/order/']); ?>" class="btn btn-primary m-2 p-2 lh-lg">Оформить Заказ</a>

        </div>

    </div>

    </noindex>

    <?php endif; ?>

</section>

<?php

$initBasketPage = <<< JS

    $(document).on('click', '.clear-basket-btn', function(){
        
        if (confirm('Очистить корзину?')) {
            
        } else {
            return false;
        }
    });

    $(document).bind('keypress', function(event){
        if (13 == event.keyCode) {
            window.location.replace('/cart/order');
        }
    });

    $('.cart__item-number').on('spinstop', function( event, ui ) {
        $('.cart-form').submit();
    });
    
    $('.basket__remove-item').click(function () {
        
        var owner = $(this);

        if (confirm('Удалить ' + owner.attr('data-name') + ' из корзины?')) {
        } else {
            return false;
        }
        return false;
    });
JS;

$this->registerJs($initBasketPage, View::POS_READY, 'initBasketPage');
?>