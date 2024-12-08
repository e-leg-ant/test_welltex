<?php

use yii\db\Migration;

/**
 * Class m241204_165003_create_table_user
 */
class m241204_165003_create_table_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('CREATE TABLE `user` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `username` varchar(255) NOT NULL,
          `auth_key` varchar(32) NOT NULL,
          `password_hash` varchar(255) NOT NULL,
          `password_reset_token` varchar(255) DEFAULT NULL,
          `email` varchar(200) NOT NULL,
          `mobile` varchar(17) DEFAULT NULL,
          `last_name` varchar(200) DEFAULT NULL,
          `first_name` varchar(200) DEFAULT NULL,
          `status` smallint(6) NOT NULL DEFAULT 10,
          `created_at` int(11) NOT NULL,
          `updated_at` int(11) NOT NULL,
          PRIMARY KEY (`id`),
          UNIQUE KEY `username` (`username`),
          UNIQUE KEY `email` (`email`),
          UNIQUE KEY `password_reset_token` (`password_reset_token`)
        ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4;');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m241204_165003_create_table_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241204_165003_create_table_user cannot be reverted.\n";

        return false;
    }
    */
}
