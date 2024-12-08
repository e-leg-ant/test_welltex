<?php

/** @var yii\web\View $this */

$this->title = 'Меню';

?>
<div class="site-index">

    <div class="body-content">

      <?= app\widgets\Products\Products::widget(['view' => 'list']); ?>

    </div>

</div>
