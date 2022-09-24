<?php declare(strict_types=1);

use yii\db\Migration;

/**
 * Handles the creation of table `{{%disciplines}}`.
 */
class m210913_204009_create_disciplines_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%disciplines}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Название дисциплины'),
            'name_in_short' => $this->string()->comment('Сокращенное название дисциплины'),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->batchInsert('disciplines', ['name'], [
            ['Математический анализ'],
            ['Геометрия и алгебра'],
            ['Дифференциальные уравнения'],
            ['Теория вероятностей и математическая статистика'],
            ['Иностранный язык'],
            ['Дискретная математика и математическая логика'],
            ['Вычислительные методы алгебры'],
            ['Операционные системы'],
            ['Функциональный анализ и интегральные уравнения'],
            ['Алгоритмы и структуры данных'],
            ['Методы численного анализа'],
            ['Методы оптимизации'],
            ['Уравнения математической физики'],
            ['Компьютерные сети'],
            ['Методы промышленного программирования'],
            ['Web-программирование'],
            ['Избранные главы информатики'],
            ['Исследование операций'],
            ['Численные методы математической физики'],
            ['Модели данных и системы управления базами данных'],
            ['Программирование'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%disciplines}}');
    }
}
