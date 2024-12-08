<?php

use yii\db\Migration;

/**
 * Class m241204_224135_content
 */
class m241204_224135_content extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $categoryModel = new \app\models\Category();
        $categoryModel->name = 'Салаты';
        $categoryModel->save();

        $productModel = new \app\models\Product();
        $productModel->name = 'Салат с креветками, страчателлой и хурмой';
        $productModel->description = '200 г';
        $productModel->price = 790;
        $productModel->quantity = 1;
        $productModel->code = 'A0001';
        $productModel->save();

        $productCategoryModel = new \app\models\ProductCategory();
        $productCategoryModel->id_category = $categoryModel->id;
        $productCategoryModel->id_product = $productModel->id;
        $productCategoryModel->save();

        $productModel = new \app\models\Product();
        $productModel->name = 'Салат с лососем, апельсинами в заправке манго-маракуя';
        $productModel->description = '200 г';
        $productModel->price = 800;
        $productModel->quantity = 1;
        $productModel->code = 'A0002';
        $productModel->save();

        $productCategoryModel = new \app\models\ProductCategory();
        $productCategoryModel->id_category = $categoryModel->id;
        $productCategoryModel->id_product = $productModel->id;
        $productCategoryModel->save();

        $productModel = new \app\models\Product();
        $productModel->name = 'Зелёный салат с ореховым соусом и злаками';
        $productModel->description = '250 г';
        $productModel->price = 380;
        $productModel->quantity = 1;
        $productModel->code = 'A0003';
        $productModel->save();

        $productCategoryModel = new \app\models\ProductCategory();
        $productCategoryModel->id_category = $categoryModel->id;
        $productCategoryModel->id_product = $productModel->id;
        $productCategoryModel->save();

        $productModel = new \app\models\Product();
        $productModel->name = 'Теплый салат с телятиной и шпинатом';
        $productModel->description = '260 г';
        $productModel->price = 570;
        $productModel->quantity = 1;
        $productModel->code = 'A0004';
        $productModel->save();

        $productCategoryModel = new \app\models\ProductCategory();
        $productCategoryModel->id_category = $categoryModel->id;
        $productCategoryModel->id_product = $productModel->id;
        $productCategoryModel->save();


        $categoryModel = new \app\models\Category();
        $categoryModel->name = 'Супы';
        $categoryModel->save();

        $productModel = new \app\models\Product();
        $productModel->name = 'Рамен с телятиной';
        $productModel->description = '450 г';
        $productModel->price = 690;
        $productModel->quantity = 1;
        $productModel->code = 'B0001';
        $productModel->save();

        $productCategoryModel = new \app\models\ProductCategory();
        $productCategoryModel->id_category = $categoryModel->id;
        $productCategoryModel->id_product = $productModel->id;
        $productCategoryModel->save();

        $productModel = new \app\models\Product();
        $productModel->name = 'Том-ям с морепродуктами';
        $productModel->description = '350 г';
        $productModel->price = 850;
        $productModel->quantity = 1;
        $productModel->code = 'B0002';
        $productModel->save();

        $productCategoryModel = new \app\models\ProductCategory();
        $productCategoryModel->id_category = $categoryModel->id;
        $productCategoryModel->id_product = $productModel->id;
        $productCategoryModel->save();

        $productModel = new \app\models\Product();
        $productModel->name = 'Рыбный суп Том-Кха';
        $productModel->description = '410 г';
        $productModel->price = 890;
        $productModel->quantity = 1;
        $productModel->code = 'B0003';
        $productModel->save();

        $productCategoryModel = new \app\models\ProductCategory();
        $productCategoryModel->id_category = $categoryModel->id;
        $productCategoryModel->id_product = $productModel->id;
        $productCategoryModel->save();

        $productModel = new \app\models\Product();
        $productModel->name = 'Грибной крем-суп с тыквенным кремом';
        $productModel->description = '300 г';
        $productModel->price = 490;
        $productModel->quantity = 1;
        $productModel->code = 'B0004';
        $productModel->save();

        $productCategoryModel = new \app\models\ProductCategory();
        $productCategoryModel->id_category = $categoryModel->id;
        $productCategoryModel->id_product = $productModel->id;
        $productCategoryModel->save();


        $categoryModel = new \app\models\Category();
        $categoryModel->name = 'Десерты';
        $categoryModel->save();

        $productModel = new \app\models\Product();
        $productModel->name = 'Пирог с сезонными фруктами от шефа';
        $productModel->description = '140 г';
        $productModel->price = 320;
        $productModel->quantity = 1;
        $productModel->code = 'C0001';
        $productModel->save();

        $productCategoryModel = new \app\models\ProductCategory();
        $productCategoryModel->id_category = $categoryModel->id;
        $productCategoryModel->id_product = $productModel->id;
        $productCategoryModel->save();

        $productModel = new \app\models\Product();
        $productModel->name = 'Сметанник от шефа';
        $productModel->description = '160 г';
        $productModel->price = 410;
        $productModel->quantity = 1;
        $productModel->code = 'C0002';
        $productModel->save();

        $productCategoryModel = new \app\models\ProductCategory();
        $productCategoryModel->id_category = $categoryModel->id;
        $productCategoryModel->id_product = $productModel->id;
        $productCategoryModel->save();

        $productModel = new \app\models\Product();
        $productModel->name = 'Баскский чизкейк от шефа';
        $productModel->description = '160 г';
        $productModel->price = 390;
        $productModel->quantity = 1;
        $productModel->code = 'C0003';
        $productModel->save();

        $productCategoryModel = new \app\models\ProductCategory();
        $productCategoryModel->id_category = $categoryModel->id;
        $productCategoryModel->id_product = $productModel->id;
        $productCategoryModel->save();

        $productModel = new \app\models\Product();
        $productModel->name = 'Чизкейк Нью-Йорк';
        $productModel->description = '160 г';
        $productModel->price = 350;
        $productModel->quantity = 1;
        $productModel->code = 'C0004';
        $productModel->save();

        $productCategoryModel = new \app\models\ProductCategory();
        $productCategoryModel->id_category = $categoryModel->id;
        $productCategoryModel->id_product = $productModel->id;
        $productCategoryModel->save();


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m241204_224135_content cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241204_224135_content cannot be reverted.\n";

        return false;
    }
    */
}
