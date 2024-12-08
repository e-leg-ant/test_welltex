<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap5\ActiveForm */

use yii\web\View;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Регистрация';

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="account-registration d-flex align-items-center">

    <div class="container">

        <h3 class="m-2"><?= Html::encode($this->title) ?></h3>

        <div class="w-100">

            <?php $form = ActiveForm::begin(['id' => 'account-registration-form']); ?>

            <div class="border w-100 m-2 p-5 bg-primary-subtle rounded-3">

                <?= $form->field($model, 'last_name', ['options' => ['class' => 'mb-1']])->textInput(['placeholder' => true, 'class' => 'form-control']) ?>

                <?= $form->field($model, 'first_name', ['options' => ['class' => 'mb-1']])->textInput(['placeholder' => true, 'class' => 'form-control']) ?>

                <?= $form->field($model, 'mobile', ['options' => ['class' => 'mb-1']])->widget(\yii\widgets\MaskedInput::class, [
                    'mask' => '+7(999)-999-99-99',
                    'options' => ['placeholder' => '+7(___)-___-__-__',]
                ]); ?>

                <?= $form->field($model, 'email', ['options' => ['class' => 'mb-1']])->textInput(['placeholder' => true, 'class' => 'form-control']) ?>

                <?= $form->field($model, 'agree')->checkbox(['label' => 'Согласен со всем и даю согласие на обработку своих персональных данных.'], true); ?>

                <?= Html::submitButton('Зарегистрировать', ['class' => 'btn btn-primary mt-2', 'name' => 'account-registration-button']) ?>

            </div>

            <?php ActiveForm::end(); ?>

            </div>

        </div>

    </div>

</div>
