<?php

use yii\db\Migration;

/**
 * Class m211201_105410_create_teacher_journals_table
 */
class m211201_105410_create_teacher_journals_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%teacher_journals}}', [
            'id' => $this->primaryKey(),

            'name' => $this->string()->notNull()->comment('Название журнала'),
            'teacher_id' => $this->integer()->notNull()->comment('Владелец журнала'),
            'discipline_id' => $this->integer()->comment('Дисциплина журнала'),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'FK-teacher_journals-teachers_id',
            'teacher_journals',
            'teacher_id',
            'teachers',
            'id'
        );
        $this->addForeignKey(
            'FK-teacher_journals-discipline_id',
            'teacher_journals',
            'discipline_id',
            'disciplines',
            'id'
        );
        $this->batchInsert('{{%teacher_journals}}', ['name', 'teacher_id', 'discipline_id'], [
            ['Математический анализ', 1, 1],
            ['Геометрия и Алгебра', 2, 2],
            ['Функциональный анализ и интегральные уравнения', 3, 9],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'FK-teacher_journals-discipline_id',
            'teacher_journals'
        );
        $this->dropForeignKey(
            'FK-teacher_journals-teachers_id',
            'teacher_journals'
        );
        $this->dropTable('{{%teacher_journals}}');
    }
}
