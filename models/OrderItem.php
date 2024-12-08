<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_item".
 *
 * @property int $id
 * @property int|null $id_order
 * @property int|null $id_item
 * @property string|null $name
 * @property string|null $code
 * @property float|null $price
 * @property int|null $quantity
 * @property float|null $amount
 *
 * @property Product $item
 * @property Order $order
 */
class OrderItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_order', 'id_item', 'quantity'], 'integer'],
            [['price', 'amount'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 100],
            [['id_order'], 'exist', 'skipOnError' => true, 'targetClass' => Order::class, 'targetAttribute' => ['id_order' => 'id']],
            [['id_item'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['id_item' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_order' => 'Id заказа',
            'id_item' => 'Id позиции',
            'name' => 'Название',
            'code' => 'Артикул',
            'price' => 'Цена',
            'quantity' => 'Количество',
            'amount' => 'Стоимость',
        ];
    }

    /**
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Product::class, ['id' => 'id_item']);
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'id_order']);
    }
}
