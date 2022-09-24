<?php declare(strict_types=1);

use yii\db\Migration;

/**
 * Handles the creation of table `{{%academic_titles}}`.
 */
class m210913_204010_create_academic_titles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%academic_titles}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Ученое звание преподавателя'),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->batchInsert('academic_titles', ['name'], [
            ['Доцент'],
            ['Профессор'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%academic_titles}}');
    }
}
