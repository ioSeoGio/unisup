<?php declare(strict_types=1);

use yii\db\Migration;

/**
 * Handles the creation of table `{{%departments}}`.
 */
class m210913_190558_create_departments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%departments}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Название кафедры'),
            'faculty_id' => $this->integer()->notNull()->comment('Название факультета'),
            
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'FK-departments_faculty_id-faculties_id',
            'departments',
            'faculty_id',
            'faculties',
            'id'
        );
       $this->batchInsert('departments', ['faculty_id', 'name'], [
           [5, 'Кафедра алгебры, геометрии и математического моделирования'],
           [5, 'Кафедра математического анализа, дифференциальных уравнений и их приложений'],
           [5, 'Кафедра методики преподавания физико-математических дисциплин'],
           [5, 'Кафедра прикладной математики и информатики'],
           [5, 'Кафедра общей и теоретической физики'],
       ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'FK-departments_faculty_id-faculties_id',
            'departments'
        );
        $this->dropTable('{{%departments}}');
    }
}
