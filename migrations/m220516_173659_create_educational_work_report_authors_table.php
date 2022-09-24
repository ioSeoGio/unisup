<?php declare(strict_types=1);

use yii\db\Migration;


class m220516_173659_create_educational_work_report_authors_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%educational_work_report_authors}}', [
            'id' => $this->primaryKey(),

            'work_report_id' => $this->integer()->notNull(),
            'teacher_id' => $this->integer()->notNull(),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'FK-educational_work_report_authors-work_report_id',
            '{{%educational_work_report_authors}}',
            'work_report_id',
            '{{%educational_work_reports}}',
            'id'
        );
        $this->addForeignKey(
            'FK-educational_work_report_authors-teacher_id',
            '{{%educational_work_report_authors}}',
            'teacher_id',
            '{{%teachers}}',
            'id'
        );
        $this->batchInsert('{{%educational_work_report_authors}}', ['work_report_id', 'teacher_id'], [

            [1, 1],
            [2, 1],
            [3, 1],
        ]);
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'FK-educational_work_report_authors-work_report_id',
            '{{%educational_work_report_authors}}',
        );
        $this->dropForeignKey(
            'FK-educational_work_report_authors-teacher_id',
            '{{%educational_work_reports}}',
        );
        $this->dropTable('{{%educational_work_report_authors}}');
    }
}
