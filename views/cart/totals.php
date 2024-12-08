<div class="">

    <?php $is_empty =  Yii::$app->cart->getIsEmpty(); ?>

    <h5 class="d-flex justify-content-between">
        <span>Корзина</span>
        <?php if (!$is_empty) : ?>
            <a href="<?= \yii\helpers\Url::to(['/cart/index/']); ?>" class="btn btn-sm btn-primary">В Корзину</a>
        <?php endif; ?>
    </h5>

    <div class="overflow-auto" style="max-height: 400px;">

        <div>

            <?php if (!$is_empty) : ?>

                <?php foreach (Yii::$app->cart->getPositions() as /** @var CatalogItem $position */ $position) : ?>

                    <div class="border p-2">
                        <div class="fw-bold"><?= $position->name; ?></div>
                        <div class="d-flex justify-content-between">
                            <span>Цена: <?= $position->price; ?></span>
                            <span>Кол.: <?= $position->quantity; ?></span>
                            <span>Сумма: <?= $position->getCost(); ?></span>
                        </div>
                    </div>

                <?php endforeach; ?>

            <?php else : ?>

                <div class="w-100 text-center">
                    <div class="bi bi-basket fs-1"></div>
                    <div class="fs-5">Пусто</div>
                </div>

            <?php endif; ?>

        </div>

    </div>

</div>
