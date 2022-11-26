<?php declare(strict_types=1);

use yii\db\Migration;

class m221119_100800_create_discipline_time_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%discipline_time}}', [
            'id' => $this->primaryKey(),

            'discipline_id' => $this->integer()->notNull(),
            'semester_id' => $this->integer()->notNull(),
            'hours' => $this->float()->notNull()->defaultValue(0),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'FK-discipline_time_discipline_id-disciplines_id',
            '{{%discipline_time}}',
            'discipline_id',
            '{{%disciplines}}',
            'id'
        );
        $this->addForeignKey(
            'FK-discipline_time_semester_id-semesters_id',
            '{{%discipline_time}}',
            'semester_id',
            '{{%semesters}}',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'FK-discipline_time_semester_id-semesters_id',
            '{{%discipline_time}}'
        );
        $this->dropForeignKey(
            'FK-discipline_time_discipline_id-disciplines_id',
            '{{%discipline_time}}'
        );
        $this->dropTable('{{%discipline_time}}');
    }
}
