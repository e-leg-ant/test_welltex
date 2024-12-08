<?php

use yii\helpers\Url;

?>

<?php if (!empty($categories)) : ?>

    <?php foreach ($categories as $category) : ?>

        <?php $productCategory = $category->productCategory; ?>

        <?php if (!empty($productCategory)) : ?>

            <section class="category">

                <h3><?= $category->name; ?></h3>

                <div class="container product__container">

                    <div class="product__list">

                        <?php foreach ($productCategory as $link) : ?>

                        <div class="product__item rounded-2">

                            <div class="product__text">

                                <img loading="lazy" class="product__item-icon "src="<?= $link->product->getMainImage(); ?>" alt="" >

                                <span><?= $link->product->name; ?></span>

                            </div>

                            <div class="text-bg-light p-2 rounded">

                                <div class="product__item-price"><?= $link->product->price; ?> руб.</div>

                                <?php if (!Yii::$app->user->isGuest && !empty($link->product->quantity)) : ?>

                                    <noindex>
                                        <a href="<?= Url::to(['/cart/put/', 'id' =>  $link->id_product]); ?>" class="buy-btn btn btn-sm btn-outline-primary" data-id="<?= $link->id_product; ?>"><i class="bi bi-basket me-1"></i>В корзину</a>
                                    </noindex>

                                <?php endif; ?>

                            </div>

                        </div>

                        <?php endforeach; ?>

                    </div>

                </div>

            </section>

        <?php endif; ?>

    <?php endforeach; ?>

<?php endif; ?>