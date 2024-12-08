<?php

$title = 'Заказ создан';
$this->title = $title;
$this->params['breadcrumbs'] = [$title];

?>

<section id="order"  class="end d-flex flex-column">

    <div class="container">

        <div class="w-100 text-center">
            <h2 class=""><?= $title; ?></h2>
        </div>

        <div class="border w-100 m-2 p-5 bg-primary-subtle rounded-3 fs-3 text-center">

            <?php if (Yii::$app->cart->getIsEmpty()) : ?>

                <div class="w-100 text-center">
                    <div class="bi bi-basket fs-1"></div>
                    <div class="fs-3">Ваша корзина пуста</div>
                </div>

            <?php else : ?>

                <div class="">Номер заказа № <span class="text-success"><?= $order; ?>.</span></div>

            <?php endif; ?>

        </div>

    </div>

</section>

<?php

Yii::$app->cart->removeAll();

?>