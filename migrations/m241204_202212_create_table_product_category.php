<?php

use yii\db\Migration;

/**
 * Class m241204_202212_create_table_product_category
 */
class m241204_202212_create_table_product_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('CREATE TABLE `product_category` (
              `id_product` int(11) NOT NULL,
              `id_category` int(11) NOT NULL,
              PRIMARY KEY (`id_product`, `id_category`),
              KEY `category_idx` (`id_category`),
              KEY `product_idx` (`id_product`),
              CONSTRAINT `category` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m241204_202212_create_table_product_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241204_202212_create_table_product_category cannot be reverted.\n";

        return false;
    }
    */
}
