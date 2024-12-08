<?php

use yii\db\Migration;

/**
 * Class m241204_171234_create_table_registration
 */
class m241204_171234_create_table_registration extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('CREATE TABLE `registration` (
          `key` varchar(32) NOT NULL,
          `first_name` varchar(200) DEFAULT NULL,
          `last_name` varchar(200) DEFAULT NULL,
          `mobile` varchar(17) DEFAULT NULL,
          `email` varchar(200) DEFAULT NULL,
          `date_added` datetime DEFAULT NULL,
          PRIMARY KEY (`key`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m241204_171234_create_table_registration cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241204_171234_create_table_registration cannot be reverted.\n";

        return false;
    }
    */
}
