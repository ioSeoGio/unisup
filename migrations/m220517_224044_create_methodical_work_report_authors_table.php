<?php declare(strict_types=1);

use yii\db\Migration;

class m220517_224044_create_methodical_work_report_authors_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%methodical_work_report_authors}}', [
            'id' => $this->primaryKey(),

            'work_report_id' => $this->integer()->notNull(),
            'teacher_id' => $this->integer()->notNull(),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'FK-methodical_work_report_authors-work_report_id',
            '{{%methodical_work_report_authors}}',
            'work_report_id',
            '{{%methodical_work_reports}}',
            'id'
        );
        $this->addForeignKey(
            'FK-methodical_work_report_authors-teacher_id',
            '{{%methodical_work_report_authors}}',
            'teacher_id',
            '{{%teachers}}',
            'id'
        );
        $this->batchInsert('{{%methodical_work_report_authors}}', ['work_report_id', 'teacher_id'], [

            [1, 1],
            [2, 3],
        ]);
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'FK-methodical_work_report_authors-teacher_id',
            '{{%methodical_work_report_authors}}',
        );
        $this->dropForeignKey(
            'FK-methodical_work_report_authors-work_report_id',
            '{{%methodical_work_reports}}',
        );
        $this->dropTable('{{%methodical_work_report_authors}}');
    }
}
