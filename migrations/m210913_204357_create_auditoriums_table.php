<?php declare(strict_types=1);

use yii\db\Migration;

/**
 * Handles the creation of table `{{%auditoriums}}`.
 */
class m210913_204357_create_auditoriums_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%auditoriums}}', [
            'id' => $this->primaryKey(),
            'auditorium' => $this->string()->notNull()->comment('Номер аудитории (кабинета)'),
            'size_auditorium' => $this->integer()->notNull()->comment('Количество посадочных мест'),
            'auditorium_type_id' => $this->integer()->notNull()->comment('Лаба/обычная и т.д.'),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'FK-auditoriums_auditorium_type_id-auditorium_types_id',
            'auditoriums',
            'auditorium_type_id',
            'auditorium_types',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'FK-auditoriums_auditorium_type_id-auditorium_types_id',
            'auditoriums'
        );
        $this->dropTable('{{%auditoriums}}');
    }
}
