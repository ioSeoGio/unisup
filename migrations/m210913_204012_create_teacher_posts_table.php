<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%teacher_posts}}`.
 */
class m210913_204012_create_teacher_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%teacher_posts}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Должность преподавателя)'),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        
        $this->batchInsert('teacher_posts', ['name'], [
            ['Преподаватель'],
            ['Ст. преподаватель'],
            ['Ассистент'],
            ['Доцент'],
            ['Профессор'],
            ['Зав. кафедры'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%teacher_posts}}');
    }
}
