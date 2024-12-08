<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="account-login d-flex align-items-center">

    <div class="container my-4">

        <h3 class="m-2 text-center"><?= Html::encode($this->title) ?></h3>

        <div class="w-100">

            <?php $form = ActiveForm::begin(['id' => 'account-login-form', 'options' => ['class' => 'd-flex justify-content-center']]); ?>

                <div class="border account-login-form-inner m-2 p-5 bg-primary-subtle rounded-3">

                    <?= $form->field($model, 'username', ['options' => ['class' => 'mb-1']])->textInput(['placeholder' => true, 'class' => 'form-control']); ?>

                    <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control'])->label('<span>Пароль</span> <a href="" class="btn btn-sm btn-outline-primary bi bi-eye show-password-btn" title="Показать пароль"></a>'); ?>

                    <?= $form->field($model, 'rememberMe')->checkbox(); ?>

                    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary account-login-form-btn', 'name' => 'login-button']); ?>

                    <?= Html::a('Регистрация', ['account/registration'], ['class' => 'mx-3 text-decoration-underline account-login-form-registration']); ?>

                </div>

            <?php ActiveForm::end(); ?>

        </div>

    </div>

</div>

<?php

$initLogin = <<< JS

    $(document).on('click', '.show-password-btn', function(){
      
        let type = $('#loginform-password').attr('type');
        
        if ('password' == type) { 
            $('#loginform-password').attr('type', 'text');
            $(this).removeClass('bi-eye').addClass('bi-eye-slash');
        } else {
            $('#loginform-password').attr('type', 'password');
            $(this).removeClass('bi-eye-slash').addClass('bi-eye');
        }
        
        return false;
    });

JS;

$this->registerJs($initLogin, \yii\web\View::POS_READY, 'initLogin');