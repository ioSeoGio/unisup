<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%class_types}}`.
 */
class m210913_203944_create_class_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%class_types}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Лекция/Семинар/Практика/Лаб и т.д.'),
            'time_coefficient' => $this->float()->notNull()->defaultValue(1)->comment('Коэффициент для расчета нагрузки преподавателей. Пример: 1 час экзамена равен полтора двум часам лекции.'),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        
        $this->batchInsert('class_types', ['name'], [
            ['Лекция'],
            ['Практика'],
            ['Лабораторная'],
            ['Семинар'],
            ['Зачет'],
            ['Экзамен'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%class_types}}');
    }
}
