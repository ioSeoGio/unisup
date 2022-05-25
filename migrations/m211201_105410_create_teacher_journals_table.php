<?php

use yii\db\Migration;

class m211201_105410_create_teacher_journals_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%journals}}', [
            'id' => $this->primaryKey(),

            'name' => $this->string()->notNull()->comment('Название журнала'),
            'teacher_id' => $this->integer()->notNull()->comment('Владелец журнала'),
            'discipline_id' => $this->integer()->comment('Дисциплина журнала'),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'FK-journals-teachers_id',
            'journals',
            'teacher_id',
            'teachers',
            'id'
        );
        $this->addForeignKey(
            'FK-journals-discipline_id',
            'journals',
            'discipline_id',
            'disciplines',
            'id'
        );
        $this->batchInsert('{{%journals}}', ['name', 'teacher_id', 'discipline_id'], [
            ['Математический анализ', 1, 1],
            ['Геометрия и Алгебра', 2, 2],
            ['Функциональный анализ и интегральные уравнения', 3, 9],
        ]);
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'FK-journals-discipline_id',
            'journals'
        );
        $this->dropForeignKey(
            'FK-journals-teachers_id',
            'journals'
        );
        $this->dropTable('{{%journals}}');
    }
}
