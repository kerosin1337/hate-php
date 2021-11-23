<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m211123_124142_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string(256)->unique()->notNull(),
            'name' => $this->string(256)->notNull(),
            'surname' => $this->string(256)->notNull(),
            'password' => $this->string(256)->notNull(),
            'is_active' => $this->boolean()->defaultValue(true),
            'role' => $this->integer()->defaultValue(0)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
