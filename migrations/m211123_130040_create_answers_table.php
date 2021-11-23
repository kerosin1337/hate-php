<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%answers}}`.
 */
class m211123_130040_create_answers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%answers}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'theme_id' => $this->integer()->notNull(),
            'text' => $this->text(),
            'date' => $this->timestamp()->defaultExpression('NOW()')
        ]);
        $this->addForeignKey(
            'fk-answers-user_id',
            'answers',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-answers-theme_id',
            'answers',
            'theme_id',
            'themes',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%answers}}');
    }
}
