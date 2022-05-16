<?php

use yii\db\Migration;
use domain\workReports\WorkReportLevel;

/**
 * Handles the creation of table `{{%educational_work_reports}}`.
 */
class m220511_183215_create_educational_work_reports_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%educational_work_reports}}', [
            'id' => $this->primaryKey(),

            'description' => $this->text()->notNull(),
            'level' => $this->string()->notNull(),
            
            'teacher_id' => $this->integer()->notNull(),
            'type_id' => $this->integer()->notNull(),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'FK-educational_work_reports_teacher_id-teachers_id',
            '{{%educational_work_reports}}',
            'teacher_id',
            '{{%teachers}}',
            'id'
        );
        $this->addForeignKey(
            'FK-educational_work_reports_type_id-work_report_types_id',
            '{{%educational_work_reports}}',
            'type_id',
            '{{%work_report_types}}',
            'id'
        );
        $this->batchInsert('{{%educational_work_reports}}', ['description', 'level', 'teacher_id', 'type_id'], [

            ['Организация и проведение конкурса «Национальное гостеприимство» (расп. №56 от 05.02.2020);', WorkReportLevel::BREST, 1, 5],
            ['Организация факультетского матча по мини-футболу между командой студентов 1 курса и командой старшекурсников физико-математического факультета; по баскетболу между командой преподавателей и студентов 30.10.2020 в 20.30 в спортивном зале Сендер А.Н. (расп. 223 от 08.10.2020);', WorkReportLevel::BREST, 1, 6],
            ['Организация и проведение информационного часа «Спортивная жизнь РБ. Достижения 2020 года»;', WorkReportLevel::BREST, 1, 5],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'FK-educational_work_reports_type_id-work_report_types_id',
            '{{%educational_work_reports}}',
        );
        $this->dropForeignKey(
            'FK-educational_work_reports_teacher_id-teachers_id',
            '{{%educational_work_reports}}'
        );
        $this->dropTable('{{%educational_work_reports}}');
    }
}
