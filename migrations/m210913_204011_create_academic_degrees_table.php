<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%academic_degrees}}`.
 */
class m210913_204011_create_academic_degrees_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%academic_degrees}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Ученая степень преподавателя'),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->batchInsert('academic_degrees', ['name'], [
            ['Кандидат наук'],
            ['Доктор наук'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%academic_degrees}}');
    }
}
