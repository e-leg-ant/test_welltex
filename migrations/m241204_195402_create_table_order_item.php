<?php

use yii\db\Migration;

/**
 * Class m241204_195402_create_table_order_item
 */
class m241204_195402_create_table_order_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('CREATE TABLE `order_item` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `id_order` int(10) DEFAULT NULL,
              `id_item` int(10) DEFAULT NULL,
              `name` varchar(255) DEFAULT NULL,
              `code` varchar(100) DEFAULT NULL,
              `price` float(10,2) DEFAULT NULL,
              `quantity` int(10) DEFAULT NULL,
              `amount` float(10,2) DEFAULT NULL,
              PRIMARY KEY (`id`),
              KEY `order_idx` (`id_order`),
              KEY `product_idx` (`id_item`),
              CONSTRAINT `order` FOREIGN KEY (`id_order`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `product` FOREIGN KEY (`id_item`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m241204_195402_create_table_order_item cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241204_195402_create_table_order_item cannot be reverted.\n";

        return false;
    }
    */
}
