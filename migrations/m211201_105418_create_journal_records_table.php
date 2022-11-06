<?php declare(strict_types=1);

use yii\db\Migration;

/**
 * Class m211201_105418_create_table_journal_records
 */
class m211201_105418_create_journal_records_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%journal_records}}', [
            'id' => $this->primaryKey(),

            'topic' => $this->string()->notNull()->comment('Тема проведенного занятия/работы'),
            'hours_amount' => $this->float()->defaultValue(2)->notNull()->comment('Количество академических часов на затраченных на занятие (по стандарту 2 для лекции/практики)'),
            'lesson_at' => $this->timestamp()->notNull()->comment('Дата время проведенного занятия'),
            
            'class_type' => $this->integer()->notNull()->comment('Лаба/практика/лекция и т.д.'),
            'journal_id' => $this->integer()->notNull()->comment('Журнал в котором запись'),
            'teacher_id' => $this->integer()->notNull()->comment('Преподаватель который сделал запись в журнал'),
            'group_id' => $this->integer()->notNull()->comment('Группа у которой было занятие'),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'FK-journal_records_class_type-class_types_id',
            '{{%journal_records}}',
            'class_type',
            '{{%class_types}}',
            'id'
        );
        $this->addForeignKey(
            'FK-journal_records-journal_id',
            '{{%journal_records}}',
            'journal_id',
            '{{%journals}}',
            'id'
        );
        $this->addForeignKey(
            'FK-journal_records-teachers_id',
            '{{%journal_records}}',
            'teacher_id',
            '{{%teachers}}',
            'id'
        );
        $this->addForeignKey(
            'FK-journal_records-group_id',
            '{{%journal_records}}',
            'group_id',
            '{{%groups}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'FK-journal_records-group_id',
            '{{%journal_records}}'
        );
        $this->dropForeignKey(
            'FK-journal_records-teachers_id',
            'journal_records'
        );
        $this->dropForeignKey(
            'FK-journal_records-journal_id',
            'journal_records'
        );
        $this->dropForeignKey(
            'FK-journal_records_class_type-class_types_id',
            'journal_records'
        );
        $this->dropTable('{{%journal_records}}');
    }
}
