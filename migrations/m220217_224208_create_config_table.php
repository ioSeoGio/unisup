<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%config}}`.
 */
class m220217_224208_create_config_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%config}}', [
            'id' => $this->primaryKey(),
            'param' => $this->string(128)->notNull(),
            'value' => $this->text(),
            'default' => $this->text(),
            'label' => $this->string(255)->notNull(),
            'input_type' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%config}}');
    }
}
