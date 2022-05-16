<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%auditorium_types}}`.
 */
class m210913_204356_create_auditorium_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%auditorium_types}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Лаба/обычная и т.д.'),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%auditorium_types}}');
    }
}
