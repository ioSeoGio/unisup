<?php declare(strict_types=1);

use yii\db\Migration;

/**
 * Handles the creation of table `{{%groups}}`.
 */
class m210913_204113_create_groups_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%groups}}', [
            'id' => $this->primaryKey(),    
            'name' => $this->string()->notNull()->comment('Название группы'),
            'course_id' => $this->integer()->notNull()->comment('Курс группы'),
            'faculty_id' => $this->integer()->notNull()->comment('Факультет группы'),
            'speciality_id' => $this->integer()->notNull()->comment('Специальность группы'),
            
            'number_of_students' => $this->integer()->comment('Количество студентов в группе'),
            'form_of_study' => $this->string()->comment('Форма получения образование (бюджет/платн.)'),

            'start_of_study' => $this->timestamp()->comment('Начало обучения.'),
            'end_of_study' => $this->timestamp()->comment('Конец обучения'),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'FK-groups_courses_id-courses_id',
            'groups',
            'course_id',
            'courses',
            'id'
        );
        $this->addForeignKey(
            'FK-groups_faculty_id-faculties_id',
            'groups',
            'faculty_id',
            'faculties',
            'id'
        );
        $this->addForeignKey(
            'FK-groups_speciality_id-specialties_id',
            'groups',
            'speciality_id',
            'specialties',
            'id'
        );
        $this->batchInsert('{{%groups}}', ['name', 'course_id', 'number_of_students', 'faculty_id', 'speciality_id'], [
            ['ПМ', 3, 26, 5, 3],
            ['ПМ', 1, 23, 5, 3],
            ['ЭК', 3, 22, 5, 4],
            ['ЭК', 1, 15, 5, 4],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'FK-groups_speciality_id-specialties_id',
            'groups',
        );
        $this->dropForeignKey(
            'FK-groups_faculty_id-faculties_id',
            'groups',
        );
        $this->dropForeignKey(
            'FK-groups_courses_id-courses_id',
            'groups',
        );

        $this->dropTable('{{%groups}}');
    }
}
