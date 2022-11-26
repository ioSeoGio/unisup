<?php declare(strict_types=1);

use yii\db\Migration;

class m221113_072032_add_teacher_rates_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%teacher_rates}}', [
            'id' => $this->primaryKey(),

            'teacher_id' => $this->integer()->notNull(),
            'hours' => $this->float()->notNull()->defaultValue(0),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'FK-teacher_rates_teacher_id-teachers_id',
            '{{%teacher_rates}}',
            'teacher_id',
            '{{%teachers}}',
            'id'
        );
    }

    public function safeDown(): bool
    {
        $this->dropForeignKey(
            'FK-teacher_rates_teacher_id-teachers_id',
            '{{%teacher_rates}}',
        );
        $this->dropTable('{{%teacher_rates}}');
        
        return true;
    }
}
