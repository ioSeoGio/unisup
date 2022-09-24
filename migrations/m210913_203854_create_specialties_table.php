<?php declare(strict_types=1);

use yii\db\Migration;

/**
 * Handles the creation of table `{{%specialties}}`.
 */
class m210913_203854_create_specialties_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%specialties}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Название специальности'),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->batchInsert('specialties', ['name'], [
            ['Физика и математика (преподаватель)'],
            ['Математика и информатика (преподаватель)'],
            ['Прикладная математика'],
            ['Экономическая кибернетика'],
            ['Компьютерная физика'],
            ['Физика (магистр)'],
            ['Математика и компьютерные науки с профилизацией "Web-программирование и интернет-технологии" (магистр)'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%specialties}}');
    }
}
