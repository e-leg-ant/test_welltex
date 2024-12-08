<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseInflector;
use yii\helpers\Json;
use yii\web\UploadedFile;
use app\models\ProductImage;
use yz\shoppingcart\CartPositionInterface;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $slug
 * @property string|null $description
 * @property float|null $price
 * @property int $quantity
 */
class Product extends ActiveRecord implements CartPositionInterface
{

    public $noImageProduct = '/storage/product-no-image.png';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['quantity'], 'integer'],
            [['code'], 'string', 'max' => 50],
            [['name', 'slug'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Артикул',
            'name' => 'Название',
            'slug' => 'Слаг',
            'description' => 'Описание',
            'price' => 'Цена',
            'quantity' => 'Количество',
        ];
    }

    /**
     * @return float
     */
    public function getPrice() {
        return (float)$this->price;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param bool $withDiscount
     * @return integer
     */
    public function getCost($withDiscount = false/*Интерфейс требует*/) {

        return (float)$this->price * (int)$this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getQuantity() {
        return (int)$this->quantity;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            // Запись имени URL для ЧПУ для нового Товара
            // Проверка уникальности записываемого ЧПУ

            $slug = BaseInflector::slug($this->name);

            if (empty($this->slug)) {
                $this->slug = $slug;
            }

            return true;

        } else {
            return false;
        }
    }

    public function search()
    {

        $query = Product::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);

        $this->load(Yii::$app->request->queryParams);

        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['price' => $this->price]);
        $query->andFilterWhere(['like', 'name', (string)$this->name]);

        $query->orderBy(['id' => SORT_DESC]);

        return $dataProvider;
    }

    public function getMainImage()
    {

        // Если изображения нет, используем изображение-заглушку
        return $this->noImageProduct;

    }

}
