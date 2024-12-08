<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap5\ActiveForm */

use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\ActiveForm;
use yii\web\JsExpression;

$this->title = 'Настройки';

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="account-settings d-flex align-items-center">

    <div class="container">

        <h2 class="m-2 text-center"><?= Html::encode($this->title) ?></h2>

        <div class="w-100 mb-4">

            <?php $form = ActiveForm::begin(['id' => 'account-settings-form', 'options' => ['class' => 'd-flex justify-content-center']]); ?>

            <div class="account-settings-form my-2 p-2 bg-primary-subtle rounded-3">

                <div class="d-flex">

                    <div class="my-2 p-2">

                        <?= $form->field($modelClient, 'password', ['options' => ['class' => 'mb-1']])->passwordInput(['placeholder' => true, 'class' => 'form-control']); ?>

                        <?= $form->field($modelClient, 'new_password', ['options' => ['class' => 'mb-1']])->passwordInput(['placeholder' => true, 'class' => 'form-control']); ?>

                        <?= $form->field($modelClient, 'repeat_password', ['options' => ['class' => 'mb-1']])->passwordInput(['placeholder' => true, 'class' => 'form-control']); ?>

                    </div>

                </div>

                <div class="d-flex p-4 breadcrumbw-100 justify-content-end">

                    <?= Html::submitButton(' Сохранить', ['class' => 'btn btn-primary bi bi-save p-2 lh-l', 'name' => 'login-button']) ?>

                </div>

                <?php ActiveForm::end(); ?>

            </div>

        </div>

    </div>

</div>

<?php

$initRegistration = <<< JS


JS;

$this->registerJs($initRegistration, View::POS_READY, 'initRegistration');
