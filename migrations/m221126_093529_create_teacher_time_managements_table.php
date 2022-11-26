<?php declare(strict_types=1);

use yii\db\Migration;

class m221126_093529_create_teacher_time_managements_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%teacher_time_managements}}', [
            'id' => $this->primaryKey(),

            'teacher_id' => $this->integer()->notNull(),
            'discipline_id' => $this->integer()->notNull(),
            'semester_id' => $this->integer()->notNull(),
            'hours' => $this->float()->notNull()->defaultValue(0),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'FK-teacher_time_managements_teacher_id-teachers_id',
            '{{%teacher_time_managements}}',
            'teacher_id',
            '{{%teachers}}',
            'id'
        );
        $this->addForeignKey(
            'FK-teacher_time_managements_discipline_id-disciplines_id',
            '{{%teacher_time_managements}}',
            'discipline_id',
            '{{%disciplines}}',
            'id'
        );
        $this->addForeignKey(
            'FK-teacher_time_managements_semester_id-semesters_id',
            '{{%teacher_time_managements}}',
            'semester_id',
            '{{%semesters}}',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'FK-teacher_time_managements_semester_id-semesters_id',
            '{{%teacher_time_managements}}',
        );
        $this->dropForeignKey(
            'FK-teacher_time_managements_discipline_id-disciplines_id',
            '{{%teacher_time_managements}}',
        );
        $this->dropForeignKey(
            'FK-teacher_time_managements_teacher_id-teachers_id',
            '{{%teacher_time_managements}}',
        );
        $this->dropTable('{{%teacher_time_managements}}');
    }
}
