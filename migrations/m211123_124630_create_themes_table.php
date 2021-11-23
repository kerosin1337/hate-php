<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%themes}}`.
 */
class m211123_124630_create_themes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%themes}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string(128)->notNull(),
            'text' => $this->text()->notNull(),
            'status' => $this->integer()->defaultValue(1),
            'date' => $this->timestamp()->defaultExpression('NOW()')
        ]);
        $this->addForeignKey(
            'fk-themes-user_id',
            'themes',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%themes}}');
    }
}
