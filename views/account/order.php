<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap5\Popover;
use app\models\Order;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мои заказы';
$this->params['breadcrumbs'][] = $this->title;

?>

<style>
    .popover{
        max-width: 100%; /* Max Width of the popover (depending on the container!) */
    }
</style>
<div class="account-order">

    <div class="container">

        <h3 class="m-2 text-center"><?= Html::encode($this->title) ?></h3>

        <div class="table-responsive">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $filterModel,
                'columns' => [
                    [
                        'label' => '№ заказа',
                        'attribute' => 'id',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'width:120px;'],
                        'value' => function($item) {
                            return $item->id;
                        }
                    ],
                    [
                        'attribute' => 'date',
                        'format' => 'raw',
                        'value' => function($item) {
                            return Yii::$app->formatter->asDate($item->date, 'short');
                        },
                        'headerOptions' => ['style' => 'width:120px;', 'class' => ''],
                        'filter' => \yii\jui\DatePicker::widget([
                            'model' => $filterModel,
                            'attribute' => 'date',
                            'language' => 'ru',
                            'dateFormat' => 'dd.MM.yyyy',
                            'options' => ['class' => 'form-control', 'style' => 'max-width:120px;'],
                        ]),
                    ],
                    [
                        'label' => 'Сумма',
                        'format' => 'raw',
                        'value' => function($item) {

                            $html = '<table class="table table-hover table-bordered">';
                            $html .= '<tr><th>#</th><th>Артикул</th><th>Название</th><th>Цена</th><th class="text-nowrap">Кол-во</th><th>Стоимость</th></tr>';

                            $i = 1;

                            if (!empty($item->items)) {

                                foreach ($item->items as $product) {
                                    $html .= '<tr class="fw-light">
                                                <td>' . $i++ . '</td>
                                                <td>' . $product->code . '</td>
                                                <td>' . $product->name . '</td><td>' . $product->price . '</td><td>' . $product->quantity . '</td>
                                                <td>' . $product->amount . '</td>
                                                </tr>';
                                }

                            }

                            $html .= '</table>';

                            return Popover::widget([
                                'title' => '',
                                'clientOptions' => ['content' => $html],
                                'toggleButton' => [
                                    'tag' => 'button',
                                    'class' => 'btn border btn-sm btn-outline-secondary text-nowrap',
                                    'label' => $item->total,
                                    'data-bs-trigger' => Popover::TRIGGER_CLICK
                                ],
                            ]);

                        }
                    ],
                    [
                        'format' => 'raw',
                        'value' => function($item) {

                            return Html::beginForm(['/order/delete', 'id' => $item->id])
                                . Html::submitButton(
                                    'Удалть',
                                    ['class' => 'btn btn-sm btn-outline-danger bi bi-trash delete-order-btn']
                                )
                                . Html::endForm();

                        },
                        'headerOptions' => ['style' => 'width:100px;', 'class' => ''],
                    ],
                ],
            ]); ?>

        </div>

    </div>

</div>

<?php

$initAccountOrder = <<< JS

    $(document).on('click', '.delete-order-btn', function(){
        
        if (confirm('Удалить Заказ?')) {
        } else {
            return false;
        }
  
    });

JS;

$this->registerJs($initAccountOrder, \yii\web\View::POS_READY, 'initAccountOrder');
?>
