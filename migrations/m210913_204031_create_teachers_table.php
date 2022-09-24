<?php declare(strict_types=1);

use yii\db\Migration;

class m210913_204031_create_teachers_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%teachers}}', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string()->notNull()->comment('ФИО преподавателя'),
            'sex' => $this->boolean()->notNull()->defaultValue(true)->comment('Пол преподавателя true = муж'),
            'department_id' => $this->integer()->notNull()->comment('Кафедра преподавателя'),
            
            'academic_degree_id' => $this->integer()->comment('Ученая степень преподавателя (при наличии)'),
            'academic_title_id' => $this->integer()->comment('Ученое звание преподавателя (при наличии)'),
            'teacher_post_id' => $this->integer()->comment('Должность преподавателя (при наличии)'),
            
            'working_since' => $this->timestamp()->notNull()->comment('Дата начала работы преподавателя'),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        
        $this->addForeignKey(
            'FK-teachers_department_id-departments_id',
            'teachers',
            'department_id',
            'departments',
            'id'
        );
        $this->addForeignKey(
            'FK-teachers_department_id-academic_degrees_id',
            'teachers',
            'academic_degree_id',
            'academic_degrees',
            'id'
        );
        $this->addForeignKey(
            'FK-teachers_department_id-academic_title_id',
            'teachers',
            'academic_title_id',
            'academic_titles',
            'id'
        );
        $this->addForeignKey(
            'FK-teachers_department_id-teacher_posts_id',
            'teachers',
            'teacher_post_id',
            'teacher_posts',
            'id'
        );
        $this->batchInsert('teachers', ['full_name', 'department_id', 'academic_degree_id', 'academic_title_id', 'teacher_post_id', 'working_since'], [
            
            ['Марзан Сергей Андреевич', 2, 1, 1, 4, '2022-05-06 11:12:15'],
            ['Серая Зоя Николаевна', 2, 1, 1, 4, '2022-05-06 11:12:15'],
            ['Басик Александр Иванович', 2, 1, 1, 4, '2022-05-06 11:12:15'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'FK-teachers_department_id-teacher_posts_id',
            'teachers'
        );
        $this->dropForeignKey(
            'FK-teachers_department_id-academic_title_id',
            'teachers'
        );
        $this->dropForeignKey(
              'FK-teachers_department_id-academic_degrees_id',
            'teachers'
        );
        $this->dropForeignKey(
            'FK-teachers_department_id-departments_id',
            'teachers'
        );
        $this->dropTable('{{%teachers}}');
    }
}
