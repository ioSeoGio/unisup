<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%teacher_preferences}}`.
 */
class m210913_204358_create_teacher_preferences_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%teacher_preferences}}', [
            'id' => $this->primaryKey(),
            'discipline_id' => $this->integer()->notNull()->comment('Желаемая дисциплина (выбор преподавателя)'),
            'course_id' => $this->integer()->notNull()->comment('Желаемый курс (выбор преподавателя)'),
            'teacher_id' => $this->integer()->notNull()->comment('Преподаватель'),
            'semester' => $this->integer()->notNull()->comment('Желаемый семестр данной дисциплины (выбор преподавателя)'),

            'importance_coefficient' => $this->float()->notNull()->comment('Коэффициент важности предпочтения'),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'FK-teacher_preferences_discipline_id-disciplines_id',
            'teacher_preferences',
            'discipline_id',
            'disciplines',
            'id'
        );
        $this->addForeignKey(
            'FK-teacher_preferences_course_id-courses_id',
            'teacher_preferences',
            'course_id',
            'courses',
            'id'
        );
        $this->addForeignKey(
            'FK-teacher_preferences_teacher_id-teachers_id',
            'teacher_preferences',
            'teacher_id',
            'teachers',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'FK-teacher_preferences_teacher_id-teachers_id',
            'teacher_preferences'
        );
        $this->dropForeignKey(
            'FK-teacher_preferences_course_id-courses_id',
            'teacher_preferences'
        );
        $this->dropForeignKey(
            'FK-teacher_preferences_discipline_id-disciplines_id',
            'teacher_preferences'
        );
        $this->dropTable('{{%teacher_preferences}}');
    }
}
