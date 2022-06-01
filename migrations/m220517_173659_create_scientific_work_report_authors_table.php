<?php

use yii\db\Migration;
use domain\workReport\WorkReportLevel; 

class m220517_173659_create_scientific_work_report_authors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%scientific_work_report_authors}}', [
            'id' => $this->primaryKey(),

            'work_report_id' => $this->integer()->notNull(),
            'teacher_id' => $this->integer()->notNull(),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'FK-scientific_work_report_authors-work_report_id',
            '{{%scientific_work_report_authors}}',
            'work_report_id',
            '{{%scientific_work_reports}}',
            'id'
        );
        $this->addForeignKey(
            'FK-scientific_work_report_authors-teacher_id',
            '{{%scientific_work_report_authors}}',
            'teacher_id',
            '{{%teachers}}',
            'id'
        );
        $this->batchInsert('{{%scientific_work_report_authors}}', ['work_report_id', 'teacher_id'], [

            [1, 1],
            [2, 1],
            [3, 1],
            [4, 1],
            [5, 1],
            [6, 1],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'FK-scientific_work_report_authors-work_report_id',
            '{{%scientific_work_report_authors}}',
        );
        $this->dropForeignKey(
            'FK-scientific_work_report_authors-teacher_id',
            '{{%scientific_work_reports}}',
        );
        $this->dropTable('{{%scientific_work_report_authors}}');
    }
}
