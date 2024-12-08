<?php

namespace app\models;

use Yii;
use app\models\OrderItem;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int|null $id_user
 * @property float|null $total
 * @property string|null $date
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id'], 'integer'],
            [['total'], 'number'],
            [['date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id Клиента',
            'total' => 'Сумма',
            'date' => 'Дата',
        ];
    }

    public function searchUser()
    {

        $query = Order::find();

        $this->load(Yii::$app->request->queryParams);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);
        $query->andWhere(['id_user' => Yii::$app->user->getId()]);
        $query->andFilterWhere(['id' => $this->id]);

        if (!empty($this->total)) {
            $query->andFilterWhere(['total' => (float)$this->total]);
        }

        $query->orderBy(['id' => SORT_DESC]);

        return $dataProvider;
    }

    /**
     * Получение данных таблицы OrderItem
     */

    public function getItems()
    {
        return $this->hasMany(OrderItem::class, ['id_order' => 'id']);
    }

    /**
     * Создание заказа
     *
     * @static
     * @access public
     * @param array $contents ,
     * @return int id заказа
     */
    public static function add($contents)
    {
        $order = new self;

        $total = 0;

        $order->date = date('Y-m-d H:i:s');
        $order->id_user = $contents['id_user'];

        if ($order->save()) {

            if (!empty($contents['items']) && is_array($contents['items'])) {

                foreach ($contents['items'] as $item) {

                    $orderItem = new OrderItem();
                    $orderItem->id_order = $order->id;
                    $orderItem->id_item = $item['id'];
                    $orderItem->name = $item['name'];
                    $orderItem->price = $item['price'];
                    $orderItem->quantity = $item['quantity'];
                    $orderItem->amount = $item['amount'];
                    $orderItem->code = $item['code'];

                    $orderItem->save();

                    $total += $item['amount'];
                }
            }
        }

        $order->total = $total;

        $order->save();

        return $order->id;
    }
}
