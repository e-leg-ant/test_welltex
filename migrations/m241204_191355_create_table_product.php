<?php

use yii\db\Migration;

/**
 * Class m241204_191355_create_table_product
 */
class m241204_191355_create_table_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('CREATE TABLE `product` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `code` varchar(50) NOT NULL,
              `name` varchar(200) NOT NULL,
              `slug` varchar(200) DEFAULT NULL,
              `description` text DEFAULT NULL,
              `price` float DEFAULT 0,
              `quantity` int(11) NOT NULL DEFAULT 0,
              PRIMARY KEY (`id`),
              KEY `code` (`code`)
            ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m241204_191355_create_table_product cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241204_191355_create_table_product cannot be reverted.\n";

        return false;
    }
    */
}
