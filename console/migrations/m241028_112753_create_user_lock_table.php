<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_lock}}`.
 */
class m241028_112753_create_user_lock_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_lock', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->unique(),
            'attempts' => $this->integer()->defaultValue(0),
            'lock_time' => $this->timestamp()->defaultValue(null),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('user_lock');
    }
}
