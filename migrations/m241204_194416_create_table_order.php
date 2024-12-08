<?php

use yii\db\Migration;

/**
 * Class m241204_194416_create_table_order
 */
class m241204_194416_create_table_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('CREATE TABLE `order` (
            `id` int(10) NOT NULL AUTO_INCREMENT,
            `id_user` int(11) DEFAULT NULL,
            `total` float(10,2) DEFAULT NULL,
            `date` datetime DEFAULT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m241204_194416_create_table_order cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241204_194416_create_table_order cannot be reverted.\n";

        return false;
    }
    */
}
