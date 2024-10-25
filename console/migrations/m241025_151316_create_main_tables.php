<?php

use yii\db\Migration;

/**
 * Class m241025_151316_create_main_tables
 */
class m241025_151316_create_main_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('code_category', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        $this->createTable('code', [
            'id' => $this->primaryKey(),
            'code' => $this->string(6)->notNull(),
            'promocode' => $this->string()->notNull(),
            'code_category_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'taken_at' => $this->integer(),
            'user_ip' => $this->integer(),
            'public_status' => $this->boolean()->defaultValue(0),
        ]);

        $this->addForeignKey(
            'fk-code-code_category_id',
            'code',
            'code_category_id',
            'code_category',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-code-code_category_id',
            'code'
        );

        $this->dropTable('code');
        $this->dropTable('code_category');
    }
}
